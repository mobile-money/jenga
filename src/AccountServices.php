<?php
/**
 * @package Osen Jenga
 * @author Osen Concepts < hi@osen.co.ke >
 * @version 1.10
 */
namespace Jenga;/**
 * 
 */
class AccountServices extends Jenga
{
	/**
	 * @return array
	 *	currency | string | account currency
	 *	balances | array | array of balances
	 *	amount | string | account balance
	 *	type | string | account balance type.
	 */
	public static function balance( $country = 'KE', $account )
	{
		$endpoint = "https://sandbox.jengahq.io/account-test/v2/accounts/balances/{$country}/{$account}";
		$signature = base64_encode( hash( 'sha256', $country.$account ) );
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '. parent::authenticate(), 'signature: '.$signature ) );

	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response )
	}

	/**
	 * @return array
	 * accountNumber | string | account number
	 * currency | string | account currency
	 * balance | string | account available balance
	 * transactions | array | transactions list
	 * date | string | transaction date
	 * chequeNumber | string | cheque number. Applicable to current accounts only
	 * description | string | transaction description
	 * amount | string | transaction amount
	 * type | string | transaction type
	 */
	public static function mini_statement( $country = 'KE', $account )
	{
		$endpoint = "https://sandbox.jengahq.io/account-test/v2/accounts/ministatement/{$country}/{$account}";
		$signature = base64_encode( hash( 'sha256', $country.$account ) );
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '. parent::authenticate(), 'signature: '.$signature ) );

	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response )
	}

	/**
	 * We currently support statements from Equity Bank (KE, SS, TZ, UG, DRC RW)
	 * @return array
	 accountNumber | string | account number
	 currency | string | account currency
	 balance | string | account balance
	 transactions | array | transactions list
	 transactions.reference | string | transaction reference
	 transactions.date | string | transaction date
	 transactions.description | string | transaction description
	 transactions.amount | string | transaction amount will always be the same as the account currency
	 transactions.serial | string | transaction serial number
	 transactions.postedDateTime | string
	 transactions.type | string | transaction type. One of; Debit Credit
	 transactions.runningBalance | object | running balance amount
	 runningBalance.currency | string | running balance currency
	 runningBalance.currency | string | running balance amount
	 */
	public static function full_statement( $country = 'KE', $account )
	{
		$endpoint = "https://sandbox.jengahq.io/account-test/v2/accounts/fullstatement";
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '. parent::authenticate(), 'signature: '.$signature, 'Content-Type:application/json' ) );

	    $curl_post_data = array(
	      'countryCode' => '',
	      'accountNumber' => '',
	      'fromDate' => '',
	      'toDate' => '',
	      'limit' => 20,
	      'reference' => '',
	      'serial' => '',
	      'postedDateTime' => '',
	      'date' => date( 'YYYY-MM-DD' ),
	      'runningBalance' => '',
	      'runningBalance.currency' => '',
	      'runningBalance.amount' => ''
	    );

	    $data_string = json_encode($curl_post_data);

	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response )->access_token;
	}

	/**
	 * This web service enables an application or service retrieve the opening and closing balance of an account for a given date
	 * @return array
	 * balances | array | balances list
	 * type | string | balance type end of day balance beginning of day balance
	 * amount | string | balance amount
	 */
	public static function account_balances( $country = 'KE', $account, $date = null )
	{
		$endpoint = "https://sandbox.jengahq.io/account-test/v2/accountbalance/query";
		$signature = base64_encode( hash( 'sha256', $country.$account ) );
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '. parent::authenticate(), 'signature: '.$signature, 'Content-Type:application/json' ) );

	    $curl_post_data = array(
	      'countryCode' => $country,
	      'accountNumber' => $account,
	      'date' =>  is_null( $date ) ? date('YYYY-MM-DD') : $date,
	    );

	    $data_string = json_encode($curl_post_data);

	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response );
	}

	/**
	 * This web service enables an application or service retrieve the opening and closing balance of an account for a given date
	 * @return array
	 * account | object | account object
	 * number | string | account number
	 * currency | string | account currency
	 * status | string | account status
	 * customer | object | customer list
	 * id | string | customer identifier
	 * name | string | customer account name
	 * type | string | customer type
	 */
	public static function account_inquiry( $country = 'KE', $account )
	{
		$endpoint = "https://sandbox.jengahq.io/account-test/v2/accounts/search/{$country}/{$account}";
		$signature = base64_encode( hash( 'sha256', $country.$account ) );
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '. parent::authenticate(), 'signature: '.$signature, 'Content-Type:application/json' ) );
	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response );
	}

	/**
	 * This web service performs a lookup against the accountId and returns the name of the account holder, together with other info related to the account
	 * @param countryCode - country code in ISO ALPHA-2 code format. Only KE, RW, SS, TZ, UG are supported at the moment
	 * @param accountId - bank account id for which the name lookup is being requested. will always be a 13 digit string
	 * @param merchantAccountID - the bank account number maintained for Account APIs on JengaHQ
	 * @return array
	 * accountName | string
	 * accountClosureFlag | string | Account Closure Flag. Could be one of; Y, N. Indicates whether an account is open or closed
	 * accountStatus | string | Account Status. Could be one of; A - active, D - Dormant or I - Inactive. Indicates whether an account is Dormant, Inactive or Active
	 */
	public static function name_lookup( $country = 'KE', $account, $merchantID )
	{
		$endpoint = "https://sandbox.jengahq.io/account-test/v2/accountname/lookup";
		$signature = base64_encode( hash( 'sha256', $country.$account ) );
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Authorization: Bearer '. parent::authenticate(), 'signature: '.$signature, 'Content-Type:application/json' ) );

	    $curl_post_data = array(
	      'countryCode' => $country,
	      'accountNumber' => $account,
	      'merchantAccountID' => $merchantID
	    );

	    $data_string = json_encode($curl_post_data);

	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response );
	}
}
