if (AC_FL_RunContent == 0) {
	alert("このページでは \"AC_RunActiveContent.js\" が必要です。");
} else {
	AC_FL_RunContent(
		'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
		'width', '950',
		'height', '104',
		'src', 'image/top/eyecatch',
		'quality', 'low',
		'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
		'align', 'middle',
		'play', 'true',
		'loop', 'true',
		'scale', 'showall',
		'wmode', 'transparent',
		'devicefont', 'false',
		'id', 'eyecatch',
		'bgcolor', '#ffffff',
		'name', 'eyecatch',
		'menu', 'true',
		'allowFullScreen', 'false',
		'allowScriptAccess','sameDomain',
		'movie', 'image/top/eyecatch',
		'salign', ''
		); //end AC code
}