$(function() {
	$('#artists .selector li').each(function(i) {
		$('#selector' + parseInt(i + 1)).mouseover(function() {
			$('#artists .image').removeClass('current');
			$('#artist' + parseInt(i + 1)).addClass('current');
		});
	});
});
