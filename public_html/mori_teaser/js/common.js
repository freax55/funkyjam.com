$(function(){
	"use strict";

	// ro
	$(".ro a").hover(
		function(){
			var img = $(this).find("img");

			img.attr("src", img.attr("src").replace(/^(.+)(\..+)$/, "$1_on$2"));
		},
		function(){
			var img = $(this).find("img");

			img.attr("src", img.attr("src").replace(/^(.+)_on(\..+)$/, "$1$2"));
		}
	);

	// pageScroller
	$(".innerLink").pageScroller();
});