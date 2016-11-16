$(function(){
	"use strict";

	// 入力があれば緑色
	$("#entry").find("input[type=text]:not(.error)").each(function(){
		var input = $(this);
		if(input.val().trim() !== ""){
			input.addClass("complete");
		}
	});

	$("#entry").find("input[type=text]").keyup(function(){
		var input = $(this);
		if(input.val().trim() !== ""){
			input.addClass("complete");
		}else{
			input.removeClass("complete");
		}
	});
});