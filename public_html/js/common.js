
// デバイス振り分け--------------------------------------------------------------------------------||
//----------------------------------------------------------------------------------------------||

$(function() {
	setOperate();
});// end function

function setOperate(){
	setView();
	var agent = navigator.userAgent;
	if(agent.search(/iPhone/) != -1){
		$("body").addClass("iphone"); //iPhoneには「body class="iphone"」追加
		window.onorientationchange = setView;
	}else if(agent.search(/iPad/) != -1){
		$("body").addClass("ipad"); //iPadには「body class="ipad"」追加
		window.onorientationchange = setView;
	}else if(agent.search(/Android/) != -1){
		$("body").addClass("android"); //Androidには「body class="android"」追加
		window.onresize = setView;
	}else{
		$("body").addClass("other"); //上記以外には「body class="other"」追加
		window.onorientationchange = setView;
	}
}

function setView(){
	var orientation = window.orientation;
	if(orientation === 0){
		$("body").addClass("portrait"); //画面が縦向きの場合は「body class="portrait"」追加
		$("body").removeClass("landscape"); //画面が縦向きの場合は「body class="landscape"」削除
	}else{
		$("body").addClass("landscape"); //画面が横向きの場合は「body class="landscape"」追加
		$("body").removeClass("portrait"); //画面が横向きの場合は「body class="portrait"」削除
	}
}



// サウンド設定　　--------------------------------------------------------------------------------||
//----------------------------------------------------------------------------------------------||

$(function() {
	//トラッククリック
	var t = $("#sound");
	t.click(function(){
		var s = "/sound.mp3";
		if($(this).hasClass("playing") == false){
			//playingクラス評価 持ってない場合
			$(t).removeClass("playing");
			$(this).addClass("playing");
			playSound(s);
		}else{
			//playingクラス評価 持っている場合
			$(this).removeClass("playing");
			stopSound();
		}
		return false;
	});
	//再生
	function playSound(s){
		$('embed').remove();
		$('body').append('<embed src="' + s +'"' + 'autostart="true" hidden="true" loop="true">');
		 $("#sound img").attr('src', '/images/soundBtn_n.png');
	}
	//停止
	function stopSound(){
		$('embed').remove();
		$("#sound img").attr('src', '/images/soundBtn_y.png'); 
	}
});



// ページトップへもどる　--------------------------------------------------------------------------------||
//----------------------------------------------------------------------------------------------||
//スクロールするたびに実行
$(window).scroll(function () {
	var winTop = $(window).scrollTop();
	//スクロール位置が数値より上だったらクラスframe01~frame04を追加＆消去
	if ( ( 520 <= winTop ) == true) {
		//下部に行ったらカレントを取る
		$("#float").css("position","fixed");
		$("#float").css("top","0px");
	}else {
		$("#float").css("position","absolute");
		$("#float").css("top","520px");
	}
});
$(function(){
	var name = "#float";
	var menuYloc = null;
	//最新情報欄 
	//トップページへ戻る
	$(function() {
		$("#float").click(function () {
			$('html,body').animate({ scrollTop: 0 }, 400);
			return false;
		});
	});
});



// イメージ ホバー --------------------------------------------------------------------------------||
//----------------------------------------------------------------------------------------------|| 
$(function(){
	$("img.change").hover(function() {
		$(this).attr('src', $(this).attr("src").replace("_n.", "_y."));
	}, function() {
		$(this).attr('src', $(this).attr("src").replace("_y.", "_n."));
	});
	$(".change").css("cursor","pointer");
});