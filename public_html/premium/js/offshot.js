$(function() {
	//fancybox系処理。
	$("#contents").find(".image a").fancybox({
		'onComplete': function () {
			$("#fancybox-img").bind("contextmenu",function(e){
				return false;
			});
			$("#fancybox-content").find('img').after('<p class="copy"><img src="/premium/images/common/copyright.png" alt="copyright"></p>');
		}
	});
	$("#contents").find(".image img").bind("contextmenu",function(e){
		return false;
	});
	$(".offshotList .normal:nth-child(5n+2)").addClass("last");
	$(".offshotList .pick span").addClass("pcBlock");
	$(".offshotList .pick span").addClass("clearfix");
});
$(window).load(function() {
	$("#contents").find(".image img").each(function(){
		var px = $(this).width();
		$(this).after(
			$('<p>').addClass("copy").append(
				$('<img>').attr({
					src: "/premium/images/common/copyright.png",
					alt: "copyright",
					//style: "width:"+px+"px"
					width: px
				})
			)
		);
	});
	$(".pick").tile(2);
	$(".normal").tile(5);
});