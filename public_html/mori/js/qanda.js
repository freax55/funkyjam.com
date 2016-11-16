$(function(){
	"use strict";

	$("#contents .q").click(function(){
		var q = $(this);
		var a = q.next();

		if(a.is(":visible")){
			a.slideUp("fast");
			q.removeClass("open");
		}else{
			a.slideDown("fast");
			q.addClass("open");
		}
	});
});