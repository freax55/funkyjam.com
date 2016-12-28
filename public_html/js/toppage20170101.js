
//----------------スライド箇所----------------//
$(function(){

  var ans = $("#topicImage").find('li').length;
  var max = ans;
  var slideNum = 0; 
  var targetNum;
  if(3>=max){
    var iVal = 10000; 
  }else{
    var iVal = 10000; 
  }
  var fSp = 600;
  var timer1;

  $("#topicNav li").each(function(i){
    $(this).addClass("no" + i);
  });
  $("#topicImage li").each(function(i){
    $(this).addClass("no" + i);
  });
  $("#topicNav li").live("click",function(){
    var cls = $(this).attr("class");
    var reg = new RegExp(/\d/);
    var res = cls.match(reg);
    slideNum = res[0];
    slidePlay(slideNum);
  });

  //repeat event
  function timer(){
    timer1 = setTimeout(function(){timer()}, iVal);
    if(slideNum < max-1 ){
      slideNum++;
    }else{
      slideNum  = 0;
    }
    slidePlay(slideNum);
  }

  //slideChange
  function slidePlay(n){

  //main change
    clearTimeout(timer1);
    $("#topicImage li").each(function(i){
      if($(this).hasClass("no" + n)){
        $(this).fadeIn(fSp);   
        $(this).addClass("ac");
      }else{
        $(this).fadeOut(fSp);
        $(this).removeClass("ac");
      }
    });

  //nav change
    $("#topicNav li").each(function(i){
      if($(this).hasClass("no" + n)){
        $(this).addClass("ac");
      }else{
        $(this).removeClass("ac");
      }
    });
    timer1 = setTimeout(function(){timer()}, iVal);
  }
slidePlay(0);

});



$(function(){

  var ans = $("#topicNav").find('li').length;
  var max = ans;
  var slideNum = 0; 
  var targetNum;
  if(3>=max){
    var iVal = 8000; 
  }else{
    var iVal = 5000; 
  }
  var fSp = 1;
  var timer1;
  $("#ctrlArea div").each(function(i){
    $(this).addClass("no" + i);
  });
  $("#photoArea div").each(function(i){
    $(this).addClass("no" + i);
  });

  $("#ctrlArea div").live("click",function(){
    var cls = $(this).attr("class");
    var reg = new RegExp(/\d/);
    var res = cls.match(reg);
    slideNum = res[0];
    slidePlay(slideNum);
  });

  //repeat event
  function timer(){
    timer1 = setTimeout(function(){timer()}, iVal);
    if(slideNum < max-1 ){
      slideNum++;
    }else{
      slideNum  = 0;
    }
    slidePlay(slideNum);
  }

  //slideChange
  function slidePlay(n){
    //main change
    clearTimeout(timer1);
    $("#photoArea div").each(function(i){
      if($(this).hasClass("no" + n)){
        $(this).fadeIn(fSp);   
        $(this).addClass("ac");
      }else{
        $(this).fadeOut(fSp);
        $(this).removeClass("ac");
      }
    });

    //nav change
    $("#ctrlArea div").each(function(i){
      if($(this).hasClass("no" + n)){
        $(this).addClass("ac");
      }else{
        $(this).removeClass("ac");
      }
    });
  }
});



$(function(){
  var targetImgs = $('img');
  targetImgs.each(function(){
    if(this.src.match('_off')){
      this.rollOverImg = new Image();
      $(this.rollOverImg).css({position: 'absolute', opacity: 0});
      $(this).before(this.rollOverImg);
      //ここいらないのなら削除してください。
      $(this.rollOverImg).mousedown(function(){
        $(this).stop().animate({opacity: 0}, {duration: 0, queue: false});
      });
      $(this.rollOverImg).hover(function(){
        $(this).animate({opacity: 1}, {duration: 150, queue: false});
      },
      function(){
        $(this).animate({opacity: 0}, {duration: 150, queue: false});
      });
    }
  });
});



$(function(){
   $('#topicImage').find('img').each(function(){
      // var width = $(this).width();
      // var height = $(this).height();
      // if(width > height){
      //   $(this).addClass('wStandard');
      // }else{
         $(this).addClass('hStandard');
      // }
  });
});



//----------------ロードオプション----------------//
$(function(){
  if($.cookie("access")){
  }
  else{
    $(function(){
      $("#load").css("display","block");
      $("#slideBox").hide();
      $(function(){
        setTimeout(function(){
          $("#load").remove();
        },4000);
      });
      $("#slideBox").delay(4000).slideDown("fast");
    });
  }
  $(window).load(function(){
    $.cookie("access",$('body').addClass('access'));
  })
});



//----------------ツイッタ（レイアウトのみ）----------------//
$(function(){
  setTimeout(function(){
    //不要な要素
    var href = $(".timeline-TweetList li:first-child a.timeline-Tweet-timestamp").attr('href');
    $(".timeline-TweetList li").hide();
    $(".Emoji, .timeline-Tweet-media, .timeline-Tweet-retweetCredit, .timeline-Header, .timeline-Footer, .timeline-Tweet-author, .timeline-Tweet-metadata, .timeline-LoadMore, .timeline-Body-notification").hide();
    $(".timeline-TweetList li:first-child").show();
    //console.log(href);
    // $(".timeline-TweetList li:first-child .timeline-Tweet-text").wrap('<a id="twNew" target="_brank" href="'+ href +'" ></a>');
    // 背景赤の時(正月・黒文字)
    $(".timeline-TweetList li:first-child .timeline-Tweet-text").wrap('<a id="twNew" class="black" target="_brank" href="'+ href +'" ></a>');
    // 背景赤の時(クリスマス・白文字)
    // $(".timeline-TweetList li:first-child .timeline-Tweet-text").wrap('<a id="twNew" class="white" target="_brank" href="'+ href +'" ></a>');
  },1);
});


// イメージ ホバー --------------------------------------------------------------------------------||
//----------------------------------------------------------------------------------------------|| 
$(function(){
  $("#artistList ul li img").hover(function() {
    $(this).attr('src', $(this).attr("src").replace("_n.", "_y."));
  }, function() {
    $(this).attr('src', $(this).attr("src").replace("_y.", "_n."));
  });
});