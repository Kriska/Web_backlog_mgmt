<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<meta charset="UTF-8">
	<script type="text/javascript" src="javascript/global.js"></script>
	<title> Backlog Management Task</title>
</head>
<body>
<?php
	if(!isset($_GET['task'])) {
		header("HTTP/1.1 401 Unauthorized");
		exit;
	}
	include 'request.php';
	include 'session.php';
	$connection = new DbConnection();
	$result = $connection->find_task_by_name($_GET['task']);
	$_GET['desc'] = $result[0]['description'];
	$_GET['dueDate'] = $result[0]['dueDate'];
	$_GET['priority'] = $result[0]['priority'];
	$_GET['logHours'] = $result[0]['logHours'];
?>
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
	<?php
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
	
	<p  class="red" id="error"> </p>
	<form id="createForm" class="yellow taskCreation" type="post" method="post" action="task.php?task=<?php echo $_GET['task']; ?>" accept-charset="UTF-8">
	<p class="info">Приоритет: <?php   echo $_GET['priority']; ?></p>
	<p class="info">Заглавие: <?php   echo $_GET['task']; ?></p>
	<p class="info">Описание: <?php   echo $_GET['desc']; ?></p><br>
	<p class="info">Въведени часове: <?php   echo $_GET['logHours']; ?></p>
	<p class="info">Въведи часове:	<select id="assignee" name="logHours">
							<option value="1">1</option>	<option value="2">2</option>
							<option value="3">3</option>	<option value="4">4</option>
							<option value="5">5</option>	<option value="6">6</option>
							<option value="7">7</option>	<option value="8">8</option></select>
						<input class="edit" type="submit" value="Въведи часове"></p>
	<p class="info">Краен срок: <?php   echo $_GET['dueDate']; ?></p>
	<input class="complete" type="submit" value="Завърши задачата" name="completeTask">
	</form>
</div>
	<?php
		if(isset($_POST['logHours'])) {
			$connection->log_hours_on_task($_GET['task'], $_POST['logHours']);
			echo '<script type="text/javascript">','success("Часовете са въведени");','</script>';
		}
		if(isset($_POST['completeTask'])) {
				$connection->complete_task($_GET['task']);
				echo '<script type="text/javascript">','success("Задачата е завършена");','</script>';
				$_POST = array();
		}
	?>
</body>
</html>