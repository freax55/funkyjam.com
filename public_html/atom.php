<?php
header('Content-type: text/xml');

if (isset($_REQUEST['date']) && preg_match('/^([0-9]{4})([0-9]{2})([0-9]{2})$/', $_REQUEST['date'], $matches)) {
	$today = getdate(mktime(0, 0, 0, $matches[2], $matches[3], $matches[1]));
}
else {
	$today = getdate();
}


for ($i=0; $i<10; $i++) {
	$filepath = sprintf('%s/include/rss_hot_topics/atom%04s%02s%02s.xml', dirname(__FILE__), $today['year'], $today['mon'], $today['mday']);
	if (file_exists($filepath)) {
		echo file_get_contents($filepath);
		break;
	}
	$today = getdate(mktime(0, 0, 0, $today['mon'], $today['mday']-1, $today['year']));
}
?>
