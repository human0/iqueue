<?php
	$subject = "Product Order: ".$_POST['productname']." - ".strftime("%T %D", time());
	$message = $_POST['description'];
	$message = wordwrap($message,70);
	
	$user = User::find_by_id($session->user_id);
	$from_name = $user->username;
	$from = $user->email;
	
	$to_name = "Emmanuel";
	$to = "admin@sparkdt.co";
	// PHPMailer's Object-oriented approach
	$mail = new PHPMailer();
	// Can use SMTP
	// comment out this section and it will use PHP mail() instead
	$mail->IsSMTP();
	//$mail->SMTPSecure = "tls";
	$mail->Host     = "smtp.1and1.com";
	$mail->Port     = 25;
	$mail->SMTPAuth = true;
	$mail->Username = "admin@sparkdt.co";
	$mail->Password = "ASDTaftereffects@1";
	
	// Could assign strings directly to these, I only used the 
	// former variables to illustrate how similar the two approaches are.
	$mail->FromName = $from_name;
	$mail->From     = $from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject  = $subject;
	$mail->Body     = $message;
	
	$result = $mail->Send();
	echo $result ? 'Sent' : 'Error';
	
	//notification modal needed. 
  
?>