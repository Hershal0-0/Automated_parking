<!DOCTYPE html>
<html lang="en">
<?php
		session_start();
		include('connection.php');
		if(isset($_SESSION["auth"]))
		{
      if($_SESSION['auth'])
			header("Location:http://localhost/Automated_parking/src/parking_areas.php");
		}
		if(isset($_POST['login_submit']))
		{
			$username=$_POST['log_username'];
			$pass=$_POST['log_password'];
			$login_sql="select * from login_info where username='$username' and password='$pass' ";
			$login_res=mysqli_query($conn,$login_sql);
			if(mysqli_num_rows($login_res)>0)
			{
				echo "<script>alert('Logged in Successfully')</script>";
        $_SESSION['username']=$username;
        $row=$login_res -> fetch_assoc();
        $_SESSION['email_id']=row['email_id'];
				$_SESSION['auth']=TRUE;
				header("Location: http://localhost/Automated_parking/src/parking_areas.php");
			}
			else{
				$_SESSION['username']="";
				$_SESSION['auth']=FALSE;
				echo "<script>alert('Login Unsuccessful TRY AGAIN ')</script>";

			}

		}
		if(isset($_POST['register_submit']))
		{
			$username=$_POST['reg_username'];
			$emailId=$_POST['email_id'];
			$mobNo=$_POST['mobile_no'];
			$pass=$_POST['reg_password'];
			/*$confirmpass=$_POST['confirm_password'];*/
			$check_sql="select * from login_info where username='$username'";
			$check_res=mysqli_query($conn,$check_sql);
			if(mysqli_num_rows($check_res)>0)
			{
				echo "<script>alert('This Username already exixts.TRY AGAIN')</script>";

			}
			else
			{
				$sql="insert into login_info(username,email_id,mobile,password) values('$username','$emailId','$mobNo','$pass')";
				if(mysqli_query($conn,$sql))
				{
					echo "<script>alert('User Details Registered Successfully')</script>";
        }
        else{
					echo "<script>alert('Something Went Wrong.Try Again')</script>";
        }
			}
		}
	
	?>

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Sign in & Sign up Form</title>
    <style>
    #password-strength-status {
                padding: 5px 10px;
                margin-top: 5px;
            }

            .medium-password {
                color: #b7d60a;
            }

            .weak-password {
                color: #ce1d14;
            }

            .strong-password {
                color: green;
            }
            .notmatch {
              color: red;
            }
            .match{
              color: green;
            }
        </style>
  </head>
  <script>
$(document).ready(function(){

   $("#reg_username").keyup(function(){

      var username = $(this).val().trim();

      if(username != ''){

         $.ajax({
            url: 'ajaxfile.php',
            type: 'post',
            data: {username: username},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });
</script>
<script>
function checkemail()
{
 var email=document.getElementById( "email_id" ).value;
	
 if(email)
 {
  $.ajax({
  type: 'post',
  url: 'ajaxfile.php',
  data: {
  email_id:email,
  },
  success: function (response) {
   $( '#email_status' ).html(response);
   if(response=="OK")	
   {
    return true;	
   }
   else
   {
    return false;	
   }
  }
  });
 }
 else
 {
  $( '#email_status' ).html("");
  return false;
 }
}
</script>
<script>
function check()
{

    var mobile = document.getElementById('mobile');
   
    
    var message = document.getElementById('message');

   var goodColor = "#0C6";
    var badColor = "#FF9B37";
  
    if(mobile.value.length!=10){
        message.style.color = badColor;
        message.innerHTML = "required 10 digits, match requested format!"
    }
    else{
      message.style.color = goodColor;
        message.innerHTML = "matched format"
    }}
</script>  
<script>
        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#password').val().length < 6) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
            } else {
                if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
                }
            }
        }
    </script>
    <script>
    function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#txtConfirmPassword").val();
        if (password != confirmPassword){
          $("#CheckPasswordMatch").removeClass();
            $("#CheckPasswordMatch").addClass('notmatch');
            $("#CheckPasswordMatch").html("Passwords does not match!");
        }
        else{
          $("#CheckPasswordMatch").removeClass();
        $("#CheckPasswordMatch").addClass('match');
            $("#CheckPasswordMatch").html("Passwords match.");
        }
    }
    $(document).ready(function () {
       $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });
    </script>     
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        
          <form action="#" class="sign-in-form" method="POST">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="log_username" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="log_password" required />
            </div>
            <input type="submit" value="Login" class="btn solid" name="login_submit" />
          </form>

          <form action="#" class="sign-up-form" method="POST">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="reg_username" id="reg_username" required />
            </div>

            <div id="uname_response" ></div>
            
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email_id" id="email_id" onkeyup="checkemail();" required/>
            </div>

            <span id="email_status"></span>

            <div class="input-field">
              <i class="fas fa-phone-alt"></i>
              <input type="tel" placeholder="Mobile number" name="mobile_no" id="mobile"  onkeyup="check(); return false;"  required/>
            </div>
            <span id="message"></span>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="reg_password" id="password" onKeyUp="checkPasswordStrength();" required/>
            </div>

            <div id="password-strength-status"></div>

            <div class="input-field">
              <i class="fas fa-clipboard-check"></i>
              <input type="password" placeholder="Confirm Password" id="txtConfirmPassword" name="confirm_password" required/>
            </div>  
            <div class="registrationFormAlert"  id="CheckPasswordMatch"></div>
         
            <input type="submit" class="btn" value="Sign up" name="register_submit" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Not yet registered ?!</h3>
            <p>
              Register to book your slot for parking anytime.
            </p>
            <button class="btn transparent" id="sign-up-btn" >
              Sign up
            </button>
          </div>
          <br>
          <img src="../img/car.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Already registered ?</h3>
            
             <p>
              Sign in now to book your parking slot!!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="../img/parking-man-sign.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="../js/index.js"></script>
  </body>

  
</html>
