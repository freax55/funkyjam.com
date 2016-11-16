<?php
  // Copyright 2009 Google Inc. All Rights Reserved.
  function googleAnalyticsGetImageUrl() {
    $GA_ACCOUNT = "MO-8577032-2";
    //httpsでアクセスされたら、認証を通すために/mb階層から表示
    if($_SERVER['HTTP_X_FORWARDED_HOST'] == "www.funkyjam.com"){
      $GA_PIXEL = "/mb/ga.php";
    }else{
      $GA_PIXEL = "/ga.php";
    }
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);
    $referer = $_SERVER["HTTP_REFERER"];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];
    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);
    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }
    $url .= "&guid=ON";
    return str_replace("&", "&amp;", $url);
  }
?>
