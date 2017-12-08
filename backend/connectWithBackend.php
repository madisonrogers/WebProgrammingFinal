<?php
	require "connection.php";

	function getUserByUsername($username) {
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

	echo var_dump(getArticlesByUsername("madisonrogers"));

	// function addUser($full_name, $email, $username, $password) {

	// }
?>