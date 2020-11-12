<!DOCTYPE html>
<html>
	<head>
	<title></title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/parking_spots_style.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


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
		
	}
   ?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #433ab5;">
  <a class="navbar-brand" href="#"><i class="fa fa-car" aria-hidden="true"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav w-100">
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: white;"><i class="fa fa-address-card" aria-hidden="true"></i> Booking Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" style="color: white;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Transaction Details</a>
      </li>
      <li class="nav-item dropdown ml-auto">
        <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
          <?php
          echo"$username";
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="my_profile.php"><i class="fa fa-user" aria-hidden="true"></i> My profile</a>
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
	if(isset($_POST['slot_submit']))
	{
		$date=$_POST['date'];
		$starting_time=$_POST['starting_time'];
		$time_duration=$_POST['time_duration'];
		$area_id=$_POST['area_id'];
		echo "<div class='curved'><h4 style='color:white;'>Booking Date: $date</h4>";
		echo "<h4 style='color:white;'>Starting Time: $starting_time</h4>";
		echo "<h4 style='color:white;'>Time Duration: $time_duration hrs</h4>";
		echo "<h4 style='color:white;'>Area Id: $area_id</h4></div><br><br>";
		
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

		
		
		echo "
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
<style>
	.curved{
    border: 3px solid white;
    border-radius: 10px;
    width: fit-content;
    padding: 7px;
    margin: 1em ;
}
</style>
</html>