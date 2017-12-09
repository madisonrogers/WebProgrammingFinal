<?php 
  session_start();
 ?>
<!DOCTYPE html5>
<html>
<head>
	<title>Reset Password</title>
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
<?php

// current directory
//echo getcwd() . "\n";
$path = getcwd();
list($one, $two, $three, $four, $user, $root) = split('[/.-]', $path);

//echo "User: $user, path: $root<br />\n";
?>
<div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <!--<li role="presentation"><a href="/">Dashboard</a></li>-->
                 <!-- <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/forgot.php" ?>">Forgot Password</a></li>
                <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/register.php" ?>">Register</a></li> -->
                
                
            </ul>
        </nav>
        <h3 class="text-muted">Reset Password</h3>
    </div>
<!-- Where all the magic happens -->
<!-- LOGIN FORM -->

<div class="row">
<div class="col-4" >
<div class="text-center" style="padding:50px 0">
	<div class="logo">Reset Password</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" class="text-left" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username</label>
						<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Re-Enter Password</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="re-enter password">
					</div>
					<!--<div class="form-group login-group-checkbox">
						<input type="checkbox" id="lg_remember" name="lg_remember">
						<label for="lg_remember">remember</label>
					</div>-->
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>