<!DOCTYPE HTML>
<html>
<title> What is happening here?</title>
<body>
<h1>Orders processed at</h1>
<?php



//creating variable names 
$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty =$_POST['sparkqty'];
$find = $_POST['find'];
$shippingaddress =$_POST['shippingaddres'];
$date = date('H:i,jS F Y');

echo "<p> Order Processed at " ;
echo $date;
echo "</p>";

//doing bare user valdiation for special chars

echo '<p> Your order is as follows</p>';
echo htmlspecialchars($tireqty). ' tires <br/>';
echo htmlspecialchars($oilqty). ' cans of oil <br/>';
echo htmlspecialchars($sparkqty). ' sparkplugs <br/>';

//checking if a variable exists or not
echo "<p> isset($tireqty) :" . isset($tireqty)."</br></p>";


//creating constant variables

define('TIREPRICE',1500);
define('OILPRICE',700);
define('SPARKPRICE',375). "<br/></p>";

//keeping track of all the items ordered by the user
$totalqty =0;
$totalqty = $tireqty + $oilqty + $sparkqty;

//checking and ensuring if user didnt input any orders then tthe output will be
if($totalqty == 0)
{
	echo" YOU DID NOT ORDER ANYTHING ON THE PREVIOUD PAGE!";
}
// bob provides discounts for tires
if($tireqty<10)
{
	$discount =0;
}elseif($tireqty>= 10 and $tireqty <=49 ){
    $discount= 5/100;
}elseif($tireqty>=50 && $tireqty<=99){
	$discount =10/100;
}elseif($tireqty >=100){
	$discount =15/100;
}

echo "<p> Price per tire :".TIREPRICE."<br/>";
echo "Price per oil: ".OILPRICE."<br/>";
echo "Price per sparkplug: ". SPARKPRICE."<br/>";
echo " Total items ordered(incl tire,oil and spark) :".$totalqty."<br/></p>";



//calculating the total amount required for the items ordered
$totalamounttire = $tireqty*TIREPRICE;
$totalamountoil= $oilqty * OILPRICE;
$totalamountspark =$sparkqty * SPARKPRICE;
$discountedtire = $totalamounttire -($totalamounttire*$discount);
echo "<p>The subtotal tire price: ".number_format($totalamounttire).' rands <br/>' ;
echo "Discounted subtotal of tires:".number_format($discountedtire).'<br/>';
echo "The subtotal oil price: ". number_format($totalamountoil).'<br/>' ;
echo "The subtotal spark price: ". number_format($totalamountspark).'<br/></p>' ;

// if there is a discount in place then output the discounted price if not then not
if($discount ==0){
$subtotal = $totalamountoil+$totalamountspark+$totalamounttire;
echo "<p> The subtotal is: ". number_format($subtotal)."</p><br/>";
}elseif($discount != 0){
	$subtotal = $totalamountoil+$totalamountspark+$discountedtire;
echo "<p> The subtotal including discount is: ". number_format($subtotal)."</p><br/>";
}
$taxrate =0.15; //local tax rate
$subtotal = $subtotal *(1+ $taxrate);

echo "Total including tax: ". number_format($subtotal,2)."</p>";

//outputing using a switch case how the the user/client found out about bobs auto
switch($find){
	case "a":
		echo "<p> Regurlar customer</p>";
		break;
	case "b":
		echo "<p> Customer referred by TV advert. </p>";
		break;
	case "c":
		echo "<p> Customer reffered by phone directory</p>";
		break;
	case "d":
		echo"<p> Customer referred by word of mouth.</p>";
		break;
	default:
		echo "<p> We do not know how this customer found out about us </p>";
		break;
}

echo "Address to ship is ".$shippingaddress."</br>";

$outputstring = $date."\t".$tireqty." Tires \t".$oilqty." oil\t".$sparkqty." spark plugs\t\$".$subtotal."\t".$shippingaddress."\n";

// want to write a order in a text document
$document_root =$_SERVER['DOCUMENT_ROOT']; //copying the contents of the long-style variable to the short style
@$fp =fopen("C:/Users/Tucker/USBWebserver v8.6.6/USBWebserver v8.6.6/root/orders.txt",'ab');
if(!$fp){
	echo "<p><strong> Your order could not be proccessed at this moment in time.Please try again later. </p>";
	exit;
	
}else if($fp!=0){
	echo "Your order has been succesfully processed. Thank you";
}
flock($fp,LOCK_EX);

//then i am writing to the file 
fwrite($fp,$outputstring,strlen($outputstring));

flock($fp,LOCK_UN);

fclose($fp); //closing the file straeam


?>

</body>
	
</html>