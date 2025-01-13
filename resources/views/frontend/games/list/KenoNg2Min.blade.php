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
<input type="hidden" value="<?= csrf_token() ?>" name="_token">
<script>
    var serverUrl = "/game/KenoNg2Min/get_server";
    {{-- eliwang093 comment: update this with dynamic url   --}}
    if (!window.FLGUtils) window.FLGUtils = {
        staticRootPath: 'http://127.0.0.1/games/KenoNg2Min/'
    };

</script>
<div id="preload"><img style="display: none;" src="{{'/games/'. $game->name . '/images/logo.png'}}"></div>
<div class="game-panel__header">
    <div class="game-panel__header__name">Keno 2 min vs1</div>
    <div class="game-panel__header__update" title="Reload game">
        <span class="game-panel__header__update__text">You are playing on demo account </span>
        <svg class="game-panel__header__update__icon svg-col-mid" viewBox="0 0 16.508 16.668" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><path fill="#D5B577" d="M15.758 1.627a.75.75 0 0 0-.75.75v.979A8.31 8.31 0 0 0 8.333 0C3.738 0-.001 3.739-.001 8.334c0 4.596 3.739 8.334 8.334 8.334a8.332 8.332 0 0 0 7.651-5.027.75.75 0 0 0-1.377-.595 6.831 6.831 0 0 1-6.274 4.123 6.841 6.841 0 0 1-6.834-6.834 6.842 6.842 0 0 1 6.834-6.834 6.81 6.81 0 0 1 5.674 3.044H12.8a.75.75 0 0 0 0 1.5h2.958a.75.75 0 0 0 .75-.75V2.377a.75.75 0 0 0-.75-.75z"></path></svg></div><div class="game-panel__header__controls"><div class="game-panel__header__controls__item" title="Fullscreen"><svg class="game-panel__header__controls__icon svg-col-mid" viewBox="62.521 63.146 17.095 17.094" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><path fill="#D5B577" d="M63.938 68.693v-4.121h14.229v14.23h-3.673v1.351h3.847c.648 0 1.177-.527 1.177-1.176V64.399c0-.648-.527-1.177-1.177-1.177H63.765a1.18 1.18 0 0 0-1.178 1.177v4.294h1.351z"></path><path fill="#D5B577" d="M71.59 70.927h-8.436a.568.568 0 0 0-.566.567v8.089a.57.57 0 0 0 .566.568h8.436a.568.568 0 0 0 .566-.568v-8.089a.568.568 0 0 0-.566-.567zm-.817 8.014H63.97v-6.803h6.803v6.803z"></path></svg></div><div class="game-panel__header__controls__item" title="Stretch"><svg class="game-panel__header__controls__icon svg-col-mid" viewBox="62.24 63.24 17.125 17.109" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><path fill="#D5B577" d="M78.562 63.917a.758.758 0 0 0-.509-.211h-3.39a.548.548 0 0 0-.546.548v.187c0 .302.245.548.546.548h1.966l-6.381 6.371a.55.55 0 0 0 .001.772l.138.136a.539.539 0 0 0 .384.155.56.56 0 0 0 .387-.159l6.377-6.371v1.752c0 .302.246.547.548.547h.187a.548.548 0 0 0 .548-.547V64.47a.81.81 0 0 0-.256-.553z"></path><path fill="#D5B577" d="M77.933 71.554v7.365h-14.23v-14.23h7.365v-1.351h-7.539c-.648 0-1.176.527-1.176 1.177v14.576a1.18 1.18 0 0 0 1.176 1.179h14.576a1.18 1.18 0 0 0 1.177-1.179v-7.537h-1.349z"></path></svg></div><div class="game-panel__header__controls__item" title="Close"><svg class="game-panel__header__controls__icon svg-col-mid" viewBox="63.021 63.412 16.797 16.796" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%"><path d="M72.49 71.818l7.173-7.172a.284.284 0 0 0 0-.4l-.678-.678a.284.284 0 0 0-.4 0l-7.173 7.172-7.138-7.137a.334.334 0 0 0-.47 0l-.609.608a.334.334 0 0 0 0 .47l7.139 7.138-7.173 7.171a.284.284 0 0 0 0 .4l.678.678c.11.111.29.111.4 0l7.173-7.172 7.139 7.139c.13.129.341.129.47 0l.608-.609a.333.333 0 0 0 0-.469l-7.139-7.139z"></path></svg>
        </div>
    </div>
</div>
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
