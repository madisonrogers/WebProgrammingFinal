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

	function getPersonByUsername($username) {
		$conn = Connect();
		$sql = "SELECT * FROM f17_madisonrogers.person WHERE username = ?";
		$person = $conn->prepare($sql);
		$person->bind_param("s", $username);
		$person->execute();
		if(!$person) {
			trigger_error('Invalid query' . $conn->error);
		}

		$person = $person->get_result();
		if($person->num_rows > 0) {
			return $person->fetch_assoc();
		}

		$conn->close();
	}

	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $username = $_POST['lg_username'];
	 $password = $_POST['lg_password'];
	 // $email = $_POST['lg_email'];
	 // $fullname = $_POST['lg_fullname'];
	  
	  $_SESSION['username'] = $username;
	  $_SESSION['password'] = $password;
	  // $_SESSION['email'] = $email;
	  // $_SESSION['fullname'] = $fullname

	  //include $PATH;
	  validateUser($username, $password);
	  $_POST = array();

	  $person = getPersonByUsername($username);
	  $_SESSION['email'] = $person['email'];
	  $_SESSION['fullname'] = $person['full_name'];
	  var_dump($_SESSION);
	  
	  $cookie_name = "user";
	  setcookie($cookie_name, $_SESSION['username'], time() + 60, "/");
	}

 ?>