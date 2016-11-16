$(document).ready(function(){
	var id = $('#section');
	//最初はボタンを動かなくし、押せないスタイルを追加する
	id.find('.btn1 input').attr('disabled', true);
	id.find('.btn1').addClass('notClock');

	//読み込み時にcheckがあるかどうか判断しチェックがついていた場合は、ボタンを押せるようにする
	if(id.find('.check input').attr("checked")){
		id.find('.btn1 input').attr('disabled', false);
		id.find('.btn1 input').removeAttr('disabled');
		id.find('.btn1').removeClass('notClock');
	}

	//クリックされた時に判断する
	id.find('.check input').click(function () {
		//チェックが付いているので、次のページへ遷移させる
		if(id.find('.check input').attr("checked")){
			id.find('.btn1 input').attr('disabled', false);
			id.find('.btn1 input').removeAttr('disabled');
			id.find('.btn1').removeClass('notClock');
		}else{
			//チェックがついていないのでボタンは動かさない
			id.find('.btn1 input').attr('disabled', true);
			id.find('.btn1').addClass('notClock');
		}
	});

});