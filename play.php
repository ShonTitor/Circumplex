<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
	$titulo = $_GET["titulo"];
	echo '
	<video id="video" controls preload="metadata">
	<source src="videos/'.$titulo.'.mp4" type="video/mp4">
	</video>'
?>
</body>
</html>