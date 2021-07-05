<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];
	
	$result = $account->login($username, $password);

	if($result == true) {
		$_SESSION['userLoggedIn'] = $username;
		
		$query =  mysqli_query($con, "SELECT firstname,lastname FROM users WHERE username='$username'");
		$resultArray = mysqli_fetch_array($query);
		$_SESSION['user'] = $resultArray[0] . " " . $resultArray[1];
		
		header("Location: index.php");
	}
}
?>
