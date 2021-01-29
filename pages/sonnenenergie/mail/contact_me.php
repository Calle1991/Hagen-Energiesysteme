<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }


echo ($_POST['token']);


if(isset($_POST['token'])){
 $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfdOkEaAAAAAExnMrlKF9Bz51Jaw38BYjAaM17s&response=".$_POST['token']);
 $request = json_decode($request);
   if($request->success == true){
      if($request->score >= 0.6){
         $name = $_POST['name'];
         $email_address = $_POST['email'];
         $message = $_POST['message'];

         // Create the email and send the message
         $to = 'info@hagen-energiesysteme.de'; //--- info@hagen-energiesysteme.de --- Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
         $email_subject = "Sonnenenergie - Kontakt:  $name";
         $email_body = "Sie haben eine Nachricht von der Webseite Hagen Energiesysteme - Ladestation erhalten \n\n"."Hier sind die Details:\n\nName: $name\n\nEmail: $email_address\n\nNachricht:\n$message";
         $headers = "From: noreply@hagen-energiesysteme.de\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
         $headers .= "Reply-To: $email_address";	
         mail($to,$email_subject,$email_body,$headers);
      }
      echo ("Es gab ein Problem mit der reCAPTCHA abfrage. Schreiben Sie uns bitte über info@hagen-energiesysteme.de");
   }

}



return true;	
?>