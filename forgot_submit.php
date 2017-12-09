<?php 
  session_start();
 ?>
 <?php
 	require 'connection.php';

 // 	function resetPassword($username, $password) {
	// 	$conn = Connect();
	// 	$sql = "UPDATE person SET password = ? WHERE username = ?";
	// 	$updatePassword = $conn->prepare($sql);
	// 	$updatePassword->bind_param("ss", $password, $username);
	// 	$updatePassword->execute();

	// 	if(!$updatePassword) {
	// 		trigger_error('Invalid query' . $conn->error);
	// 	}
	// }

	function emailExists($email) {
		$conn = Connect();
		$sql = "SELECT * FROM person WHERE $email = ?";
		$emailExists = $conn->prepare($sql);
		$emailExists->bind_param("s", $email);
		$emailExists->execute();

		if(!$emailExists) {
			trigger_error('Invalid query' . $conn->error);
		}

		$emailExists = $emailExists->get_result();
		if($emailExists->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function sendResetEmail($email) {
		$path = getcwd();
		list($one, $two, $three, $four, $user, $root) = split('[/.-]', $path);

		$actual_link = "http://$_SERVER[HTTP_HOST]/" . $user . "/WebProgrammingFinal/reset.php?username=" . $username;
		$toEmail = $email;
		$subject = "Password Reset Email";
		$content = "Click this link to reset your password. " . $actual_link;
		$mailHeaders = "From: Admin\r\n";
		if(mail($toEmail, $subject, $content, $mailHeaders)) {
			$message = "Click the link to reset your password.";	
		} else {
			echo "error";
		}
	}
	
 	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $email = $_POST['fp_email'];
	 // $email = $_POST['lg_email'];
	 // $fullname = $_POST['lg_fullname'];
	  
	  $_SESSION['email'] = $email;
	 // $_SESSION['password'] = $password;
	  // $_SESSION['email'] = $email;
	  // $_SESSION['fullname'] = $fullname
	  if(emailExists($email)) {
	  	sendResetEmail($email);
	  } else {
	  	echo "The email does not exist.";
	  }
	  //include $PATH;
	  
	  $_POST = array();

	  /*$person = getPersonByUsername($username);
	  $_SESSION['email'] = $person['email'];
	  $_SESSION['fullname'] = $person['full_name'];*/
	  // var_dump($_SESSION);
	  
	  //$cookie_name = "user";
	  //setcookie($cookie_name, $_SESSION['username'], time() + 60, "/");
	}
?>