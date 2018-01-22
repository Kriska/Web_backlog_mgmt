<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/global.css">
<meta charset="UTF-8">
<script type="text/javascript" src="javascript/global.js"></script>
<title> Backlog Management User Tasks </title>
</head>
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
			<a class="active" href="tasks.php">Моите задачи</a>
			<a href="logout.php">Изход</a>
		  <form class="search" type="post" method="post" action="results.php"  accept-charset="UTF-8"> 
			<input id="search" type="text" placeholder="Търси..." name="search">
			<input type="submit" value="Търси">
			</form>
		</div>

		<table id="results">
			<tr>
				<th>Приоритет</th>
				<th>Име</th>
				<th>Описание</th>
				<th>Работено по задачата (в часове)</th>
				<th>Краен срок</th>
			</tr>
		<?php
			include 'request.php';
			include 'session.php';
			$connection = new DbConnection();
			$userTasks = $connection->find_user_tasks($userId);
			foreach($userTasks as &$item) {
					 $title = $item['title'];
					 $desc = $item['description'];
					 $hours = $item['logHours'];
					 $dueDate = $item['dueDate'];
					 $done = $item['done'];
					 $priority = $item['priority'];
					 if($done == 0 || $done == 1) {
						 echo  "<tr><td>".$priority.'</td>
									<td><a id="link" href="task.php?task='.$title.'">'.$title."</td>
									<td>".$desc."</td>
									<td>".$hours."</td>
								<td>".$dueDate."</td></tr>";
					}
				} ?>
		</table>
		</div>

	</body>
</html>