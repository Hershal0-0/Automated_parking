<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link rel="stylesheet" href="../css/parking_area_style.css">
<link rel="stylesheet" href="../css/slot_booking.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


<body>

  <?php
   session_start();
   include('connection.php');
   require_once('../PHPMailer/PHPMailerAutoload.php');
   

   if(!$_SESSION['auth'] && $_SESSION['username']=='' )
	{
		echo "<script>
		alert('Authentication of User Failed.Try logging again')</script>";
		header("Location:http://localhost/Automated_parking/src/index.php");
	}
	else{
		$username=$_SESSION['username'];

    /*echo "<h1 style='color:white;'>Welcome $username</h1>";*/
  }
   ?>
	
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #433ab5;">
  <a class="navbar-brand" href="index.php"><i class="fa fa-car" aria-hidden="true"></i></a>
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
          echo"$username";
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
$email_query="select email_id,mobile from login_info where username='$username' ";
$email_mobile_res=mysqli_fetch_assoc(mysqli_query($conn,$email_query));
$email=$email_mobile_res['email_id'];
$mobile=$email_mobile_res['mobile'];

?>
<br>
<form action="#" method="POST">
  <input type="text" name="email" id="email" value='<?php echo $email; ?>' disabled class="m-2"><br>
  <input type="submit" name="send_e_verif_code" id="send_e_verif_code" value="Send Email Verification Code" class="btn btn-primary m-2"><br>
  <input type="text" name="email_verif_code" id="email_verif_code" placeholder="Enter Email Verification Codes" class="m-2" ><br>
  <input type="submit" name="email_verif" value="Verify Your Email" class="m-2"><br><br>
</form>
<form action="#" method="POST">
  <input type="text" name="mobile" id="mobile" value='<?php echo $mobile; ?>' disabled class="m-2"><br>
  <input type="submit" name="send_m_verif_code" id="send_m_verif_code" value="Send Mobile Verification Code" class="btn btn-primary m-2"><br>
  <input type="text" name="mobile_verif_code" id="mobile_verif_code" placeholder="Enter Phone Number Verification Codes" class="m-2" ><br>
  <input type="submit" name="mobile_verif" value="Verify Your Phone Number" class="m-2"><br><br>

</form>
</body>
<?php
  function generate_random_letters($length) {
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= chr(rand(ord('a'), ord('z')));
    }
    return $random;
  }
  // PHONE NUMBER VERIFICATION!!!!!
  require ("../vendor/autoload.php");
  include('twilio_var.php');
  use Twilio\Rest\Client;
  if(isset($_POST['send_m_verif_code']))
  {

    $mobile_code=generate_random_letters(6);
    $mobile="+91".$mobile;    
    $final_msg="
    Dear Sir/Madam,\n
    Your Phone Number Verification Code is:  $mobile_code \n
    Thanks & Regards,\n
    Parking booking \n";

    $client= new Client($sid,$token);
    $message=$client->messages->create(
      $mobile,
      array(
        'from'=> $twilio_number,
        'body'=> $final_msg,
      )
    );

    $mobile_code_update_query="update login_info set mobile_verification_code='$mobile_code' where username='$username' ";
    $mobile_code_update_res=mysqli_query($conn,$mobile_code_update_query);

    if($message->sid){
      echo $mobile_code;
    }

  }

  if(isset($_POST['mobile_verif']))
  {
    $val=$_POST['mobile_verif_code'];
    $db_code_query="select mobile_verification_code,verification from login_info where username='$username'";
    $db_code_res=mysqli_query($conn,$db_code_query);
    $row=mysqli_fetch_assoc($db_code_res);
    $db_code=$row['mobile_verification_code'];
    $verification=$row['verification'];
    if($val==$db_code)
    {
      if($verification=="None")
      {
        $update_query="update login_info set verification='Mobile' where username='$username' ";
        $res=mysqli_query($conn,$update_query);   
     }
      elseif($verification="Email"){
        $update_query="update login_info set verification ='Both' where username='$username' ";
        $res=mysqli_query($conn,$update_query);          

      }
    }


  }







  //EMAIL VERIFICATION!!!!!!!
    
  if(isset($_POST['send_e_verif_code']))
  {
    $email_code=generate_random_letters(6);
    echo $email_code;
    $update_query="update login_info set email_verification_code ='$email_code' where username='$username' ";
    $res=mysqli_query($conn,$update_query);

    $final_msg="<html><body>
    Dear Sir/Madam,<br>
    Your Email Verification Code is $email_code<br>
    Thanks & Regards,<br>
    Parking booking <br>
    </body></html>";

    $mail=new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='ssl';
    $mail->Host='smtp.gmail.com';
    $mail->Port='465';
    $mail->isHTML();
    $mail->Username='pewwins1@gmail.com';
    $mail->Password='dypatil@123';
    $mail->SetFrom('mo-reply@parking.com');
    $mail->Subject='Booking & Transaction Details';
    $mail->Body=$final_msg;
    $mail->AddAddress($email);

    $mail->Send();

  ?>  
  <script>
    const button=document.querySelector("#send_e_verif_code")
    button.value="Send Email Verification Code Again";
    button.style.backgroundColor="green";
  </script>
<?php
  }

  if(isset($_POST['email_verif']))
  {
    $val=$_POST['email_verif_code'];
    $db_code_query="select email_verification_code,verification from login_info where username='$username'";
    $db_code_res=mysqli_query($conn,$db_code_query);
    $row=mysqli_fetch_assoc($db_code_res);
    $db_code=$row['email_verification_code'];
    $verification=$row['verification'];
    if($val==$db_code)
    {
      if($verification=="None")
      {
        $update_query="update login_info set verification='Email' where username='$username' ";
        $res=mysqli_query($conn,$update_query);   
     }
      elseif($verification="Mobile"){
        $update_query="update login_info set verification ='Both' where username='$username' ";
        $res=mysqli_query($conn,$update_query);          

      }
    }
  }

?>
</html>