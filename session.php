<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if(isset($_SESSION['user'])) {
		$userId = $_SESSION['user'][0];
		$userName = $_SESSION['user'][1];
		$userRole = $_SESSION['user'][2];
		$userEmail = $_SESSION['user'][3];
	}
	
?>