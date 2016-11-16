$(function() {
	if($.cookie('FJ_FontSize')) {
		changeFontSize($.cookie('FJ_FontSize'));
	}
	
	$('#fontLarge a').click(function() {
		changeFontSize('100%');
	});
	$('#fontMiddle a').click(function() {
		changeFontSize('88%');
	});
	$('#fontSmall a').click(function() {
		changeFontSize('75%');
	});
});

function changeFontSize(size) {
	$('.fontSize li').removeClass('current');
	
	if(size == '100%') {
		$('#fontLarge').addClass('current');
	} else if(size == '88%') {
		$('#fontMiddle').addClass('current');
	} else if(size == '75%') {
		$('#fontSmall').addClass('current');
	}
	
	$('body').css('font-size', size);
	$.cookie('FJ_FontSize', size, {expires:365, path:'/'});
}
