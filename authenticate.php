<?php 
  session_start();
 ?>

 <?php
 	require 'connection.php';
 	function validateUser($username, $password) {
		$conn = Connect();
		$sql = "SELECT * FROM person WHERE username = ? AND password = ?";
		$validateUser = $conn->prepare($sql);
		$validateUser->bind_param("ss", $username, $password);
		$validateUser->execute();

		if(!$validateUser) {
			trigger_error('Invalid query' . $conn->error);
		} 

		$validateUser = $validateUser->get_result();
		if($validateUser->num_rows > 0) {
			http_response_code(200);
			return http_response_code();
		} else {
			http_response_code(403);
			return http_response_code();
		}

		$conn->close();
	}

	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $username = $_POST['reg_username'];
	 $password = $_POST['reg_password'];
	 // $email = $_POST['reg_email'];
	 // $fullname = $_POST['reg_fullname'];
	  
	  $_SESSION['username'] = $username;
	  $_SESSION['password'] = $password;
	  // $_SESSION['email'] = $email;
	  // $_SESSION['fullname'] = $fullname;

	  //include $PATH;
	  validateUser($username, $password);
	  var_dump($_SESSION);
	  $_POST = array();
	}

 ?>