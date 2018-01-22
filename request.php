<?php
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
		
		public function call_db_login() {
			$result = $this->find_login_users();
			if(count($result) > 0) {
				return $result;
			} else {
				return null;
			}
		}
		public function find_login_users() {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);

			$stmt = $dbh->prepare("SELECT id,userName,role,email from users WHERE users.userName = :userName AND users.password = :password");
			$stmt->bindParam(':userName', $_POST['userName']);
			$stmt->bindParam(':password', $_POST["password"]);
			$stmt->execute();
			
			$result = $stmt->fetchAll();
			
			if(count($result) > 0) {
				return $result;
			}
			return null;
			
			$dbh = null;
		}
		public function call_db_insert_task_from($creatorId) {
			$result = $this->find_users_id_by_name($_POST['assignee']);
			$assigneeId = $result[0][0];
			$this->insert_task($creatorId,$assigneeId);
		}

		public function find_users_id_by_name($userName) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);

			$stmt = $dbh->prepare("SELECT id FROM users WHERE userName = :userName");
			$stmt->bindParam(':userName', $userName);
			$stmt->execute();
			
			$result = $stmt->fetchAll();
			
			if(count($result) > 0) {
				return $result;
			}
			return null;
			$dbh = null;
		}

		public function insert_task($creatorId, $assigneeId) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);

			$stmt = $dbh->prepare("INSERT INTO tasks(title, description, creatorId, assigneeId, priority, dueDate)
									VALUES(:title, :description, :creatorId, :assigneeId, :priority, :date)");
			$stmt->bindParam(':title', $_POST['title']);
			$stmt->bindParam(':description', $_POST['desc']);
			$stmt->bindParam(':creatorId', $creatorId);
			$stmt->bindParam(':assigneeId', $assigneeId);
			$stmt->bindParam(':priority', $_POST['priority']);
			$stmt->bindParam(':date', $_POST['date']);
			
			$stmt->execute();
			
			$dbh = null;
		}

		public function change_user_password($userId) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("UPDATE users SET password = :password WHERE id = :userId");
			$stmt->bindParam(':password', $_POST['newPassword']);
			$stmt->bindParam(':userId', $userId);
			$stmt->execute();
			$dbh = null;
		}

		public function find_all_tasks() {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("SELECT title, description, u.userName, logHours, dueDate, done, priority
								FROM tasks JOIN users u ON assigneeID = u.Id
								WHERE title LIKE ?
								ORDER BY FIELD(priority, 'XL', 'L','M', 'S')");
			$stmt->bindValue(1, "%".$_POST['search']."%", PDO::PARAM_STR);
			$stmt->execute();

			$result = $stmt->fetchAll();
			return $result;
			$dbh = null;
		}
		
		public function find_user_tasks($userId) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("SELECT title, description, logHours, dueDate, done, priority from tasks WHERE assigneeId = :assigneeId");
			$stmt->bindParam(':assigneeId', $userId);
			$stmt->execute();
			
			$result = $stmt->fetchAll();
		
			return $result;
			$dbh = null;
		}
		
		public function find_task_by_name($taskName) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("SELECT description, logHours, dueDate, done, priority from tasks WHERE title = :taskName");
			$stmt->bindParam(':taskName', $taskName);
			$stmt->execute();
			
			$result = $stmt->fetchAll();
		
			return $result;
			$dbh = null;
		}
		
		public function log_hours_on_task($taskName, $logHours) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("UPDATE tasks SET logHours = :logHours WHERE title = :taskName");
			$stmt->bindParam(':taskName', $taskName);
			$stmt->bindParam(':logHours', $logHours);
			$stmt->execute();
			
			$dbh = null;
		}
		
		

		public function complete_task($taskName) {
			$dbh = new PDO("mysql:host=$this->host; dbname=$this->db; charset=utf8", $this->user, $this->pass);
			
			$stmt = $dbh->prepare("UPDATE tasks SET done = 2 WHERE title = :taskName");
			$stmt->bindParam(':taskName', $taskName);
			$stmt->execute();
			
			$dbh = null;
		}
		
	}
?>