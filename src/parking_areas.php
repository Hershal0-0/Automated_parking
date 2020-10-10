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

<script>
	function openModal(area_id){
		const modal=document.querySelector(".section-center")
		modal.style.display="block";
		modal.style.opacity="1"
		document.getElementById('area_id').value=area_id

	}
	function closeModal(){
		const modal=document.querySelector(".section-center")
		modal.style.display="none"
		modal.style.opacity="0"
	}
</script>

<body>
	<?php 
	session_start();
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
	?>
	
	<div style="display: flex; flex-direction: row;justify-content: center; margin-top: 100px ">
	
	<div class="shape" >
		<!-- <div class="inner">Hello </div> -->
		<div class="lft_top" onclick="openModal(1)"><b>Area1</b>
		</div>
        <div class="lft_btm" onclick="openModal(2)"><b>Area2</b>
		</div> 
		<div class="rt_btm" onclick="openModal(3)"><b>Area3</b>		
		</div>
		<div class="rt_top" onclick="openModal(4)"><b>Area4</b>			
		</div>	
	</div></div>
	
	<div class="section-center" style="position: relative; display: none;opacity: 0">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<form action="parking_spots.php" method="POST">
							<i 
							class="fas fa-times fa-lg" 
							onclick="closeModal()"
							style="color: grey; font-size: 25px;"
							></i>		
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Select Date</span>
										<input class="form-control" type="date" required name="date">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Start Time</span>
										<input class="form-control" type="time" required
										name="starting_time">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<span class="form-label">Hours</span>
										<select class="form-control" name="time_duration">
												<option value="1">1.00hr</option>
												<option value="2">2.00hr</option>
												<option value="3">3.00hr</option>
												<option value="4">4.00hr</option>
												<option value="5">5.00hr</option>
												<option value="6">6.00hr</option>
												<option value="7">7.00hr</option>
												<option value="8">8.00hr</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-md-12" style="display: flex; justify-content: center;">
							<div class="form-btn">
								<button class="submit-btn" name="slot_submit">Select Slot</button>
							</div></div></div>
							<input type="hidden" name="area_id" id='area_id' value="">
						</form>
					</div>
				</div>
			</div>
	</div>
<?php 
}
if(isset($_POST['logout_btn']))
{
	echo "<script>alert('Logout Successfull')</script>";
	$_SESSION['auth']=FALSE;
	$_SESSION['username']="";
	header("Location:http://localhost/Automated_parking/src/index.php");
}
?>
</body>
</html>