<?php
include("../../config.php");

if(isset($_POST['playlistId'])) {
	$playlistId = $_POST['playlistId'];

	$query = mysqli_query($con, "SELECT songs.* FROM `playlistsongs` join songs on songs.songsid = playlistsongs.songid where playlistid = '$playlistId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}


?>