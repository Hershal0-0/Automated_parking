<?php
require_once('../vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51HknCnIT4kRr32BIsrzOYggcDcxlg4BghoCeX0OQNsKkuqrWALFY0hdMGOXjeVDjslX7bqGNTGEkqgn6tG3VM4Lc00alSxC4O0');
if(!isset($_POST['name']))
{
    header("Location:index.php");
}
//Sanitize Post Array
$POST=filter_var_array($_POST,FILTER_SANITIZE_STRING);
$first_name= $POST['name'];
$email= $POST['email'];
$token= $POST['stripeToken'];

$spot_id=$POST['spot_id'];
$area_id=$POST['area_id'];
$time_duration=$POST['time_duration'];
$from_datetime=$POST['from_datetime'];
$to_datetime=$POST['to_datetime'];
$amount=$POST['charge'];
// create customer in Stripe

$customer=\Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token
));

//Charge Customer

$charge =\Stripe\Charge::create(array(
    "amount" => number_format($amount)*100,
    "currency" => "inr",
    "description" => "Parking Spot",
    "customer" => $customer->id
));



//Redirect To Success Page

header("Location:success.php?tid="
        .$charge->id
        .'&product='.$charge->description
        .'&last4='.$charge->last4
        .'&spot_id='.$spot_id
        .'&area_id='.$area_id
        .'&time_duration='.$time_duration
        .'&from_datetime='.$from_datetime
        .'&to_datetime='.$to_datetime
        .'&amount='.$amount);


?>