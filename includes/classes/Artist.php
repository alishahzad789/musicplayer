<?php
	class Artist {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function getName() {
			$artistQuery = mysqli_query($this->con, "SELECT artistname FROM artist WHERE artistid='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['artistname'];
		}
		
		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT songsid FROM songs WHERE artistid='$this->id' order by likes desc limit 10");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['songsid']);
			}

			return $array;

		}
	}
?>