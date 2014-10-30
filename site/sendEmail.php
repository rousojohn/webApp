<?php
include_once('functions.php');
$toReturn = new stdClass();

if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['msg'])) {
    require_once("mail/class.phpmailer.php");
    require_once("mail/class.phpmailer.php");
			        $mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->Username = ADMINEMAIL;
				$body = htmlentities($_POST['msg']);
				$mail->SetFrom('rousojohn@gmail.com', htmlentities($_POST['name']));
				$mail->AddAddress(ADMINEMAIL, htmlentities($_POST['name']));
				$mail->Subject = htmlentities($_POST['subject']);
				$mail->MsgHTML($body);
    
    $mail->AddReplyTo($_POST['email'],"First Last");
    // Set the password
    $mail->Password = ADMINEMAILPASS;
    if (!$mail->Send()){
        $toReturn->success = false;
        $toReturn->error =  $mail->ErrorInfo;
    }
    else{
        $result->success = true;
        $result->msg = "Message Sent";
    }
}
else {
    $toReturn->success = false;
    $toReturn->error = 'Msg Not Sent';
}

echo json_encode($toReturn);
?>