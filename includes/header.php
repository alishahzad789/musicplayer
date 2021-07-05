
<!DOCTYPE html>
<?php
include("includes/config.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Albums.php");
include("includes/classes/Song.php");
include("includes/classes/Playlist.php");
//session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
	$username = $userLoggedIn->getUsername();
	$userId = $userLoggedIn->getId();
	$playlists = new Playlist($con, $username);
	$playlistsAll = $playlists->getPlaylists();
	echo "<script>userLoggedIn = '$username'</script>";
	echo "<script>userId = '".$userId."'</script>";
}
else {
	header("Location: register.php");
}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Music Player</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="assets/js/script.js"></script>
</head>
<body>
<div id="mainContainer">
		<div id="topContainer">
			<?php include("sidebar.php")?>
			<div id="mainViewContainer">
				<div id="mainContent">
