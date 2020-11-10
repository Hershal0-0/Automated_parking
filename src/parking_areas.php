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
   include ('connection.php');
   if(!$_SESSION['auth'] && $_SESSION['username']=='' )
	{
		echo "<script>
		alert('Authentication of User Failed.Try logging again')</script>";
		header("Location:http://localhost/Automated_parking/src/index.php");
	}
	else{
		$username=$_SESSION['username'];

		/*echo "<h1 style='color:white;'>Welcome $username</h1>";*/
   ?>
	


 <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #433ab5;">
  <a class="navbar-brand" href="#"><i class="fa fa-car" aria-hidden="true"></i></a>
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
}
if(isset($_POST['logout_btn']))
{
	echo "<script>alert('Logout Successfull')</script>";
	$_SESSION['auth']=FALSE;
	$_SESSION['username']="";
	header("Location:http://localhost/Automated_parking/src/index.php");
}
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

</body>
</html>