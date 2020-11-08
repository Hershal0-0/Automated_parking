<?php 
if(!empty($_GET['tid']) && !empty($_GET['product']))
{
    $GET=filter_var_array($_GET,FILTER_SANITIZE_STRING);
    $tid=$GET['tid'];
    $product=$GET['product'];
}else{
    header("Location: pay_start.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Thank You</title>
</head>
<body>
    <div class="container mt-4">
    <h2>
    Thank you for purchasing
    <?php echo $product ; ?>
    </h2>
    <hr>
    <p>Your transaction id is <?php echo $tid; ?> </p>
    <p>Check Your email for more info</p>
    <p><a href="pay_start.php" class="btn btn-light mt-2">Go Back
    </a></p>
    </div>
</body>
</html>