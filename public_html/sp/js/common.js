var myScroll;
function loaded() {

//ipohneの時に、バーを調整する
	if (navigator.userAgent.match(/iPhone/)) {
		//7かどうかを判断する
		if (navigator.userAgent.match(/iPhone OS 7/)) {
		}
		else if (navigator.userAgent.match(/iPhone OS 8/)) {
			document.getElementById('wrapper').style.height = document.getElementById('wrapper').offsetHeight + 0 + 'px';
			document.getElementById('iconMenu').style.bottom = "0px";
		}
		else{
			document.getElementById('wrapper').style.height = document.getElementById('wrapper').offsetHeight + 60 + 'px';
			document.getElementById('iconMenu').style.bottom = "-60px";
		}
		window.scrollTo(0, 1);
	}
	myScroll = new iScroll('wrapper');
}
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
window.addEventListener('load', loaded, false);


$(function(){

	//現在のパスを取得
	var path = "";
	path = location.pathname;
	path = path.replace(/\/sp\//g,"/")

	//特別対応
	var path_set = "";
	if(path.indexOf("/performance/") != -1){
		path_set = "/artist/";
		if(path.indexOf("/kubota/") != -1){
			path_set += "kubota";
		}else if(path.indexOf("/urashima/") != -1){
			path_set += "urashima";
		}
		else if(path.indexOf("/mori/") != -1){
			path_set += "mori";
		}
		else if(path.indexOf("/bes/") != -1){
			path_set += "bes";
		}
		path_set += "/performance.html";
		path = path_set;
	}
	else if(path.indexOf("/discography/") != -1){
		path_set = "/artist/";
		if(path.indexOf("/kubota/") != -1){
			path_set += "kubota";
		}else if(path.indexOf("/urashima/") != -1){
			path_set += "urashima";
		}
		else if(path.indexOf("/mori/") != -1){
			path_set += "mori";
		}
		else if(path.indexOf("/bes/") != -1){
			path_set += "bes";
		}
		path_set += "/discography.html";
		path = path_set;
	}

	//全てのページへボタンを設置
	var btn = '<p class="link"><a href="'+path+'">FunkyJam PCサイトはこちら</a></p>';
	$('#premium').before(btn);

	//PC版を表示する場合は、フラグを立てクッキーへ
	$('.link a').click(function() {
		$.cookie('pcview', 1, { path:'/' });
	});
});