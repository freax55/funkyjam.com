$(document).ready(function(){
	var click_flg = true;

	$("form").submit(function() {
		if(click_flg) {
			click_flg = false;
			$('form .input').addClass('notClock');
			$('form .input input').attr('disabled', true);
			click_flg = true;
		}else{
			return false;
		}
	}); 
});