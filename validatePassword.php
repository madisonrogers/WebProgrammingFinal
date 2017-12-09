<?php 
require "connection.php";
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

function passwordDifferent($username, $password) {
	$conn = Connect();
	$sql = "SELECT password FROM person WHERE username = ?";
	$pass = $conn->prepare($sql);
	$pass->bind_param("s", $username);
	$pass->execute();

	if(!$pass) {
		trigger_error('Invalid query' . $conn->error);
	}

	$pass = $pass->get_result();
	if($pass->num_rows > 0) {
		if($pass->fetch_assoc()['password'] == $password) {
			return false;
		} else {
			return true;
		}
	}

}

$username = $_POST['reset_username'];
$password = $_POST['reset_password'];


if(passwordDifferent($username, $password)) {
	resetPassword($username, $password);
	http_response_code(200);
	return http_response_code();
} else {
	http_response_code(403);
	return http_response_code();
}

?>