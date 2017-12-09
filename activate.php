<?php 
  session_start();
 ?>
<!DOCTYPE html5>
<html>
<head>
	<title>Login</title>
	<!-- All the files that are required -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js">
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/login.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>
<div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <!--<li role="presentation"><a href="/">Dashboard</a></li>-->
            </ul>
        </nav>
        <h3 class="text-muted">Activate</h3>
    </div>

<?php
require "connection.php";
function activateUser($username) {
	$conn = Connect();
	$sql = "UPDATE person SET active = true WHERE username = ?";
	$activate = $conn->prepare($sql);
	$activate->bind_param("s", $username);
	$activate->execute();

	if(!$activate) {
		trigger_error('Invalid query' . $conn->error);
	}

	$conn->close();
}
$username = $_GET['username'];

activateUser($username);
echo "<div class=logo>Account Activation Complete.</div>";
echo "Your account has been activated. You will be redirected to the login page momentarily.";

$path = getcwd();
list($one, $two, $three, $four, $user, $root) = split('[/.-]', $path);

// $actual_link = "http://$_SERVER[HTTP_HOST]/" . $user . "/WebProgrammingFinal/index.php";
header('Refresh: 4; index.php');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>
