<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/global.css">
		<meta charset="UTF-8">
		<script type="text/javascript" src="javascript/global.js"></script>
		<title> Backlog Management Profile</title>
	</head>
<body>
	<div class="welcome">
		<h4>Информация за потребител </h4>
	</div>

	<div class="topnav yellow">
		<a href="index.php">Начало</a>
		<a class="active" href="profile.php">Профил</a>
		<?php
		include 'session.php';
		if($userRole == 'PO') 
			echo '<a href="create.php">Създай задача</a>';
		else
			echo '<a href="tasks.php">Моите задачи</a>';
	?>
		<a href="logout.php">Изход</a>
		<form class="search" type="post" method="post" action="results.php"  accept-charset="UTF-8"> 
			<input id="search" type="text" placeholder="Търси..." name="search">
			<input type="submit" value="Търси">
		</form>
	</div>
	<div class="task">
		<p  class="light-green" id="created"> </p>
		<form class="yellow" type="post" method="post" action="profile.php" accept-charset="UTF-8">
			<p class="info"> Име: <?php include 'session.php'; echo $userName; ?> </p>
			<p class="info"> Роля: <?php include 'session.php'; echo $userRole; ?> </p>
			<p class="info"> E-mail: <?php include 'session.php'; echo $userEmail; ?> </p>
			<p class="info"> Смени парола: <input class="edit" type="password" name="newPassword">
			<input class="edit" type="submit" value="Промени паролата">
		</form>
	</div>
	<?php
		if(isset($_POST['newPassword'])){
			include 'request.php';
			include 'session.php';
			$connection = new DbConnection();
			$connection->change_user_password($userId);
			echo '<script type="text/javascript">','success("Паролата е сменена");','</script>';
			$_POST = array();
		}
	?>
</body>
</html>