<?php
$to = "pavan.jbond@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "pavan0591@gmail.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>