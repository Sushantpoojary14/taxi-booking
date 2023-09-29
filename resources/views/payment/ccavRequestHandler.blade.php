<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>

@include('payment.Crypto')

<?php 

	error_reporting(0);
	
	$merchant_data='2382476';
	$working_key='FD91F30C65ABFCB0B0A75C2C5C8290D2';
	$access_code='AVKV58KE04AJ80VKJA';
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.urlencode($value).'&';
	}

    // dd($merchant_data);
	$encrypted_data=newencrypt($merchant_data,$working_key); 
?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
@csrf

<input type=hidden name=encRequest value={{$encrypted_data}}>
<input type=hidden name=access_code value={{$access_code}}>
</form>

<script language='javascript'>
     
    document.redirect.submit();
    </script>
</body>
</html>

