<?php 
class Playlist{
    private $con;
    private $username;
    private $userId;
    private $playlists;
    public function __construct($con, $username){
        $this->con = $con;
        $this->username = $username;
        $query = mysqli_query($this->con, "Select userid from users where username = '$this->username'");
        $this->userId = mysqli_fetch_array($query)[0];
        $query = mysqli_query($this->con, 
        "SELECT playlists.playlistid, playlists.playlistname,count(playlistsongs.songid) 
        as 'SongNumber' FROM `playlists` join playlistsongs on playlistsongs.playlistid = playlists.playlistid 
        WHERE playlists.userid = '$this->userId' group by playlistname");
        $this->playlists = mysqli_fetch_all($query,MYSQLI_ASSOC);
        //echo var_dump($this->userId, $username,$this->playlists);
        
    }
    public function getPlaylists(){
        return $this->playlists;
    }
    public function getPlaylist($playlistId){
        foreach($this->playlists as $playlist){
            if ($playlist["playlistid"] == $playlistId) {
                return $playlist;
            }
        }
        return [];
    }
    public function getSongs($playlistId){
        $query = mysqli_query($this->con, "SELECT songsid FROM `playlistsongs` join songs on songs.songsid = playlistsongs.songid where playlistid = '$playlistId'");
	    $resultArray = array();
        foreach(mysqli_fetch_all($query,MYSQLI_NUM) as $row){
            array_push($resultArray,$row[0]);
        }
        return $resultArray;
    }
    public function getCoverArt($playlistId){
        $query = mysqli_query($this->con, 
            "SELECT coverArt from album join songs on 
            songs.albumid = album.albumid where songsid = (SELECT songsid FROM `playlistsongs` join songs on songs.songsid = playlistsongs.songid where playlistid = '$playlistId' limit 1)");
	    $coverArt = mysqli_fetch_all($query,MYSQLI_NUM)[0];
        return $coverArt[0];
    }
    public function removeSongFromPlaylist($playlistId, $songId){
        $query = mysqli_query($this->con, 
        "DELETE FROM playlistsongs WHERE playlistid = '$playlistId' and songid = '$songId';");	
        echo mysqli_error($this->con,$query);
    }
    public function addSongToPlaylist($playlistId, $songId){
        $query = mysqli_query($this->con, 
		"INSERT INTO playlistsongs VALUES ('','$songId','$playlistId')");	
        echo mysqli_error($this->con,$query);
    }
}
?>
