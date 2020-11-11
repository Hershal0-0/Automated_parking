<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Thank You</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>

<?php
   session_start();
   include ('connection.php');
   require_once('../PHPMailer/PHPMailerAutoload.php');
   if(!$_SESSION['auth'] && $_SESSION['username']=='' )
    {
        echo "<script>
        alert('Authentication of User Failed.Try logging again')</script>";
        header("Location:http://localhost/Automated_parking/src/index.php");
    }
    else{
        $username=$_SESSION['username'];
      }

?>  

 <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #433ab5;">
  <a class="navbar-brand"><i class="fa fa-car" aria-hidden="true"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav w-100">
      <li class="nav-item" >
        <a class="nav-link" href="#" style="color: white;"><i class="fa fa-address-card" aria-hidden="true"></i> Booking Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: white;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Transaction Details</a>
      </li>
      <li class="nav-item dropdown ml-auto">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;"><i class="fa fa-user-circle" aria-hidden="true"></i>
          <?php
          echo" $username";
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i> My profile</a>

          <a class="dropdown-item" href="http://localhost/Automated_parking/src/index.php">
                <div>
                    <form class="form-inline btn btn-outline-success my-2 my-sm-0" action="#" method="POST">          
                        <input type="submit" name="logout_btn" value="Logout">
                     </form>
                </div>
          </a>
        </div>
      </li>
    </ul>  
   </div>
  </nav>



<?php

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

$insert_query="insert into booking_details(booking_id,area_id,spot_id,username,booking_date,from_datetime,to_datetime,sms_alert) 
    values('$booking_id','$area_id','$spot_id','$username','$booking_date','$from_datetime','$to_datetime','False') ";
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

    $email_query="select email_id from login_info where username='$username' ";
    $email_res=mysqli_query($conn,$email_query);
    $email=mysqli_fetch_assoc($email_res)['email_id'];

        //Send Booking/Transaction Details Through Email
        $msg1="<html><head></head><body>Thank you for purchasing a parking spot with our website<br>";
        $msg2="Your Booking And Transactions Details are as follows:<br>
        BookingId:$booking_id<br>
        TransactionId:$tid<br>
        Amount:$amount<br>
        Booking Date:$booking_date<br>
        Parking Area:$area_id<br>
        Spot Id:$spot_id<br>
        From DateTime:$from_datetime<br>
        To DateTime:$to_datetime<br>
        Time Duration: $time_duration hrs.<br>";
        $msg3="Thanks & regards,<br> Parking Booking.<br>++++<br></body></html>";
        $final_msg=$msg1.$msg2.$msg3;

    $mail=new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='ssl';
    $mail->Host='smtp.gmail.com';
    $mail->Port='465';
    $mail->isHTML();
    $mail->Username='pewwins1@gmail.com';
    $mail->Password='dypatil@123';
    $mail->SetFrom('no-reply@parking.com');
    $mail->Subject='Booking & Transaction Details';
    $mail->Body=$final_msg;
    $mail->AddAddress($email);

    $mail->Send();
?>

    <div class="container mt-4">
      <h2>
         Thank you for purchasing
         <?php echo $product ; ?>
      </h2>
      <hr>
      <p>Your transaction id is <?php echo $tid; ?> </p>
      <p>Check Your email for more info</p>
      <p><a href="pay_start.php" class="btn btn-primary mt-2"> Go Back </a></p>
      <p><a href="feedback_form.php" class="btn btn-info mt-2"> Submit Feedback </a></p>
    </div>


  </body>
</html>