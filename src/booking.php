<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	body{
	margin: 0px;
	padding: 0px;
	background-image: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)),url("../img/hello.jpg");

}
</style>
<body>

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

		echo "<h1 style='color:white;'>Welcome $username</h1>";
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
	if(isset($_POST['spot_booking'])){
		$date=$_POST['date'];
		$starting_time=$_POST['starting_time'];
		$time_duration=$_POST['time_duration'];
		$area_id=$_POST['area_id'];
		$spot_id=$_POST['spot_id'];
		$starting_datetime=new DateTime("$date $starting_time:00");
		$ending_datetime=$starting_datetime->add(new DateInterval("PT{$time_duration}H"));
		$a="$date $starting_time:00";
		$b=$ending_datetime->format('Y-m-d H:i:s');
		$now=new DateTime();
		$now=$now-> format('Y-m-d H:i:s');
		$booking_id=1;

		$insert_query="insert into booking_details(booking_id,area_id,spot_id,username,booking_date,from_dateime,to_datetime) values('$booking_id','$area_id','$spot_id','$username','$a','$a','$b') ";
		if(mysqli_query($conn,$insert_query))
				{
					echo "<script>alert('Booking Details Registered Successfully')</script>";
				}
		else{
			echo "<script>alert('Booking Details NOT Registered ')</script>";
		}
		

		echo"<h1 style='color:white'> 
			Slot Booked for spot_id: $spot_id<br>
			area_id:$area_id<br>
			starting_time: $a<br>
			time_duration: $time_duration <br>
			ending_time:$b <br>
		</h1>";
		 
	}
	?>

</body>
</html>