<!DOCTYPE html5>
<html>
<head>
	<title>Add Article</title>
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
<link rel="stylesheet" type="text/css" href="addentry.css" />
<link rel="stylesheet" type="text/css" href="css/allarticles.css"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

</head>
<body>
<div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <!--<li role="presentation"><a href="/">Dashboard</a></li>-->
                 <li role="presentation"><a href="<?php echo "allarticles.php" ?>">Go Back to Articles</a></li>
                
                
            </ul>
        </nav>
        <h3 class="text-muted">All Articles</h3>
    </div>
<?php
$newtitle = $newtext = "";
?>

<form action="add_submit.php" method="post">
  <fieldset>
    Article Title: <input class="say" type="text" name="title" value="<?php echo $newtitle;?>" required><br><br>
	Article Text: <input class="say" type="text" name="text" value="<?php echo $newtext;?>" required><br><br>
	<input type="submit" value="Submit">
	<input type="reset" value="Reset">
  </fieldset>
  </body>