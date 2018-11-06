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
class Jenga
{
	public static $username;
	public static $password;
	public static $api_key;
	public static $phone;

	//public static $;
	
	function configure( array $config = array() )
	{
		self::$username = $config['username'] ?? '';
		self::$password = $config['password'] ?? '';

		self::$api_key = $config['api_key'] ?? '';

		self::$phone = $config['phone'] ?? '';
		
		//self::$x = $config['x'] ?? '';
	}

    /**
     * @return array
     * token_type | string | token type
	 *issued_at | string | timestamp when token when issued
	 * expires_in | string | token expiry time in seconds
	 * access_token | string | access token to access other APIs
     */
	public static function authenticate()
	{
		$endpoint = 'https://sandbox.jengahq.io/identity-test/v2/token';
	    $curl = curl_init();
	    curl_setopt( $curl, CURLOPT_URL, $endpoint );
	    curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: '. self::$api_key ));

	    $curl_post_data = array(
	      'username'       	=> self::$username,
	      'password'  		=> self::$password
	    );

	    $data_string = json_encode($curl_post_data);

	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	    $curl_response = curl_exec($curl);
	    return json_decode( $curl_response )->access_token;
	}
}