<!DOCTYPE html>
<html>
	<head>
	<title></title>
</head>
<link rel="stylesheet" href="../css/parking_spots_style.css">
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
	if(isset($_POST['slot_submit']))
	{
		$date=$_POST['date'];
		$starting_time=$_POST['starting_time'];
		$time_duration=$_POST['time_duration'];
		$area_id=$_POST['area_id'];
		echo "<h4 style='color:white;'>$date</h4>";
		echo "<h4 style='color:white;'>$starting_time</h4>";
		echo "<h4 style='color:white;'>$time_duration</h4>";
		echo "<h4 style='color:white;'>$area_id</h4>";
		
	}
	else{
		header("Location:http://localhost/Automated_parking/src/parking_areas.php");
	}

	function check_date_range($booking_from,$booking_to,$booked_from,$booked_to)
	{
		if(($booking_from>=$booked_from && $booking_from<=$booked_to) || ($booking_to>=$booked_from && $booking_to<=$booked_to) )
		return TRUE;
		else
		return FALSE;
	}

	$sql_query="Select * from parking_areas where area_id='$area_id'";
	$res=mysqli_query($conn,$sql_query);
	$arr=mysqli_fetch_assoc($res);
	$num_spots=$arr['parking_spots'];
	echo "<div class='wrapper'>";
	for ($i=0; $i <$num_spots ; $i++) {
		$num=$i+1;
		$from_datetime=new DateTime("$date $starting_time:00"); 
		$to_datetime=$from_datetime->add(new DateInterval("PT{$time_duration}H"));
		$a="$date $starting_time:00";
		$b=$to_datetime->format('Y-m-d H:i:s');
		$c=FALSE;
		$booking_details_query="select * from booking_details where area_id='$area_id' and spot_id = '$num' ";
		$booking_res=mysqli_query($conn,$booking_details_query);
		if(mysqli_num_rows($booking_res)>0)
		{
			while($row=$booking_res->fetch_assoc())
			{
				$c=check_date_range($a,$b,$row['from_datetime'],$row['to_datetime']);
				if($c==TRUE)
				{break;}
			}
		}



		if($c==TRUE)
		echo "<div class='parking_spot' style='background-color:red;' > 
		<form action='pay_start.php' method='POST' >
		<input type='submit' name='spot_booking' value='$num' disabled>";
		else
		echo "<div class='parking_spot'>
		<form action='pay_start.php' method='POST' >
		<input type='submit' name='spot_booking' value='$num'>";

		
		
		echo "$a<br>$b<br>

		<input type='hidden' name='date' value='$date' >
		<input type='hidden' name='starting_time' value='$a' >
		<input type='hidden' name='ending_time' value='$b' >
		<input type='hidden' name='time_duration' value='$time_duration' >
		<input type='hidden' name='area_id' value='$area_id' >
		<input type='hidden' name='spot_id' value='$num' >

		</form></div>";
	}
	echo "</div>";

	?>
</body>
</html>