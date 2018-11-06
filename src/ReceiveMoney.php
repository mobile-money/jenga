<?php
/**
 * @package Jenga For WooCommerce
 * @author Osen Concepts < hi@osen.co.ke >
 * @version 1.10
 */
namespace Osen;

/**
 * 
 */
class ReceiveMoney extends Jenga
{
	/**
	 * @param customer object
	 * @param customer.mobileNumber string required customer’s registered mobile number
		customer.countryCode
		string
		required

		country code
		transaction
		object

		transaction.description
		 
		transaction.amount
		string
		required

		amount to be transferred from customer to merchant
		transaction.description
		string
		required

		description for customer identification of particular transaction
		transaction.type
		string
		required

		type of the transaction being perfomed. For now, only EazzyPayOnline is supported.
		transaction.reference
		string
		required

		transaction reference

		@return array 


		referenceNumber

		string

		request ID. To be used later for the Get Payment Status API

		status

		string

		message identifying the status of the eazzypush request


	 */
	public static function eazzypay($value='')
	{
		$url = "https://sandbox.jengahq.io/transaction-test/v2/payments";


	}

	public static function mpesa($value='')
	{
		# code...
	}

	public static function bill($value='')
	{
		# code...
	}

	public static function merchant($value='')
	{
		# code...
	}

	public static function mastercard($value='')
	{
		# code...
	}

	public static function reverse($value='')
	{
		# code...
	}
}
