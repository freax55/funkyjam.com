var tp;

var changeTime = 5000;//	1000=1秒

$(function() {
	$('#recommend .paginate .pageNo').text('1 / ' + $('#recommend .row .entry').size());
	$('#recommend .row').css('width',($('#recommend .row .entry').size() * 300) + 'px');
	
	//animate
	//headline
	$('#headline .paginate .prev').click(moveBannerPrev);
	$('#headline .paginate .next').click(moveBannerNext);
	$('#headline .paginate li').each(function(index) {
		$(this).click(function() {
			moveBanner(index);
		});
	});
	$('#headline .images li').swiperight(moveBannerPrev);
	$('#headline .images li').swipeleft(moveBannerNext);
		
	startMoveBanner(0);
});


function moveBannerNext() {
	var index = Math.floor(Math.abs($('#headline ul').position().left / $('#headline .images li').width()));
	index = index + 1;
	if(index < $('#headline .images li').size()) {
		moveBanner(index);
	}
}
function moveBannerPrev() {
	var index = Math.floor(Math.abs($('#headline ul').position().left / $('#headline .images li').width()));
	index = index - 1;
	if(index >= 0) {
		moveBanner(index);
	}
}

function startMoveBanner(index) {
	tp = setTimeout("moveBanner('" + index + "')", changeTime);
}

function moveBanner(index) {
	var length = '-' + $('#headline .images li').width() * index + "px";
	$('#headline .images ul').animate({left: length}, {duration: 'normal', queue: false});
	$('#headline .paginate li').removeClass('current');
	$('#headline .paginate li:eq(' + index + ')').addClass('current');
	clearTimeout(tp);
	
	if(index < $('#headline .images li').size() - 1) {
		startMoveBanner(parseInt(index) + 1);
	} else {
		startMoveBanner(0);
	}
}

