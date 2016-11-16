$(function(){
	"use strict";

	// progress カレント表示
	$("#contents .progress .current").prev().addClass("prev");

	// 支払い方法 説明文
	function pay_text(id){
		if(id === "pay1"){
			$(".pay .text").hide();
			$(".pay .pay1").slideDown("fast");
		}else if(id === "pay2"){
			$(".pay .text").hide();
			$(".pay .pay2").slideDown("fast");
		}
	}

	var checked = $(".pay input[name=payment]:checked");
	if(checked.length > 0){
		pay_text(checked.attr("id"));
	}

	$(".pay input[name=payment]").change(function(){
		pay_text($(this).attr("id"));
	});

	// 一度だけsubmitできるようにする
	var click_flg = false;
	$(".submit").click(function(){
		if(!click_flg){
			$(this).parents("form").first().submit();
			click_flg = true;
		}
		return false;
	});
});