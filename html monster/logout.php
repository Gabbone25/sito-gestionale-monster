<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log out</title>
	<link rel="stylesheet" href="css/css-logout.css">
</head>
<body>
<?php

	session_start();
	$_SESSION = array();
	session_destroy();

?>
	<section>
		<img src="img/logo.png" alt="logo">
		<span>Arrivederci</span>
		<a href="index.php"><button>Home</button></a>
	</section>
</body>
</html>