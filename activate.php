
<?php

	if(!empty($_GET["username"])) {
		$user = $_GET["username"];
		if(getPersonIdByUsername($user) != NULL){
			activateUser($user);
			echo "<h1>Your account has been activated</h1>";
			sleep(5);
			header("Location: index.php");
		} else {
			echo "<h1>Permission Denied</h1>";
		}
	}

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