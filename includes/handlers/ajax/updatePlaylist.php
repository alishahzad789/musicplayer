<?php
include("../../config.php");

if(isset($_POST['songId'])) {
	$songId = $_POST['songId'];
	$playlistid = $_POST['playlistid'];
	$user = $_POST['userId'];
	if ($playlistid == -1){
		$query = mysqli_query($con, 
		"SELECT playlistid FROM playlists WHERE playlistname = 'Liked' AND userid = '$user'");
		$playlistid = mysqli_fetch_array($query)["playlistid"];
		$query = mysqli_query($con, "UPDATE `songs` SET likes = (SELECT likes from songs where songsid = '$songId') + 1 WHERE songsid = '$songId';");
	}
	if (isset($_POST['remove'])){			
			$query = mysqli_query($con, 
			"DELETE FROM playlistsongs WHERE playlistid = '$playlistid' and songid = '$songId';");	
			$query = mysqli_query($con, 
			"SELECT playlistid FROM playlistsongs WHERE playlistid = '$playlistid';");
			if (mysqli_num_rows($query) <= 0){
				$query = mysqli_query($con, 
				"DELETE FROM playlists WHERE playlistid = '$playlistid' AND playlistname != 'Liked'");
			}
	}else {
		$query = mysqli_query($con, 
		"SELECT * FROM playlistsongs WHERE playlistid = '$playlistid' and songid = '$songId'");
		if (mysqli_num_rows($query) > 0){
			echo "false";
			exit();
		};
		$query = mysqli_query($con, 
		"INSERT INTO playlistsongs VALUES ('','$songId','$playlistid')");
		echo "true";
	}			
}
?>