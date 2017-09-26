<?php 
require 'PHPMailerAutoload.php';

function send_mail($to, $title, $content){
	//Create a new PHPMailer instance
	$mail = new PHPMailer;

	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	$mail->isHTML(true);

	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;

	//Ask for HTML-friendly debug output

	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6

	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 465;

	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'ssl'; 
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	$mail->CharSet = 'UTF-8';

	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "phammanh.1221998@gmail.com";

	//Password to use for SMTP authentication
	$mail->Password = "qdlwqfnpqskoapoy";

	//Set who the message is to be sent from
	$mail->setFrom('phammanh.1221998@gmail.com', get_web_title());

	//Set an alternative reply-to address
	$mail->addReplyTo('phammanh.1221998@gmail.com', get_web_title());

	$mail->addAddress($to);
	$mail->Subject = $title;

	$mail->AltBody = $title;
	$mail->Body    = $content;

	//send the message, check for errors
	if (!$mail->send()) {
	    return false;
	}
	return true;
}

?>