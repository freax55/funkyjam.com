$(document).ready(function(){

	var click_flg = true;

	$('#main .form .text').focus(function(){
		$(this).addClass("focus");
	});
	$('#main .form .text').blur(function(){
		$(this).removeClass("focus");
	});
	$('#main.top .left .btn').click(function(){
		$("#main.top .left form").trigger("submit")
	});
	$('#main.top .right .btn').click(function(){
		$("#main.top .right form").trigger("submit")
	});
	$('#main.input .btn').click(function(){
		$("#main.input form").trigger("submit")
	});
	$('#main.confirm .btn').click(function(){
		$("#main.confirm form").trigger("submit")
	});
	$('#main.select .btn').click(function(){
		$("#main.select form").trigger("submit")
	});

	$("#main.select form").submit(function() {
		if(click_flg) {
			click_flg = false;
			$("#main.select .btnInput").addClass('notClock');
			$("#main.select .btnInput input").attr('disabled', true);
			console.log("a");
			click_flg = true;
		}else{
			return false;
		}
	}); 

});