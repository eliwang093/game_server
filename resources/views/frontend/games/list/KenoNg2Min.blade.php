<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" content="text/html" http-equiv="Content-Type">
    <meta content="initial-scale=1, maximum-scale=1" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <title>{{ $game->title }}</title>

    <link href="{{'/games/'. $game->name . '/libs/bootstrap/bootstrap-grid-3.3.1.min.css'}}" rel="stylesheet"
          type="text/css">
    <link href="{{'/games/'. $game->name . '/libs/fancybox2/jquery.fancybox.css'}}" rel="stylesheet" type="text/css">
    <link href="{{'/games/'. $game->name . '/libs/DataTables/css/dataTables.semanticui.min.css'}}" rel="stylesheet"
          type="text/css">
    <link href="{{'/games/'. $game->name . '/libs/DataTables/css/jquery.dataTables.min.css'}}" rel="stylesheet"
          type="text/css">
    <link href="{{'/games/'. $game->name . '/libs/DataTables/semanticStyle/semantic.min.css'}}" rel="stylesheet"
          type="text/css">
    <link href="{{'/games/'. $game->name . '/css/fonts.css'}}" rel="stylesheet" type="text/css">
    <link href="{{'/games/'. $game->name . '/css/main.css'}}" rel="stylesheet" type="text/css">
    <link href="{{'/games/'. $game->name . '/css/media.css'}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <script src="{{'/games/'. $game->name . '/libs/hls/hls.js'}}" type="text/javascript"></script>
    <script src="{{'/games/'. $game->name . '/libs/rtc/wowza-webrtc-player.js'}}" type="text/javascript"></script>
    <script src="{{'/games/'. $game->name . '/libs/FLGUtils/rtcVideo.js'}}" type="text/javascript"></script>
    <script src="{{'/games/'. $game->name . '/libs/rtc/auto-save.js'}}"></script>
</head>

<body ondragstart="return false">
<script>
    if (!window.FLGUtils) window.FLGUtils = {
        staticRootPath: 'http://127.0.0.1/games/KenoNg2Min/'
    };

    console.log(window.FLGUtils.staticRootPath);
</script>

<div id="preload"><img style="display: none;" src="{{'/games/'. $game->name . '/images/logo.png'}}"></div>
<div id="loader-wrapper">
    <div id="loader" class="loader loader-loading"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>

<div id="rotate_device">
    <div id="rotate_device_img" class="rotate_device_img"><img align="middle" src="{{'/games/'. $game->name . '/images/rotate_device3.png'}}">
    </div>
</div>
<div id="hand-touch">
    <div id="hand-touch-gif" class="rotate_device_img"><img align="middle" src="{{'/games/'. $game->name . '/images/fullscreen-swipe.gif'}}">
    </div>
</div>
<!--[if lt IE 9]>
<script src="{{'/games/'. $game->name . '/libs/html5shiv/es5-shim.min.js'}}"></script>
<script src="{{'/games/'. $game->name . '/libs/html5shiv/html5shiv.min.js'}}"></script>
<script src="{{'/games/'. $game->name . '/libs/respond/respond.min.js'}}"></script>
<![endif]-->

<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/jquery/jquery-1.12.0.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/js/game/preload.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/fancybox2/jquery.fancybox.pack.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/jquery.parallax/jquery.parallaxOld.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/jquery.easing/jquery.easing.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/jquery.flip/jquery.flip.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/DataTables/jquery.dataTables.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/DataTables/dataTables.semanticui.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/DataTables/semanticStyle/semantic.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/howler/howler.core.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/lowtype/lowtype.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/isMobile/isMobile.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/Tween/Tween.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/PIXI/pixi.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/FLGUtils/FLG.Consts.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/FLGUtils/FLG.Localization.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/FLGUtils/FLG.SoundManager.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/FLGUtils/utils.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/FLGUtils/FLG.PixiUtils.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/libs/imagesLoaded/imagesloaded.pkgd.min.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/js/common.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/js/history.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/js/startWindow.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/games/Intracing/FLG.Intracing.Main.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/games/Keno/FLG.KenoNG.Main.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/games/Keno/FLG.KenoNGMobile.Main.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/games/Keno/FLG.KenoJX.js'}}"></script>
<script rel="javascript" type="text/javascript" src="{{'/games/'. $game->name . '/games/Keno/FLG.KenoJXMobile.Main.js'}}"></script>
</body>
</html>
