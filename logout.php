 <!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/global.css">
		<meta charset="UTF-8">
		<script type="text/javascript" src="javascript/global.js"></script>
		<title> Backlog Management Dashboard </title>
	</head>
	<body class="log">
	<div class="welcome">
		<h4>Успешно излязохте от <span id="title"> Backlog Management</span></h4>
	</div><br><br><br><br>
	<div class="yellow form"> 
		<form type="post" method="post" action="login.php"  accept-charset="UTF-8"> 
			<input type="submit" value="Обратно към Вписване">
		</form>
	</div>
	<?php 
		include 'session.php';
		session_destroy();
	?>
	</body>
</html>