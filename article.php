<!DOCTYPE html5>
<html>
<head>
	<title>Articles</title>
	<!-- All the files that are required -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/article.css">
<link rel="stylesheet" type="text/css" href="css/allarticles.css">
<script src="js/allarticles.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>
<?php
$id = $_GET["id"];
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
                 <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/allarticles.php" ?>">All Articles</a></li>
               <!-- <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/register.php" ?>">Register</a></li> -->
                
                
            </ul>
        </nav>
        <h3 class="text-muted">Article <?php echo "$id";?></h3>
    </div>
<?php
$title = $_GET["title"];
$text = $_GET["text"];

echo "<h1>" . $title . "</h1>";
echo "<article>" . $text . "</article>";
?>

</body>