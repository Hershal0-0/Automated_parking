<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/charge.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Pay Page</title>
</head>
<body>
<?php
  session_start();
  if(isset($_POST['spot_booking'])){
    $spot_id=$_POST['spot_id'];
    $area_id=$_POST['area_id'];
    $time_duration=$_POST['time_duration'];
    $from_datetime=$_POST['starting_time'];
    $to_datetime=$_POST['ending_time'];
    $cost=10* number_format($time_duration);

  }
  else{
    echo "<script>alert('Something Went Wrong.Try Again')</script>" ;
    header("Location:index.php");
  }
?>
<div class="container">
  <h2 class="my-4 text-center">Car Parking Payment</h2>
  <h5 class="my-4 text-center">You've agreed to pay Rs. <?php echo $cost ?>  </h5>
  <form action="./charge.php" method="post" id="payment-form">
    <div class="form-row">
      <input 
      type="text" 
      class="form-control mb-3 StripeElement StripeElement--empty"
      placeholder="Name On Card" name="name">
      <?php echo "<input type='hidden' name='charge' value='$cost' >"; ?>
      <input 
      type="email" 
      class="form-control mb-3 StripeElement StripeElement--empty"
      placeholder="Email" name="email">

      

      <div id="card-element" class="form-control">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display Element errors. -->
      <div id="card-errors" role="alert"></div>
    </div>

    <button>Submit Payment</button>
  </form>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="../js/charge.js"></script>
</body>
</html>