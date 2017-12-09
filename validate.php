<?php 
  session_start();
 ?>
 <?php
 	require 'connection.php';

 	function emailExists($email) {
		$conn = Connect();
		$sql = "SELECT * FROM person WHERE email = ?";
		$emailExists = $conn->prepare($sql);
		$emailExists->bind_param("s", $email);
		$emailExists->execute();

		if(!$emailExists) {
			trigger_error('Invalid query' . $conn->error);
		}

		$emailExists = $emailExists->get_result();
		if($emailExists->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}


	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $email = $_POST['rs_email'];
	 
	  //include $PATH;

	 
	 if(emailExists($email)) {
			http_response_code(200);
			return http_response_code();
		} else {
			http_response_code(403);
			return http_response_code();
		}
	  $_POST = array();

	  /*$person = getPersonByUsername($username);
	  $_SESSION['email'] = $person['email'];
	  $_SESSION['fullname'] = $person['full_name'];
	  var_dump($_SESSION);
	  
	  $cookie_name = "user";
	  setcookie($cookie_name, $_SESSION['username'], time() + 600000, "/");*/

	}

 ?>