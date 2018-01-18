 <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/global.css">
<meta charset="UTF-8">
<script type="text/javascript" src="javascript/global.js"></script>
<title> Backlog Management Вход </title>
</head>
<body>
<div class="welcome"
	<h1>Добре дошли в <span id="title"> Backlog Management </span> </h1>
</div>
<div class="header"
	<h1>Вход: </h1>
</div>
	<div class="yellow form" >
		<form type="post" method="post" action="login.php"  accept-charset="UTF-8"> 
			<p> Потребителско име: </p><input type="text" name="userName" id="userName"><br>
			<p> Парола: </p><input type="password" name="password" id="password"><br>
			<input type="submit" value="Вход">
		</form>
	</div>
		<p id="noRowInDB" > </p>
<?php	
	if(isset($_POST['userName']) && isset($_POST['password'])){
		
		include 'request.php';
		$connection = new DbConnection();
		$foundUser = $connection->call_db();
		$newURL = "index.php";
		
		if($foundUser != null) {
			header('Location: '.$newURL);
			//exit();
			//echo '<script type="text/javascript">','clear();','</script>';
		} else {
			echo '<script type="text/javascript">','nothingInDb();','</script>';
		}
	}
?>
</body>
</html>