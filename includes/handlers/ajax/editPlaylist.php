<?php
include("../../config.php");
if (isset($_POST['songId']) && isset($_POST['playlistname'])){
    $songId = $_POST['songId'];
    $title = $_POST['playlistname'];
    $query = mysqli_query($con, "SELECT songid from 
    playlistsongs join playlists 
    on playlists.playlistid = playlistsongs.playlistid
    where playlistname = '$title' and songid = '$songId';    
    ");
    if (mysqli_num_rows($query) > 0){
        echo json_encode(true);
    }
    else echo json_encode(false);
}

?>