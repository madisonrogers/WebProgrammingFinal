
<?php
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

	// var_dump(getArticlesByUsername('madisonrogers'));

	function addPerson($full_name, $email, $username, $password) {

		if(usernameExists($username) == 403) {
			http_response_code(403);
			return http_response_code();
		}

		$conn = Connect();
		$sql = "INSERT INTO person (full_name, email, username, password, active) VALUES (?, ?, ?, ?, ?)";
		$addPerson = $conn->prepare($sql);
		$active = false;
		$addPerson->bind_param("ssssb", $full_name, $email, $username, $password, $active);
		$addPerson->execute();

		if(!$addPerson) {
			trigger_error('Invalid query' . $conn->error);
		}

		$conn->close();

		$actual_link = "http://$_SERVER[HTTP_HOST]/" . $user . "/WebProgrammingFinal/activate.php?username=" . $username;
		$toEmail = $email;
		$subject = "User Registration Activation Email";
		$content = "Click this link to activate your account. " . $actual_link;
		$mailHeaders = "From: Admin\r\n";
		if(mail($toEmail, $subject, $content, $mailHeaders)) {
			$message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";	
		} else {
			echo "error";
		}
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

	function usernameExists($username) {
		// mysqli_report(MYSQLI_REPORT_ALL);
		$conn = Connect();
		$sql = "SELECT * FROM person WHERE username = ?";
		$usernameExists = $conn->prepare($sql);
		$usernameExists->bind_param("s", $username);
		$usernameExists->execute();

		if(!$usernameExists) {
			trigger_error('Invalid query' . $conn->error);
		} 


		$usernameExists = $usernameExists->get_result();
		if($usernameExists->num_rows > 0) {
			http_response_code(403);
			return http_response_code();
		} else {
			// Get the current response code and set a new one
			http_response_code(200);
			return http_response_code();
		}

		$conn->close();
	}

	function validateUser($username, $password) {
		$conn = Connect();
		$sql = "SELECT * FROM person WHERE username = ? AND password = ?";
		$validateUser = $conn->prepare($sql);
		$validateUser->bind_param("ss", $username, $password);
		$validateUser->execute();

		if(!$validateUser) {
			trigger_error('Invalid query' . $conn->error);
		} 

		$validateUser = $validateUser->get_result();
		if($validateUser->num_rows > 0) {
			http_response_code(200);
			return http_response_code();
		} else {
			http_response_code(403);
			return http_response_code();
		}

		$conn->close();
	}

	function resetPassword($username, $password) {
		$conn = Connect();
		$sql = "UPDATE person SET password = ? WHERE username = ?";
		$updatePassword = $conn->prepare($sql);
		$updatePassword->bind_param("ss", $password, $username);
		$updatePassword->execute();

		if(!$updatePassword) {
			trigger_error('Invalid query' . $conn->error);
		}

		$conn->close();
	}

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
?>



