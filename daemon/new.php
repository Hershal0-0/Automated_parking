<?php 
include("../src/connection.php");
require ("../vendor/autoload.php");
include('../src/twilio_var.php');
require_once('../PHPMailer/PHPMailerAutoload.php');

use Twilio\Rest\Client;

/* Remove the execution time limit */
set_time_limit(0);
$sleep_time = 10;

date_default_timezone_set('Asia/Kolkata');
while (TRUE)
{
   
   $now=new DateTime();
   
   $booking_details_query="select * from booking_details";
   $booking_details_res=mysqli_query($conn,$booking_details_query);
   while($row=mysqli_fetch_assoc($booking_details_res))
   {
       $to=$row['to_datetime'];
       $to_datetime=$row['to_datetime'];
       $to_datetime=new DateTime($to_datetime);
       if($to_datetime>$now){
        $since_start=$now->diff($to_datetime);
        $min=$since_start->days*24*60;
        $min+=$since_start->h*60;
        $min+=$since_start->i;
        // echo $min." minutes\n";
        if($min<10 && $row['sms_alert']=="False")
        {
            $book_id=$row['booking_id'];
            $area_id=$row['area_id'];
            $spot_id=$row['spot_id'];
            $username=$row['username'];
            $mobile_email_query="select mobile,email_id from login_info where username='$username' ";
            $mobile_email=mysqli_fetch_assoc(mysqli_query($conn,$mobile_email_query));
            $mobile="+91".$mobile_email['mobile'];
            $email=$mobile_email['email_id'];

            // SENDING SMS ALERT!!!!!!!!
            $final_msg="Dear Sir/Madam,\n
            Your PARKING with booking id:$book_id \n
            for spot id: $spot_id\n
            and area id: $area_id \n
            expires in 10 min.\n
            To extend your booking, pls login and get the parking spot in the same area.\n
            Thanks & Regards,\n
            Automated Parking\n";

            $client= new Client($sid,$token);
            $message=$client->messages->create(
            $mobile,
            array(
                'from'=> $twilio_number,
                'body'=> $final_msg,
            )
            );

            $alert_update_query="update booking_details set sms_alert='True' where booking_id='$book_id' ";
            $alert_update_res=mysqli_query($conn,$alert_update_query);

            if($message->sid){
            echo "$book_id \n $username \n $to \n $min";
            }

            // SENDING EMAIL ALERT!!!!!!
            $final_msg="<html><body>
            Dear Sir/Madam,<br>
            Your PARKING with booking id:$book_id <br>
            for spot id: $spot_id<br>
            and area id: $area_id <br>
            expires in 10 min. <br>
            To extend your booking, pls login and get the parking spot in the same area.<br>
            Thanks & Regards,<br>
            Automated Parking <br>
            </body></html>";

            $mail=new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='ssl';
            $mail->Host='smtp.gmail.com';
            $mail->Port='465';
            $mail->isHTML();
            $mail->Username='pewwins1@gmail.com';
            $mail->Password='dypatil@123';
            $mail->SetFrom('mo-reply@parking.com');
            $mail->Subject='Booking & Transaction Details';
            $mail->Body=$final_msg;
            $mail->AddAddress($email);

            $mail->Send();



        }
       }
   }
   sleep($sleep_time);
   
}


?>