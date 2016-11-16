$(function(){
	"use strict";

	$("#contents").css("padding-top", $(window).height() - $("header").height());

	// mainvisualの透過
	var mainvisual = $("#mainvisual");
	var w = $(window);

	changeMainvisualOpacity();

	w.scroll(function(){
		changeMainvisualOpacity();
	});

	function changeMainvisualOpacity(){
		if(w.scrollTop() === 0){
			if(mainvisual.hasClass("opacity")){
				mainvisual.removeClass("opacity");
			}
		}else{
			if(!mainvisual.hasClass("opacity")){
				mainvisual.addClass("opacity")
			}
		}
	}
});