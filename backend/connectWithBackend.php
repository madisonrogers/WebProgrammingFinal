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
			return $articles->fetch_assoc();
		}

		$conn->close();
	}

	function addPerson($full_name, $email, $username, $password) {
		$conn = Connect();
		$sql = "INSERT INTO person (full_name, email, username, password) VALUES (?, ?, ?, ?)";
		$addPerson = $conn->prepare($sql);
		$addPerson->bind_param("ssss", $full_name, $email, $username, $password);
		$addPerson->execute();

		if(!$addPerson) {
			trigger_error('Invalid query' . $conn->error);
		} 

		$conn->close();
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

	echo usernameExists('madisonrogers');
	echo usernameExists('maddie');
?>



