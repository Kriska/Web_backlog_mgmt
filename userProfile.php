<?php
	class UserProfile {
		public $name;
		public $role;
		
		function __construct($_userName, $_userRole) {
			$this->name = $_userName;
			$this->role = $_userRole;
		}
	}
	
	$userProfile;
?>