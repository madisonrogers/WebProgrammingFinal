<?php 
  session_start();
 ?>
<!DOCTYPE html5>
<html>
<head>
	<title>Forgot</title>
	<!-- All the files that are required -->
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
                 <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/index.php" ?>">Login</a></li>
                <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/register.php" ?>">Register</a></li>
                
                
            </ul>
        </nav>
        <h3 class="text-muted">Forgot Password</h3>
    </div>
<!-- FORGOT PASSWORD FORM -->
<div class="text-center" style="padding:50px 0">
	<div class="logo">forgot password</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="forgot-password-form" class="text-left">
			<div class="etc-login-form">
				<p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
			</div>
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="fp_email" class="sr-only">Email address</label>
						<input type="text" class="form-control" id="fp_email" name="fp_email" placeholder="email address">
					</div>
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>already have an account? <a href="<?php echo "/" . $user . "/" . $root . "/" ?>">login here</a></p>
				<p>new user? <a href="<?php echo "/" . $user . "/" . $root . "/register.php" ?>">create new account</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>