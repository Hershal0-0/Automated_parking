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
  if(isset($_POST['logout_btn']))
{
	echo "<script>alert('Logout Successfull')</script>";
	$_SESSION['auth']=FALSE;
	$_SESSION['username']="";
	header("Location:http://localhost/Automated_parking/src/index.php");
}
  ?>
	


 <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #433ab5;">
  <a class="navbar-brand" href="parking_areas.php"><i class="fa fa-car" aria-hidden="true"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav w-100">
      <li class="nav-item" >
        <a class="nav-link" href="booking_details.php" style="color: white;"><i class="fa fa-address-card" aria-hidden="true"></i> Booking Details</a>
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
  <div class="container curved">
    <h1 style="color:white">Transaction Details</h1>
  </div>
  <div style="display:flex; align-items:center;justify-content:center;">
  <div class=" curved table">
    <table border="1" style="border:1px solid white">
      <thead>
        <tr>
        <th>Booking_Id</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Transaction DateTime</th>
        
        </tr>
      </thead>
      <tbody>
        <?php 
        $details_query="select * from transaction where customer_id='$username' ";
        $details_res=mysqli_query($conn,$details_query);
        while($row=mysqli_fetch_assoc($details_res))
        {
          echo "<tr>
          <td>".$row['booking_id']."</td>
          <td>".$row['amount']."</td>
          <td>".$row['status']."</td>
          <td>".$row['created_at']."</td>
          
          </tr>";
        }
        ?>
      </tbody>
    </table>
  </div></div>
  </body>
  <style>
  *{
    padding:0;
    margin:0;
  }
    .curved{
      display:flex;
      align-items:center;
      justify-content:center;
      border: 3px solid white;
      border-radius:10px;
      padding-top:1em;
      padding-bottom:1em;
      margin-top:2em;
      color:white;
      
    }
    
    
    .table{
      /* height:1000px; */
      width:fit-content;
      overflow-y:auto;
    }
    
  </style>
</html>