<?php
session_start();
include ('connection.php');
if(!$_SESSION['auth'] && $_SESSION['username']=='' )
{
    echo "<script>
    alert('Authentication of User Failed.Try logging again')</script>";
    header("Location:http://localhost/Automated_parking/src/index.php");
}
else{
    $username=$_SESSION['username'];

    echo "<h1 style='color:black;'>Welcome $username</h1>";
    echo '<div>
    <form action="#" method="POST">
        <input type="submit" name="logout_btn" value="Logout">
    </form>
</div>';
}
if(isset($_POST['logout_btn']))
{
echo "<script>alert('Logout Successfull')</script>";
$_SESSION['auth']=FALSE;
$_SESSION['username']="";
header("Location:http://localhost/Automated_parking/src/index.php");
}



if(!empty($_GET['tid']) && !empty($_GET['product']))
{
    $GET=filter_var_array($_GET,FILTER_SANITIZE_STRING);
    $tid=$GET['tid'];
    $product=$GET['product'];
    $spot_id=$GET['spot_id'];
    $area_id=$GET['area_id'];
    $time_duration=$GET['time_duration'];
    $from_datetime=$GET['from_datetime'];
    $to_datetime=$GET['to_datetime'];
    $amount=$GET['amount'];
    $last4=$GET['last4'];
    $booking_id=uniqid();
    $booking_date=date("Y-m-d");


}else{
    header("Location: pay_start.php"); 
}

$insert_query="insert into booking_details(booking_id,area_id,spot_id,username,booking_date,from_datetime,to_datetime) 
    values('$booking_id','$area_id','$spot_id','$username','$booking_date','$from_datetime','$to_datetime') ";
		if(mysqli_query($conn,$insert_query))
				{
					echo "<script>alert('Booking Details Registered Successfully')</script>";
				}
		else{
			echo "<script>alert('Booking Details NOT Registered ')</script>";
		}

$transaction_insert_query="insert into transaction(transaction_id,customer_id,booking_id,product,amount,currency,status,last_4digits) 
    values ('$tid','$username','$booking_id','$product','$amount','INR','Success','$last4') ";
        if(!mysqli_query($conn,$transaction_insert_query))
        {
			echo "<script>alert('Transaction Details NOT Registered ')</script>";
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Thank You</title>
</head>
<body>
    <div class="container mt-4">
    <h2>
    Thank you for purchasing
    <?php echo $product ; ?>
    </h2>
    <hr>
    <p>Your transaction id is <?php echo $tid; ?> </p>
    <p>Check Your email for more info</p>
    <p><a href="pay_start.php" class="btn btn-light mt-2">Go Back
    </a></p>
    </div>
</body>
</html>