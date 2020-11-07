<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51HknCnIT4kRr32BIsrzOYggcDcxlg4BghoCeX0OQNsKkuqrWALFY0hdMGOXjeVDjslX7bqGNTGEkqgn6tG3VM4Lc00alSxC4O0');

//Sanitize Post Array
$POST=filter_var_array($_POST,FILTER_SANITIZE_STRING);
$first_name= $POST['first_name'];
$last_name= $POST['last_name'];
$email= $POST['email'];
$token= $POST['stripeToken'];

echo $token




?>