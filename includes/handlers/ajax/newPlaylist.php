<?php
include("../../config.php");
$title = $_POST['title'];
$id = $_POST['userid'];
$query = mysqli_query($con, "SELECT playlistid, playlistname FROM `playlists` WHERE playlistname = '$title' and userid = '$id'");
if (mysqli_num_rows($query) > 1){
    echo json_encode(mysqli_fetch_array($query));
}
else {
    $query = mysqli_query($con, "INSERT INTO `playlists` VALUES ('','$title','$id')");
    $query = mysqli_query($con, "SELECT playlistid, playlistname, 0 as 'SongsNo' FROM `playlists` WHERE playlistname = '$title' and userid = '$id'");
    echo json_encode(mysqli_fetch_array($query));
}

?>