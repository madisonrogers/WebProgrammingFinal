<!DOCTYPE html5>
<html>
<head>
	<title>Add Confirm</title>
	<!-- All the files that are required -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js">
<link rel="stylesheet" type="text/css" href="css/login.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/allarticles.js"></script>
<script type="text/javascript" src="css/login.css"></script>
<link rel="stylesheet" type="text/css" href="css/allarticles.css"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>

<?php
session_start();
require "connection.php";

function getPersonByUsername($username) {
		$conn = Connect();
		$sql = "SELECT * FROM f17_madisonrogers.person WHERE username = ?";
		$person = $conn->prepare($sql);
		$person->bind_param("s", $username);
		$person->execute();
		if(!$person) {
			trigger_error('Invalid query' . $conn->error);
		}

		$person = $person->get_result();
		if($person->num_rows > 0) {
			return $person->fetch_assoc();
		}

		$conn->close();
	}
	
function getPersonIdByUsername($username) {
		$user = getPersonByUsername($username);
		return $user["person_id"];
	}
	
function addArticle($username, $title, $text) {
		// mysqli_report(MYSQLI_REPORT_ALL);
		$id = getPersonIdByUsername($username);
		$conn = Connect();
		$time_created = (string)date('m/d/Y h:i:s', time());
		
		$sql = "INSERT INTO article (fk_person_id, title, article_text, time_created) VALUES (?,?,?,?)";
		$addArticle = $conn->prepare($sql);
		$addArticle->bind_param("isss", $id, $title, $text, $time_created);
		$addArticle->execute();

		if(!$addArticle) {
			trigger_error('Invalid query' . $conn->error);
		} 

		$conn->close();
	}
	
$username = $_SESSION['username'];
$result = addArticle($username, $_POST["title"], $_POST["text"]);

echo "<h1>Your article has been successfully added</h1>";
?>