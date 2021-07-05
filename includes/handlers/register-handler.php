<?php 

function sanitizeFormPassword($inputText) {
	$inputText = strip_tags($inputText);
	return $inputText;
}

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}


if(isset($_POST['registerButton'])) 
{
	//Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$firstName = sanitizeFormString($_POST['firstName']);
	$lastName = sanitizeFormString($_POST['lastName']);
	$email = sanitizeFormString($_POST['email']);
	$password = sanitizeFormPassword($_POST['password']);
	$country= $_POST['country'];

	$wasSuccessful = $account->register($username, $firstName, $lastName, $email, $password,$country);

	if($wasSuccessful == true) {
		$_SESSION['userLoggedIn'] = $username;
		$query =  mysqli_query($con, "SELECT firstname,lastname,userid FROM users WHERE username='$username'");
		$resultArray = mysqli_fetch_array($query);
		$_SESSION['user'] = $resultArray[0] . " " . $resultArray[1];
		$userId = $resultArray[2];
		$query =  mysqli_query($con, "INSERT INTO `playlists`(`playlistid`, `playlistname`, `userid`) VALUES ('','Liked','$userId')");
		
		header("Location: index.php");
	}

}


?>