<!DOCTYPE html>
<html>
<head>
  <title>PHP feedback form</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">

  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


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

  

 <div class="container-fluid p-3 my-3 bg-info text-white" style="text-align: center; width: 100%; height: 100%;">

  <form action="feedback_form.php" method="post" name="form">
  <div>
  	<h1 style="text-align: center;"><i class="fa fa-car" aria-hidden="true"></i> FEEDBACK</h1>
  </div>
  <div>
  <br>
  <br>
  <label for="name">NAME:</label><br>
  <input style="width: 20%" name="name" type="text" placeholder="Your name"/>
  <br>
  <br>
  </div>
  <label for="messages">MESSAGE:</label><br>
  <textarea cols="32" name="message" rows="5" placeholder="Your message"> 
  </textarea>
  <br>
  <br>
  <input type="submit" class="btn btn-dark mt-2" value="Submit Feedback" name="feedback_submit"/>

  </form>
</div>   

<?php

if(isset($_POST['logout_btn']))
{
echo "<script>alert('Logout Successfull')</script>";
$_SESSION['auth']=FALSE;
$_SESSION['username']="";
header("Location:http://localhost/Automated_parking/src/index.php");
}


if(isset($_POST['feedback_submit']))
{  
    $feedback_id=uniqid();
	$name = $_POST['name'];  
    $msg = $_POST['message'];
$insert_query="insert into feedback(feedback_id,username,name,message) 
    values('$feedback_id','$username','$name','$msg') ";
        if(mysqli_query($conn,$insert_query))
                {
                    echo "<script>alert('Feedback submitted successfully!!')</script>";
                }
        else{
            echo "<script>alert('Could not submit your feedback, please try again!!')</script>";
        }


$email_query="select email_id from login_info where username='$username' ";
$email_res=mysqli_query($conn,$email_query);
$email=mysqli_fetch_assoc($email_res)['email_id'];


$feedback_msg=$msg;

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
    $mail->Subject='Your submitted feedback';
    $mail->Body=$feedback_msg;
    $mail->AddAddress($email);

    $mail->Send();

 }
?>
</body>
</html>