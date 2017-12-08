<!DOCTYPE html5>
<html>
<head>
	<title>Articles</title>
	<!-- All the files that are required -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/allarticles.js"></script>
<link rel="stylesheet" type="text/css" href="css/article.css"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>

<?php
$id = $_GET["id"];
$title = $_GET["title"];
$text = $_GET["text"];

echo "<h1>" . $title . "</h1>";
echo "<article>" . $text . "</article>";
?>

</body>