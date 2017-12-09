<?php 
  session_start();
 ?>
<?php
	//print_r($_COOKIE);
	if(!isset($_COOKIE["user"])) {
	  //  echo "Cookie named is not set!";
	    header("Location: index.php");
	} else {
	    //echo "Cookie '" . $cookie_name . "' is set!<br>";
	   // echo "Value is: " . $_COOKIE["user"];
	}
?>
<?php

// current directory
//echo getcwd() . "\n";
$path = getcwd();
list($one, $two, $three, $four, $user, $root) = split('[/.-]', $path);

//echo "User: $user, path: $root<br />\n";
?>
<!DOCTYPE html5>
<html>
<head>
	<title>Articles</title>
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
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <!--<li role="presentation"><a href="/">Dashboard</a></li>-->
                 <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/reset_password.php" ?>">Reset Password</a></li>
                <li role="presentation"><a href="<?php echo "/" . $user . "/" . $root . "/logout.php" ?>">Logout</a></li>
                
                
            </ul>
        </nav>
        <h3 class="text-muted">All Articles</h3>
    </div>
<!--<header style="text-align:center">
<h1>All Articles</h1>
</header>
<hr>-->

<table class="articlelist">
  <tr>
    <th>Article Title</th>
	<th>Article Text</th>
	<th>Time Submitted</th>
  </tr>
  <tr>
<?php
// $sqlHost = 'localhost';
// $sqlUser = 'madisonrogers';
// $sqlPass = 'QCKMEQOY';

// $conn =  new mysqli($sqlHost, $sqlUser, $sqlPass, 'f17_madisonrogers') ;
// if($conn->connect_errno){
//     printf("Connect failed: %s\n", $conn->connect_error);
//     exit();
// }

// $result = $conn->query("SELECT article_id, username, title, article_text, time_created FROM article, person WHERE fk_person_id = person_id")
//         or trigger_error($conn->error);	

require "connection.php";
		
function getArticlesByUsername($username) {
		// get the person_id based on the username
		$conn = Connect();
		$sql = "SELECT person_id FROM f17_madisonrogers.person WHERE username = ?";
		$person = $conn->prepare($sql);
		$person->bind_param("s", $username);
		$person->execute();

		if(!$person) {
			trigger_error('Invalid query' . $conn->error);
		}

		$person = $person->get_result();
		if($person->num_rows > 0) {
			$person_id = $person->fetch_assoc()['person_id'];
		}

		// get all the articles based on the person_id
		$sql = "SELECT * FROM f17_madisonrogers.article WHERE fk_person_id = ?";
		$articles = $conn->prepare($sql);
		$articles->bind_param("i", $person_id);
		$articles->execute();

		if(!$articles) {
			trigger_error('Invalid query' . $conn->error);
		}

		$articles = $articles->get_result();
		if($person->num_rows > 0) {
			return $articles;
		}

		$conn->close();
}

$username = $_SESSION['username'];
$result = getArticlesByUsername($username);

while ($row = $result->fetch_assoc()) {
		  echo "<td>" . $row["title"] . "</td>";
		  echo '<td><a href="article.php?id=' . $row["article_id"] . '&title=' . $row["title"] . '&text=' . $row["article_text"] . '">Click to read</a></td>';
		  echo "<td>" . $row["time_created"] . "</td></tr>";
	    }
?>
</body>