<?php
/**
 * @package Osen Jenga
 * @author Osen Concepts < hi@osen.co.ke >
 * @version 1.10
 */
namespace Jenga;

/**
 * 
 */
class ReceiveMoney extends Jenga
{
	/**
	 * @param $method string Payment method
	 * @param $data string Payment request data
	 * @return array
	 */
	public static function request( $method, $data )
	{
		//return self::$$method( $data );
		$class = new self;
		return call_user_func_array( array( self, $$method ), $data );
	}

	/**
	 * @param customer object
	 * @param customer.mobileNumber string required customer’s registered mobile number
	 * @param customer.countryCode string required
	 * @param country code transaction object
	 * @param transaction.description		 
	 * @param transaction.amount string required amount to be transferred from customer to merchant
	 * @param transaction.description string required description for customer identification of particular transaction
	 * @param transaction.type string required type of the transaction being perfomed. For now, only EazzyPayOnline is supported.
	 * @param transaction.reference string required transaction reference
	 *
	 * @return array 
	 * referenceNumber string
	 * request ID. To be used later for the Get Payment Status API
	 * status string message identifying the status of the eazzypush request
	 */
	public static function eazzypay( $data = array() )
	{
		$amount 	= $data['amount'];
		$phone 		= $data['phone'];
		$reference 	= $data['ref'];

		$url 		= "https://sandbox.jengahq.io/transaction-test/v2/payments";
	}

	/**
	 * @param $data array 
	 */
	public static function mpesa( $data = array() )
	{
		$amount 	= $data['amount'];
		$phone 		= $data['phone'];
		$reference 	= $data['ref'];
	}

	/**
	 * @param $data array 
	 */
	public static function bill( $data = array() )
	{
		$amount 	= $data['amount'];
		$phone 		= $data['phone'];
		$reference 	= $data['ref'];
	}

	/**
	 * @param $data array 
	 */
	public static function merchant( $data = array() )
	{
		$amount 	= $data['amount'];
		$phone 		= $data['phone'];
		$reference 	= $data['ref'];
	}

	/**
	 * @param $data array 
	 */
	public static function mastercard( $data = array() )
	{
		$amount 	= $data['amount'];
		$phone 		= $data['phone'];
		$reference 	= $data['ref'];
	}

	/**
	 * @param $data array 
	 */
	public static function reverse( $data = array() )
	{
		$amount 	= $data['amount'];
		$phone 		= $data['phone'];
		$reference 	= $data['ref'];
	}
}