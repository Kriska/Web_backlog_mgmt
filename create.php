<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/global.css">
<meta charset="UTF-8">
<script type="text/javascript" src="javascript/global.js"></script>
<title> Backlog Management Task Creation </title>
</head>
<body>
<body>
<div class="welcome"><h4>
		<?php
		include 'session.php';
		if(isset($userName)){
			echo 'Здравей, <span id="title">'.$userName.'</span>';
		}else {
			header("HTTP/1.1 401 Unauthorized");
			exit;
		}
		?></h4>
</div>

<div class="topnav yellow">

	<a href="index.php">Начало</a>
	<a href="profile.php">Профил</a>
	<a class="active" href="create.php">Създай задача </a>
	<a href="logout.php">Изход</a>
  <form class="search" type="post" method="post" action="results.php"  accept-charset="UTF-8"> 
	<input id="search" type="text" placeholder="Търси..." name="search">
	<input type="submit" value="Търси">
	</form>
</div>
<div class="task">
	<p  class="light-green" id="created"> </p>
	<p  class="red" id="error"> </p>
	<form id="createForm" class="yellow taskCreation" type="post" method="post" action="" onsubmit="return validateForm()" accept-charset="UTF-8">
	Заглавие: <input id="title" type="text" name="title">
	<p> Описание:</p><textarea id="desc" name="desc"></textarea><br>
	Препрати на:<select id="assignee" name="assignee">
							<option value="Пенда">Пенда</option>
							<option value="Иван">Иван</option>
							<option value="Мария">Мария</option>
						</select><br>
	Краен срок: (yyyy-mm-dd) <input id="date" name="date" type="text"><br>	
	Приоритет:<select  id="priority" name="priority">
							<option value="S">S</option>
							<option value="M">M</option>
							<option value="L">L</option>
							<option value="XL">XL</option>
						</select><br>
			
	<input type="submit" value="Създай">
	</form>
</div>
</body>

<?php
	if(isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['assignee']) && isset($_POST['date']) && isset($_POST['priority'])){
		include 'request.php';
		include 'session.php';
		$creatorId = $userId;
		$connection = new DbConnection();
		$connection->call_db_insert_task_from($creatorId);
		$_POST = array();
		echo '<script type="text/javascript">','success("Задачата е създадена");','</script>';
	}
?>

</html>