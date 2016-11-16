$(function() {
	$('.openPopup a').click(function() {
		window.open($(this).attr('href'), '', 'width=700,height=768,scrollbars=yes,resizable=yes,toolbar=yes');
		return false;
	});
});

$(function() {
	$('#morePhoto .verticalPhoto a').click(function() {
		opwin = window.open($(this).attr('href'), 'popup1', 'width=620,height=960,scrollbars=no,resizable=yes,toolbar=yes');
		opwin.focus();
		return false;
	});
});

$(function() {
	$('#morePhoto .horizonPhoto a').click(function() {
		opwin = window.open($(this).attr('href'), 'popup2', 'width=920,height=660,scrollbars=no,resizable=yes,toolbar=yes');
		opwin.focus();
		return false;
	});
});
