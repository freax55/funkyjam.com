$(function() {
	$(".movieList .normal:nth-child(3n+1)").addClass("last");
});
$(window).load(function() {
	$(".pick").tile(2);
	$(".normal").tile(3);
});