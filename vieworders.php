<?php

//creating short variable name
$document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title> Bobs Auto Parts -Proccessed Orders</title>
		
	
	</head>
	<body>
	
		<h1>Bobs Auto Parts</h1>
		<h2>Customer Orders</h2>
		<?php
		
		@$fp = fopen("C:/Users/Tucker/USBWebserver v8.6.6/USBWebserver v8.6.6/root/orders.txt",'rb');
		flock($fp,LOCK_SH); //locking the file for reading
		
		if(!$fp){
			echo" <p> <strong> No orders pending at the moment. Pleae try again later.</strong</p>";
			exit;
		}
		while(!feof($fp)) //going to activate this loop whilee the end of the file fp has not be reached
		{
			$order = fgets($fp);
			echo htmlspecialchars($order). "<br/>";
		}
		
		flock($fp,LOCK_UN); //release read locking
		fclose($fp);
		
		
		?>
	
	
	</body>


</html>