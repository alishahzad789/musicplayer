<?php 
class Song{
    private $con;
    private $id;
    private $mysqliData;
    private $title;
    private $artistId;
    private $albumId;
    private $genre;
    private $duration;
    private $songpath;

    public function __construct($con, $id) {
        $this->con = $con;
        $this->id = $id;

        $query = mysqli_query($this->con, "SELECT * FROM songs WHERE songsid='$this->id'");
        $this->mysqliData = mysqli_fetch_array($query);
        $this->title = $this->mysqliData['title'];
        $this->artistId = $this->mysqliData['artistid'];
        $this->albumId = $this->mysqliData['albumid'];
        $this->genre = $this->mysqliData['genre'];
        $this->duration = $this->mysqliData['duration'];
        $this->songpath = $this->mysqliData['songpath'];
    }

    public function getTitle() {
        return $this->title;
    }

    public function getId() {
        return $this->id;
    }

    public function getArtist() {
        return new Artist($this->con, $this->artistId);
    }

    public function getAlbum() {
        return new Albums($this->con, $this->albumId);
    }

    public function getsongPath() {
        return $this->songpath;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getMysqliData() {
        return $this->mysqliData;
    }

    public function getGenre() {
        return $this->genre;
    }
    public function IsSongLiked($userId, $songId){
        $query = mysqli_query($this->con, "SELECT songid FROM playlists join playlistsongs on playlistsongs.playlistid = playlists.playlistid where 
        playlists.userid = '$userId' and playlists.playlistname = 'Liked' and songid = '$songId'");
        if (mysqli_num_rows($query) != 0){
            return true;
        }
        return false;
    }
}
?>
