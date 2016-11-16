
// タイトル及び --------------------------------------------------------------------------------||
//----------------------------------------------------------------------------------------------|| 
$(function(){
	var ans = $("#pankuzu").html();
	ans = ans.replace(/<br>/, " ")
	ans = ans.replace("&lt;br /&gt;", " ")
	$("#pankuzu").html(ans);

	var tit = $("title").html();
	tit = tit.replace(/<br>/, " ")
	tit = tit.replace("&lt;br /&gt;", " ")
	document.title = tit;
	window.document.title = tit;

});