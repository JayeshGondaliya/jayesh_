<?php
	if (isset($_POST['email'])) {

		$name = strip_tags(trim($_POST["name"]));
	    $name = str_replace(array("\r","\n"),array(" "," "), $name);
	    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
	    $subject = trim($_POST["subject"]);
	    $description = trim($_POST["message"]);
	   	//$subject = "Get in touch";

	    $message = "<table><tr><td>Name</td><td>".$name."</td></tr><tr><td>Email</td><td>".$email."</td></tr><tr><td>Subject</td><td>".$subject."</td></tr><tr><td>Message</td><td>".$description."</td></tr></table>";

	    $message1 = "Thank you for getting in touch! One of our colleagues will get back in touch with you soon. Have a great day!";

	    
		sendMail($email, ucwords($subject),$message,$message1);
		

	}

	// Create PHPMailder function for sent mail

	function sendMail($to, $subject, $message, $message1){

		

		require 'PHPMailerAutoload.php';



		$mail = new PHPMailer(true);

		$mail->SMTPDebug = 3;                                   // Enable verbose debug output

		$mail->isSMTP();                                        // Set mailer to use SMTP

		$mail->Host = 'smtp.gmail.com';   				        // Specify main and backup SMTP servers

		$mail->SMTPAuth = true;                                 // Enable SMTP authentication

        $mail->Username = 'testphp882@gmail.com';                // SMTP username

        $mail->Password = 'Admin@123';                      // SMTP password

		$mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted

		$mail->Port = 587;                                      // TCP port to connect to

		$mail->setFrom($to, 'Contact us');

		$mail->addAddress('testphp882@gmail.com', 'Heinz');  // Add a recipient

		$mail->addAddress('testphp882@gmail.com');    		    // Name is optional

		$mail->addReplyTo($to, 'Contact us');

		$mail->isHTML(true);                                    // Set email format to HTML



		$mail->SMTPOptions = array(

			'ssl' => array(

			'verify_peer' => false,

			'verify_peer_name' => false,

			'allow_self_signed' => true

			)

		);                    

		

		$mail->Subject = $subject;

		$mail->Body    = $message;

		

		$mail2 = new PHPMailer(true);
		$mail2->isHTML();
		$mail2->IsSMTP(); 
		$mail2->Host = 'smtp.gmail.com';   				        // Specify main and backup SMTP servers

		$mail2->SMTPAuth = true;                                 // Enable SMTP authentication

		$mail2->Username = 'testphp882@gmail.com';                // SMTP username

		$mail2->Password = 'Admin@123';                       // SMTP password

		$mail2->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted

		$mail2->Port = 587;        
		$mail2->setFrom('testphp882@gmail.com', 'Heinz'); 
		$mail2->AddAddress($to);
		$mail2->Subject = $subject;
		$mail2->Body = $message1;
		$mail2->Send();



		if($mail->send()) {

		   return true; 

		} else {

		   return false;

		}

	}
	



?>