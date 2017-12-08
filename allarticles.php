<?php 
  session_start();
 ?>
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
<script type="text/javascript" src="css/login.css"></script>
<link rel="stylesheet" type="text/css" href="css/allarticles.css"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>

<header style="text-align:center">
<h1>All Articles</h1>
</header>
<hr>

<table class="articlelist">
  <tr>
	<th>Username</th>
    <th>Article Title</th>
	<th>Article Text</th>
	<th>Time Submitted</th>
  </tr>
  <tr>
<?php
$sqlHost = 'localhost';
$sqlUser = 'madisonrogers';
$sqlPass = 'QCKMEQOY';

$conn =  new mysqli($sqlHost, $sqlUser, $sqlPass, 'f17_madisonrogers') ;
if($conn->connect_errno){
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}

$result = $conn->query("SELECT article_id, username, title, article_text, time_created FROM article, person WHERE fk_person_id = person_id")
        or trigger_error($conn->error);	
		
while ($row = $result->fetch_assoc()) {
		  echo "<td>" . $row["username"] . "</td>";
		  echo "<td>" . $row["title"] . "</td>";
		  echo '<td><a href="article.php?id=' . $row["article_id"] . '&title=' . $row["title"] . '&text=' . $row["article_text"] . '">Click to read</a></td>';
		  echo "<td>" . $row["time_created"] . "</td></tr>";
	    }
?>
</body>