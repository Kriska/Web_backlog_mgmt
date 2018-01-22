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

	<a class="active" href="index.php">Начало</a>
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

		<table id="results">
			<tr>
				<th>Нестартирани</th>
				<th>Започнати</th>
				<th>Завършени</th>
			</tr>
		<?php
			include_once 'request.php';
			include 'session.php';
			$connection = new DbConnection();
			$userTasks = $connection->find_dashboard_tasks();
			foreach($userTasks as &$item) {
					 $id = $item['id'];
					 $title = $item['title'];
					 $desc = $item['description'];
					 $dueDate = $item['dueDate'];
					 $done = $item['done'];
					 $priority = $item['priority'];
					 if($done == 0) {
						 echo  '<tr><td ondrop="drop(event)" ondragover="allowDrop(event)"><a id='.$id.' draggable="true" ondragstart="drag(event)" href="task.php?task='.$title.'">'.$title.'</td>
									<td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
									<td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
								</tr>';
					}			
					if($done == 1) {
						 echo  '<tr><td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
									<td ondrop="drop(event)" ondragover="allowDrop(event)"><a id='.$id.' draggable="true" ondragstart="drag(event)" href="task.php?task='.$title.'">'.$title.'</td>
									<td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
								</tr>';
					}
					if($done == 2) {
						 echo  '<tr><td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
									<td ondrop="drop(event)" ondragover="allowDrop(event)"></td>
									<td ondrop="drop(event)" ondragover="allowDrop(event)"><a id='.$id.' draggable="true" ondragstart="drag(event)" href="task.php?task='.$title.'">'.$title.'</td>
								</tr>';
					}
				} ?>
		</table>
</body>
</html>