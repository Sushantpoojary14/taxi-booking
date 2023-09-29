@include('payment.Crypto')
<?php

	error_reporting(0);
	$working_key='FD91F30C65ABFCB0B0A75C2C5C8290D2';

// Catch the Payment Response
	$encResponse = htmlentities($_POST["encResp"], ENT_QUOTES, 'utf-8'); //This is the response sent by the CCAvenue Server
	$rcvdString = newdecrypt($encResponse, $working_key); //Crypto Decryption used as per the specified working key.
	
	// Preparing decrypted data
	$order_status = "";
	$decryptValues = explode('&', $rcvdString);
	$dataSize = sizeof($decryptValues);
 
	// Process the decrypted data
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information = explode('=', $decryptValues[$i]);
 
		if($i == 3)
		{
			$order_status = $information[1];
		}
	}
 
	// Show user order message / response
	if($order_status === "Success")
	{
		echo "Thank you for shopping with us. Your payment is processed successfully.";
	}
	else if($order_status === "Aborted")
	{
		echo "Hey! Looks like you canceled your payment.";
	}
	else if($order_status === "Failure")
	{
		echo "Thank you for shopping with us. However, the transaction has been declined by your card or bank authority.";
	}
	else
	{
		die("Security Error. Illegal access detected");
	}
 
 
	// Response Data
	$payment_data = array();
 
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information = explode('=', $decryptValues[$i]);
	    $payment_data[$information[0]] = $information[1];
	}
 
	// Print the securely processed payment data for further usage.
	print_r($payment_data);

?>
