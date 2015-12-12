<?php
$to = "YOUR EMAIL@YOUR DOMAIN.com";
$email = $_REQUEST['email'] ;
$name = $_REQUEST['name'] ;
$site = $_REQUEST['site'] ;
$subject = "Message from: $name";
$message = $_REQUEST['message'] ;
$headers = "noreply@YOURWEBSITE.com";
$body = "From: $name \n\n Email: $email \n\n Wesbite: $site \n\n Message: $message";
$sent = mail($to, $subject, $body, $headers) ;
if($sent)
{echo "<script language=javascript>window.location = 'LINK BACK TO CONTACT PAGE';</script>";}
else
{echo "<script language=javascript>window.location = 'LINK BACK TO CONTACT PAGE';</script>";}
?>