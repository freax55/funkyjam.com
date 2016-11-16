// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
var onPlayerReady;
var onPlayerStateChange;
function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '500',
		width: '892',
		videoId: 'mvY0mzTx6YY',
		playerVars: {
			showinfo: 0,
			modestbranding: 0,
			controls: 0,
			rel: 0
		},
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

$(function(){
	"use strict";

	var movie = $("#contents .movie");
	var movie_image = $("#contents .movie .image");
	var text = $("#contents .text");
	var md = $("#contents .md");

	onPlayerReady = function(event){
		movie.find(".image").click(function(){
			player.seekTo(0).playVideo();
			movie_image.fadeOut(3000);
			return false;
		});
	};

	onPlayerStateChange = function(event){
		if(event.data == YT.PlayerState.ENDED){
			movie.fadeOut(1500, function(){
				text.fadeIn(1500).delay(6000).fadeOut(1500, function(){
					md.fadeIn(1500);
				});
			});
		}
	};

	md.find("a").click(function(){
		movie_image.show();
		movie.fadeIn(1500);
		text.hide();
		md.hide();
		return false;
	});
});