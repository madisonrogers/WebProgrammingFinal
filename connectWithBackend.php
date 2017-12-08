<?php
	require 'connection.php';

	function getPersonById($username) {
		$conn = Connect();

		$sql = "SELECT DISTINCT * FROM f17_madisonrogers.person WHERE username = ?";
		$person = $conn->prepare($sql);
		$person->bind_param("s", $username);
		$person->execute();

		if(!$person) {
			trigger_error('invalid query' . $conn->error)
		}

		$person = $person->get_result();
		if($person->num_rows > 0) {
			echo $person->fetch_assoc()["full_name"];
		}
	}
	
?>