# jenga
Modular PHP implementations of the Jenga APIs

## Installation
Laravel users do a `composer require osenco/jenga`


## Usage

To receive payments via Mpesa(STK Push), use 

` $payment_request = \Jenga\ReceiveMoney::mpesa( '254705459494', 1000, 'Online Purchase' );`

To receive payments via Eazzypay(STK Push), use 

` $payment_request = \Jenga\ReceiveMoney::eazzypay( '254705459494', 1000, 'Online Purchase' );`

You can also do it dynamically

` $payment_request = \Jenga\ReceiveMoney::request( $method, [ '254705459494', 1000, 'Online Purchase' ] );`
