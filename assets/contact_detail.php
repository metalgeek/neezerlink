<?php

if(!$_POST) exit;

// Email verification, do not edit.
function isEmail($email_detail ) {
	return(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$email_detail ));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$name     = $_POST['name'];
$email   = $_POST['email'];
$mobile    = $_POST['mobile'];
$package  = $_POST['package'];
$duration  = $_POST['duration'];
$comments  = $_POST['comments'];
$verify_contact_detail  = $_POST['verify_contact_detail'];

if(trim($name) == '') {
	echo '<div class="error_message">You must enter your Name.</div>';
	exit();
} else if(trim($email) == '') {
	echo '<div class="error_message">Please enter a valid email address.</div>';
	exit();
} else if(!isEmail($email)) {
	echo '<div class="error_message">You have enter an invalid e-mail address, try again.</div>';
	exit();
} else if(trim($mobile) == '') {
	echo '<div class="error_message">Please enter your phone number.</div>';
	exit();
} else if(!isset($verify_contact_detail) || trim($verify_contact_detail) == '') {
	echo '<div class="error_message"> Please enter the verification number.</div>';
	exit();
} else if(trim($verify_contact_detail) != '4') {
	echo '<div class="error_message">The verification number you entered is incorrect.</div>';
	exit();
}

if(get_magic_quotes_gpc()) {
	$message_detail = stripslashes($message_detail);
}


//$address = "HERE your email address";
$address = "damilareoladipo15@gmail.com";


// Below the subject of the email
$e_subject = 'You\'ve been contacted by ' . $name . '.';

// You can change this if you feel that you need to.
$e_body = "You have been contacted by $name with additional message is as follows." . PHP_EOL . PHP_EOL;
$e_content = "\"$package\"" . PHP_EOL . PHP_EOL;
$e_reply = "You can contact $name via email: $email";

$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );

$headers = "From: $email" . PHP_EOL;
$headers .= "Reply-To: $email" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/plain; charset=utf-8" . PHP_EOL;
$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;

$user = "$email";
$usersubject = "Thank You";
$userheaders = "From: info@domain.com\n";
$usermessage = "Thank you for contact us. We will reply shortly!";
mail($user,$usersubject,$usermessage,$userheaders);

if(mail($address, $e_subject, $msg, $headers)) {

	// Success message
	echo "<div id='success_page' style='padding:25px 0'>";
	echo "<strong >Email Sent.</strong><br>";
	echo "Thank you <strong>$name</strong>,<br> your message has been submitted. We will contact you shortly.";
	echo "</div>";

} else {

	echo 'ERROR!';

}
