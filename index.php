<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

function extension($filename) {
    $explosion = explode(".", $filename);
    return strtolower($explosion[count($explosion)-1]);
}

function filename($filename) {
    $explosion = explode(".", $filename);
    array_pop($explosion);
    return implode(".", $explosion);
}

function quitar_extension(&$file) {
	$file = filename($file);
}

function bg_exec($cmd) {
	pclose(popen("start /B ". $cmd, "r")); 
}

function convert($filename) {
    bg_exec('ffmpeg -i input/'.$filename.' -f mp4 -vcodec libx264 -acodec aac -movflags +faststart videos/'.filename($filename).'.mp4');
}

function make_thumbnail($filename) {
    bg_exec('ffmpeg -i videos/'.$filename.' -ss 00:01:00 -frames:v 1 images/'.filename($filename).'.png');
}

function update() {
	$extensiones = $arrayName = array("3g2","3gp","aaf","asf","avchd","avi","drc","flv","m2v","m4p","m4v","mkv","mng","mov","mp2","mp4","mpe","mpeg","mpg","mpv","mxf","nsv",
											"ogg","ogv","qt","rm","rmvb","roq","svi","vob","webm","wmv","yuv");
	$dir = "input/";
	$input = scandir($dir);
	$dir = "videos/";
	$videos = scandir($dir);
	array_walk($videos, 'quitar_extension');
	$cola = new SplQueue();
	foreach($input as $file) {
		if (!(in_array(filename($file),$videos)) && in_array(extension($file),$extensiones)) {
			$cola->enqueue($file);
		}
	}
	$cmd = "python convert.py";
	while (!$cola->isEmpty()) {
		$file = $cola->dequeue();
		//make_thumbnail($file);
		//$cmd = $cmd." ".$file;
		if ($file != "." && $file != "..") {
			$cmd = $cmd.' "'.$file.'"';
		}
	}
	//bg_exec("srt-vtt -o subs/ input/");
	bg_exec($cmd);
}

function update_thumbnails() {
	$cmd = 'python thumbnail.py';
	$dir = "videos/";
	$input = scandir($dir);
	foreach($input as $file) {
		//make_thumbnail($file);
		if ($file != "." && $file != "..") {
			$cmd = $cmd.' "'.$file.'"';
		}
	}
	//echo "<pre>{$cmd}</pre>";
	bg_exec($cmd);
}

if (array_key_exists("search", $_GET)) {
	$search = $_GET["search"];
}
else {
	$search = "";
}


$update = false;
$clean = false;
if (array_key_exists("update", $_GET)) {
	$update = true;
}
if (array_key_exists("clean", $_GET)) {
	$clean = true;
}

$search = explode(",",$search);

function filtrar($archivo,$busqueda) {
	if (count($busqueda) == 1 && $busqueda[0] =="") {		
		return true;
	}
	$nombre = filename($archivo);
	foreach($busqueda as $palabra) {
		if (strpos($nombre, $palabra) !== false) {
			return true;
		}
	}
	return false;
}
?>
<header>
<a href="index.php" id="logo"><img src="logo.png"/></a>
<form>
	<input type="text" id="search" name="search" method="pre">
	<button onclick="submit()">Buscar</button>
</form>
	<button id="update" onclick="location.href='index.php?update';">Actualizar</button>
	<button id="clean" onclick="location.href='index.php?clean';">Limpiar</button>
</header>
<?php
update_thumbnails();
$videos = scandir("videos/");
$videos_buscados = array();
$j = 0;
foreach($videos as $file) {
		if (extension($file)=="mp4" && filtrar($file,$search)) {
			$videos_buscados[$j] = $file;
			$j = $j+1;
		}
}
$videos_buscados = array_chunk($videos_buscados,4,false);
foreach($videos_buscados as $line) {
	echo "<div class='fila'>";
	foreach($line as $file) {
		echo "<div class='cuadrito'>";
		$filename = filename($file);
		echo substr($filename, 0, 31) . "<br>";
		echo "<a href='play.php?titulo=".urlencode($filename)."''><img src='images/".$filename.".png'/></a>";
		echo "</div>";
	}
	echo "</div>";
}

if ($update) {
	update();
}
if ($clean) {
	//clean();
	echo "no implementado";
}

?>
</body>
</html>