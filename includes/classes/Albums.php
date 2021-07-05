<?php 
    class Albums{
        private $con;
		private $id;
		private $title;
		private $artistId;
		private $Songs;	
		private $coverArt;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM album WHERE albumid='$this->id'");
			$album = mysqli_fetch_array($query);

			$this->title = $album['albumname'];
			$this->artistId = $album['artistid'];
			$this->coverArt = $album['coverart'];

			$query = mysqli_query($this->con, "SELECT songsid from songs where albumid = $this->id");			
			$this->Songs = array();
			foreach(mysqli_fetch_all($query,MYSQLI_NUM) as $row){
				array_push($this->Songs,$row[0]);
			}
		}
		public function getNumberOfSongs(){
			return sizeof($this->Songs);
		}
		public function getTitle() {
			return $this->title;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}
		public function getcoverArt() {
			return $this->coverArt;
		}
		public function getSongIds(){
			return $this->Songs;
		}
    }

?>