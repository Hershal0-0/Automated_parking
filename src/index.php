<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="../css/style1.css">
</head>
<body>

	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
				<button class="toggle-btn" onclick="login()">Login</button>
				<button class="toggle-btn" onclick="register()">Register</button>
			</div>
				<form id="login" class="input-group" action="#" method="POST">
					<input type="text" class="input-field" placeholder="User Id" name="log_username" required>
					<input type="password" class="input-field" placeholder="Enter Password" name="log_password" required>
					<input type="checkbox" class="check-box"> <span>Remember Password</span>
					<input type="submit" class="submit-btn" value="Login" name="login_submit" >
				</form>

				<form id="register" class="input-group" action="#" method="POST">
					<input type="text" class="input-field" placeholder="User Id" name="reg_username" required>
					<input type="password" class="input-field" placeholder="Enter Password" name="reg_password" required>
					<input type="checkbox" class="check-box"> <span>I agree to the terms and conditions</span>
					<input type="submit" class="submit-btn" value="Register" name="register_submit"  >
				</form>

				
			

		</div>
	</div>

</body>
<script>
	var x= document.getElementById('login')
	var y=document.getElementById('register')
	var z=document.getElementById('btn')
	const register=()=>{
		x.style.left="-400px"
		y.style.left="50px"
		z.style.left="110px"
	}
	const login= () =>{
		x.style.left="50px"
		y.style.left="450px"
		z.style.left="0px"
	}
</script>
	<?php 
		include('connection.php');
		if(isset($_POST['login_submit']))
		{
			$username=$_POST['log_username'];
			$pass=$_POST['log_password'];
			$login_sql="select * from login_info where username='$username' and password='$pass' ";
			$login_res=mysqli_query($conn,$login_sql);
			if(mysqli_num_rows($login_res)>0)
			{
				echo "<script>alert('Logged in Successfully')</script>";
				header("Location: http://localhost/Automated_parking/src/parking_areas.php");
			}
			else{
				echo "<script>alert('Login Unsuccessful TRY AGAIN ')</script>";

			}

		}
		if(isset($_POST['register_submit']))
		{
			$username=$_POST['reg_username'];
			$pass=$_POST['reg_password'];
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