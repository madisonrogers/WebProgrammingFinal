<?php 
  session_start();
 ?>


<?php

require "connection.php";
/*// define variables and set to empty values
$firstErr = $lastErr = $emailErr = $selectErr = $quantityErr = $donateErr = $costErr = "";
$first = $last = $email = $select = $quantity = $donate = $cost = "";
$success = true;*/
function addPerson($full_name, $email, $username, $password) {
		if(usernameExists($username) == 403) {
			http_response_code(403);
			return http_response_code();
		}
		
		$conn = Connect();
		$sql = "INSERT INTO person (full_name, email, username, password) VALUES (?, ?, ?, ?)";
		$addPerson = $conn->prepare($sql);
		$addPerson->bind_param("ssss", $full_name, $email, $username, $password);
		$addPerson->execute();

		if(!$addPerson) {
			trigger_error('Invalid query' . $conn->error);
		} 

		$conn->close();
}

function usernameExists($username) {
		// mysqli_report(MYSQLI_REPORT_ALL);
		$conn = Connect();
		$sql = "SELECT * FROM person WHERE username = ?";
		$usernameExists = $conn->prepare($sql);
		$usernameExists->bind_param("s", $username);
		$usernameExists->execute();

		if(!$usernameExists) {
			trigger_error('Invalid query' . $conn->error);
		} 


		$usernameExists = $usernameExists->get_result();
		if($usernameExists->num_rows > 0) {
			http_response_code(403);
			return http_response_code();
		} else {
			// Get the current response code and set a new one
			http_response_code(200);
			return http_response_code();
		}

		$conn->close();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $username = $_POST['reg_username'];
 $password = $_POST['reg_password'];
 $email = $_POST['reg_email'];
 $fullname = $_POST['reg_fullname'];
  
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;
  $_SESSION['email'] = $email;
  $_SESSION['fullname'] = $fullname;

  //include $PATH;
  addPerson($fullname, $email, $username, $password);
  var_dump($_SESSION);
  $_POST = array();

  //header('Location: index.php');
  exit();
  }



?>