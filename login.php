 <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/global.css">
<meta charset="UTF-8">
<script type="text/javascript" src="javascript/global.js"></script>
<title> Backlog Management Вход </title>
</head>
<body class="log">
<div class="welcome">
	<h4>Добре дошли в <span id="title"> Backlog Management </span> </h4>
</div>
<div class="header">
	<h1>Вход: </h1>
	<p  class="red" id="error"> </p>
	<div class="yellow form" >
		<form type="post" method="post" action="login.php"  accept-charset="UTF-8"> 
			<p> Потребителско име: </p><input type="text" id="userName" name="userName"><br>
			<p> Парола: </p><input type="password" id="password" name="password"><br>
			<input type="submit" value="Вход">
		</form>
	</div>
</div>
		<p id="noRowInDB" > </p>
<?php	
	if(isset($_POST['userName']) && isset($_POST['password'])){
		
		include 'request.php';
		$connection = new DbConnection();
		$foundUser = $connection->call_db_login();
		$newURL = "index.php";
		
		if($foundUser != null) {
			session_start();
			session_save_path(["session.php"]);
			$_SESSION['user'] = $foundUser[0];
			header('Location: '.$newURL);
			exit();
		} else {
			echo '<script type="text/javascript">','error("Невалидно потребителското име и/или парола.");','</script>';
		}
	}
?>
</body>
</html>