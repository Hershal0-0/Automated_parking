<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
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
              <input type="text" placeholder="Username" name="reg_username" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email_id" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-phone-alt"></i>
              <input type="tel" placeholder="Mobile number" name="mobile_no" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="reg_password" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-clipboard-check"></i>
              <input type="password" placeholder="Confirm Password" name="confirm_password" required/>
            </div>            
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
          <img src="img/car.svg" class="image" alt="" />
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
          <img src="img/parking-man-sign.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>

  <?php
		session_start();
		include('connection.php');
		if($_SESSION['auth'])
		{
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
				$sql="insert into login_info(username,password) values('$username','$pass')";
				if(mysqli_query($conn,$sql))
				{
					echo "<script>alert('User Details Registered Successfully')</script>";
				}
			}
		}
	
	?>
</html>
