$(function(){
	"use strict";

	// menu
	var body = $("body");
	var page = $("#page");
	var menu = $("#menu");
	var w = $(window);
	var st = 0;

	$("header .navi .btn a").click(function(){
		var w_h = w.height();
		st = w.scrollTop();

		page.hide();
		w.scrollTop(0);
		menu.fadeIn("fast");

		if(menu.height() < w_h){
			menu.css("min-height", w_h);
		}
		return false;
	});

	$("#menu .btn a").click(function(){
		page.show();
		w.scrollTop(st);
		menu.hide();
		return false;
	});

	menu.find(".menu1 li p").matchHeight();
	menu.find(".menu1 li").matchHeight();

	// pageScroller
	$(".innerLink").pageScroller();

	// matchHeight
	$(".matchHeight").each(function(){
		$(this).children().matchHeight();
	});
});