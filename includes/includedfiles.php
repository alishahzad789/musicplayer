<?php
//XHTTP
//index.html
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	include("includes/config.php");
	include("includes/classes/User.php");
	include("includes/classes/Artist.php");
	include("includes/classes/Albums.php");
	include("includes/classes/Song.php");
	include("includes/classes/Playlist.php");

	if(isset($_GET['userLoggedIn'])) {
		$userLoggedIn = new User($con, $_GET['userLoggedIn']);
		$username = $userLoggedIn->getUsername();
		$userId = $userLoggedIn->getId();
		$playlists = new Playlist($con, $username);
		$playlistsAll = $playlists->getPlaylists();
		echo "<script>userId = '".$userId."'</script>";

	}
	else {
		echo "Username variable was not passed into page. Check the openPage JS function";
		exit();
	}
}
else {
	include("includes/header.php");
	include("includes/footer.php");
	$url = $_SERVER['REQUEST_URI'];
	echo "<script>openPage('$url')</script>";
	exit();
}

?>