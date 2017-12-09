<?php 
  session_start();
 ?>
<?php
		if(isset($_COOKIE["user"])){
		// echo "Value is: " . $_COOKIE["user"];
		
		unset($_COOKIE["user"]);
		setcookie('user', null, -1, '/');
		//echo "Value is: " . $_COOKIE["user"];
	  //  echo "Cookie named is not set!";
		sleep(1);
	    header("Location: index.php");
	} else {
		//echo "no cookie set";
	}

?>