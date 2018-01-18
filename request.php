<?php
	class Login {
		public $success;
		public $userName;
		public $password;

		function __construct($_userName, $_password) {
			$this->userName = $_userName;
			$this->password = $_password;
		}
	}
	class DbConnection {
		
	public $host;
	public $db;
	public $user;
	public $pass;
	
	function __construct() {
		$this->host = "localhost";
		$this->db = "backlog_mgmgt";
		$this->user = "root";
		$this->pass = "";
	}
		
		public function call_db() {
			$result = $this->find_user();
			if(count($result) > 0) {
				$this->insert_login($result[0][0]);
				return $result;
			} else {
				return null;
			}
		}
		public function find_user() {
			$login = new Login($_POST["userName"], $_POST["password"]);

			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);

			// use the connection here
			$stmt = $dbh->prepare("SELECT id from users WHERE users.userName = :userName AND users.password = :password");
			$stmt->bindParam(':userName', $login->userName);
			$stmt->bindParam(':password', $login->password);
			$stmt->execute();
			
			$result = $stmt->fetchAll();
			
			if(count($result) > 0) {
				return $result;
			}
			return null;
			
			$dbh = null;
		}
		public function insert_login($userId) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("INSERT INTO logins (userId) VALUES(:userId)");
				$stmt->bindParam(':userId', $userId);
				$stmt->execute();
				
			$dbh = null;
		}
	}
?>