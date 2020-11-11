<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/charge.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
  <img src="https://marketplace.magento.com/media/catalog/product/s/t/stripe-payment_7.png" width="100" height="250"  
  style="display: block;
  margin-right: auto;
  width: 40%;
  /* border: 2px solid #7154ff;
  border-radius:5%; */
  "> 
</div>

<div class="container">
  <h2 class="my-4 text-center">Car Parking Payment</h2>
  <h5 class="my-4 text-center">You've agreed to pay Rs. <?php echo $cost ?>  </h5>
  <form action="./charge.php" method="post" id="payment-form">
    <div class="form-row">
      <input 
      type="text" 
      class="form-control mb-3 StripeElement StripeElement--empty"
      placeholder="Name On Card" name="name" required>
      <input 
      type="email" 
      class="form-control mb-3 StripeElement StripeElement--empty"
      placeholder="Email" name="email" required >

      <?php
      echo "<input type='hidden' name='spot_id' value='$spot_id' >"; 
      echo "<input type='hidden' name='area_id' value='$area_id' >"; 
      echo "<input type='hidden' name='time_duration' value='$time_duration' >"; 
      echo "<input type='hidden' name='from_datetime' value='$from_datetime' >"; 
      echo "<input type='hidden' name='to_datetime' value='$to_datetime' >";  
      echo "<input type='hidden' name='charge' value='$cost' >"; 
      
      ?>


      <div id="card-element" class="form-control">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <!-- Used to display Element errors. -->
      <div id="card-errors" role="alert"></div>
    </div>

    <button style="background-color: #7154ff; border-color:#7154ff;">Submit Payment</button>
  </form>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="../js/charge.js"></script>
</body>
</html>