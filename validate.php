<?php 
  session_start();
 ?>
 <?php
 	require 'connection.php';



	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $email = $_POST['rs_email'];
	 
	  //include $PATH;
	  validateEmail($email);
	  $_POST = array();

	  /*$person = getPersonByUsername($username);
	  $_SESSION['email'] = $person['email'];
	  $_SESSION['fullname'] = $person['full_name'];
	  var_dump($_SESSION);
	  
	  $cookie_name = "user";
	  setcookie($cookie_name, $_SESSION['username'], time() + 600000, "/");*/
	  
	}

 ?>