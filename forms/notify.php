<?php
ini_set ('max_execution_time',0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include the PHPMailer files from the 'src' directory
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';// optional, gets called from within class.phpmailer.php if not already loaded

if($_POST['formname'] == 'registration'){
	
	$name  = $_POST['firstname'];
	$email  = $_POST['email'];
	$subject  = $_POST['phone'];
	$message  = $_POST['message'];

	$body = '<html><body>';
	$body = '<div style="background:#fff;border:1px solid #bbb;padding: 20px;max-width: 600px;box-shadow: 0 2px 3px #bbb;margin: 0 auto;border-radius: 5px;">';
	$body .= '<h1 style="color:#0A346E;font-size: 21px;margin-top:0;">Contact Form!</h1>';
	$body .= '<h3 style="color:#004fa1;font-weight: normal;padding-bottom: 10px;">Contact details,</h3>';


	$body .= '<table style="color: #000;border: 1px solid #ccc;font-weight: normal;width: 100%;border-collapse: collapse;background:#f5f5f5;">';
	$body .= '<tr style=""><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">Name</td><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">'.$name.'</td></tr>';
	$body .= '<tr style=""><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">Email</td><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">'.$email.'</td></tr>';
	$body .= '<tr style=""><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">Phone Number</td><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">'.$subject.'</td></tr>';
	$body .= '<tr style=""><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">Message</td><td style="width: 50%;padding: 10px;border: 1px solid #ccc;font-size: 14px;color: #1a1919;">'.$message.'</td></tr>';
	$body .= '</table>';

	$body .= '</div>';
	$body .= '</body></html>';

	$subject = 'Contact Form';

	sendmail(null, $subject, $body);
	
}
function sendmail($fromAddress = null, $subject, $messageBody, $file_name = null){
	$mail             = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
	//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "mailwork970@gmail.com";      // username
	$mail->Password   = "inkn cmbf oqiz wvtx";      //  password
 	$address = "mailwork970@gmail.com";// To mail address
if($fromAddress != null){
$mail->SetFrom($fromAddress);
}else{
 $mail->SetFrom($address);   
}

	//$mail->AddReplyTo("user2@gmail.com', 'First Last");

	$mail->Subject    = $subject;
	if($file_name != null){
	$mail->AddAttachment("../upload/".$file_name);
}
	

	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


	$mail->MsgHTML($messageBody);


	$mail->AddAddress($address);

	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}
}

?>