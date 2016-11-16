<?php
$filename = $_GET['path'];

if(file_exists($filename)) {
} else {
	header("HTTP/1.1 404 Not Found");
}
$full = 0;
if(isset($_GET['width'])) {
	$width = $_GET['width'];
}
else {
	if(stristr($filename, '/kd_dir')){
		$full = 1;
	}else{
		$width = 255;
	}
}
if(isset($_GET['height'])) {
	$height = $_GET['height'];
} else {
	if(stristr($filename, '/kd_dir')){
		$full = 1;
	}else{
		$height = 173;
	}
}
if(isset($_GET['cr'])) {
	$compressionRate = $_GET['cr'];
} else {
	$compressionRate = 95;
}

$mimes = array(
	'jpg' => 'jpeg',
	'jpe' => 'jpeg',
	'jpeg' => 'jpeg',
	'gif' => 'gif',
	'png' => 'png'
);

$info = pathinfo($filename);
$extension = strtolower($info['extension']);
$mime = $mimes[$extension];

header("Content-Type: image/jpeg");
if($full == 1){
	$geometry = sprintf(" -geometry %sx%s");
}
else {
	$geometry = sprintf(" -geometry %sx%s", $width, $height);
}

if($mime == 'gif') {
	passthru(sprintf('convert -strip %s %s - | convert -comment \'kddi_copyright=on,copy="NO"\' - jpg:- | convert -quality %s - jpg:-', $geometry, $filename, $compressionRate));
} else {
	passthru(sprintf('convert -strip -quality %s%s %s - | convert -comment \'kddi_copyright=on,copy="NO"\' - -', $compressionRate, $geometry, $filename));
}
?>