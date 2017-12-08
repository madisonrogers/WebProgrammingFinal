<?php 
  session_start();
 ?>

 <?php


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


 ?>