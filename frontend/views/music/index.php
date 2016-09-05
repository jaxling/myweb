<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Ling's Music</title>
	<link rel="stylesheet" href="css/stylesheets/style.css">
	<script src="js/jquery-1.7.2.min.js"></script>
</head>

<style type="text/css">
	#palylist li{float: left;}
	#background{background-image: url('http://static.yidianling.com/v3/images/fm-background/fm_<?= rand(1,11);?>.jpg')}
	#player{background:rgba(0, 0, 0, 0.5) none repeat scroll 0 0;margin-bottom:10px;box-shadow:0 2px 6px rgba(0, 0, 0, 0.5);border-radius:5px}
</style>
<body class="keBody">
<div class="kePublic" style="padding:90px;">
<!--效果html开始-->
	<div id="background"></div>
	<div>
		<div id="player">
		<div class="cover"></div>
		<div class="ctrl">
			<div class="tag">
				<strong>Title</strong>
				<span class="artist">Artist</span>
				<span class="album">Album</span>
			</div>
			<div class="control">
				<div class="left">
					<div class="rewind icon"></div>
					<div class="playback icon"></div>
					<div class="fastforward icon"></div>
				</div>
				<div class="volume right">
					<div class="mute icon left"></div>
					<div class="slider left">
						<div class="pace"></div>
					</div>
				</div>
			</div>
			<div class="progress">
				<div class="slider">
					<div class="loaded"></div>
					<div class="pace"></div>
				</div>
				<div class="timer left">0:00</div>
				<div class="right">
					<div class="repeat icon"></div>
					<div class="shuffle icon"></div>
				</div>
			</div>
		</div>
	</div>
	<ul id="playlist" style="width:520px;">	</ul>
	</div>
	<script src="js/jquery-ui-1.8.17.custom.min.js"></script>
	<script src="js/script.js"></script>
<!--效果html结束-->
</div>
</body>
</html>