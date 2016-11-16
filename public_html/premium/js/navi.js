$(window).load(function() {
	var path=location.href;
	if(path!=null){
		var id = $('#contents').find('.btns').find('li');
		if(path.match(/path=index/)){
			id.eq(0).find('img').attr( "src",id.eq(0).find('img').attr("src").replace(/btn_all/ , "btn_all_on"));
		}
		else if(path.match(/path=kubota/)){
			id.eq(1).find('img').attr( "src",id.eq(1).find('img').attr("src").replace(/btn_kubota/ , "btn_kubota_on"));
			$('#container').addClass('kubota');
		}
		else if(path.match(/path=urashima/)){
			id.eq(2).find('img').attr( "src",id.eq(2).find('img').attr("src").replace(/btn_urashima/ , "btn_urashima_on"));
			$('#container').addClass('urashima');
		}
		else if(path.match(/path=mori/)){
			id.eq(3).find('img').attr( "src",id.eq(3).find('img').attr("src").replace(/btn_mori/ , "btn_mori_on"));
			$('#container').addClass('mori');
		}
	}
});