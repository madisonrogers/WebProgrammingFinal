<?php 
  session_start();
 ?>
 <?php
 	require 'connection.php';

 	function resetPassword($username, $password) {
		$conn = Connect();
		$sql = "UPDATE person SET password = ? WHERE username = ?";
		$updatePassword = $conn->prepare($sql);
		$updatePassword->bind_param("ss", $password, $username);
		$updatePassword->execute();

		if(!$updatePassword) {
			trigger_error('Invalid query' . $conn->error);
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

	  //include $PATH;
	  validateUser($username, $password);
	  $_POST = array();

	  /*$person = getPersonByUsername($username);
	  $_SESSION['email'] = $person['email'];
	  $_SESSION['fullname'] = $person['full_name'];*/
	  var_dump($_SESSION);
	  
	  //$cookie_name = "user";
	  //setcookie($cookie_name, $_SESSION['username'], time() + 60, "/");
	}
?>