<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/global.css">
<meta charset="UTF-8">
<script type="text/javascript" src="javascript/global.js"></script>
<title> Backlog Management Dashboard </title>
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
		<?php
			if(isset($_POST['search'])){
				include 'request.php';
				$connection = new DbConnection();
				$_GET = $connection->find_all_tasks();
			}
		?>

		<table id="results">
			<tr>
				<th>Приоритет</th>
				<th>Име</th>
				<th>Описание</th>
				<th>Отговорник</th>
				<th>Работено по задачата (в часове)</th>
				<th>Краен срок</th>
			</tr>
			<?php
				foreach($_GET as &$item) {
					 $title = $item['title'];
					 $desc = $item['description'];
					 $assignee = $item['userName'];
					 $hours = $item['logHours'];
					 $dueDate = $item['dueDate'];
					 $done = $item['done'];
					 $priority = $item['priority'];
					 echo  "<tr><td>".$priority.'</td>
								<td><a id="link" href="task.php?task='.$title.'">'.$title."</td>
								<td>".$desc."</td>
								<td>".$assignee."</td>
								<td>".$hours."</td>
								<td>".$dueDate."</td></tr>";
					$jsVar = json_encode($done, JSON_HEX_TAG | JSON_HEX_AMP);
					echo '<script type="text/javascript">','crossDoneTasks(',$jsVar,');','</script>';
				} ?>
		</table>
		</div>

	</body>
</html>