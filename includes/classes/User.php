<?php
	class User {

		private $con;
		private $userId;
		private $username;

		public function __construct($con, $username) {
			$this->con = $con;
			$this->username = $username;
			$query = mysqli_query($this->con, "SELECT userid FROM users WHERE username='$this->username'");
			$this->userId = mysqli_fetch_array($query)["userid"];
			//echo var_dump($this->userId,$this->username);
		}

		public function getUsername() {
			return $this->username;
		}
		public function getId(){
			return $this->userId;
		}
		public function getEmail() {
			$query = mysqli_query($this->con, "SELECT email FROM users WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['email'];
		}

		public function getFirstAndLastName() {
			$query = mysqli_query($this->con, "SELECT concat(firstname, ' ', lastname) as 'name'  FROM users WHERE username='$this->username'");
			$row = mysqli_fetch_array($query);
			return $row['name'];
		}

	}
?>