<?php 
  session_start();
 ?>

<?php
// define variables and set to empty values
$firstErr = $lastErr = $emailErr = $selectErr = $quantityErr = $donateErr = $costErr = "";
$first = $last = $email = $select = $quantity = $donate = $cost = "";
$success = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
  $_SESSION['username'] = $_POST['reg_username'];
  $_SESSION['password'] = $_POST['reg_password'];
  $_SESSION['email'] = $_POST['reg_email'];
  $_SESSION['fullname'] = $_POST['reg_fullname'];
  var_dump($_SESSION);
  $_POST = array();

  header('Location: index.php');
  exit();
  }

}

?>