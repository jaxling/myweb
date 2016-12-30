<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Photo</title>
<style type="text/css">
/* ±êÇ©ÖØ¶¨Òå */
body{padding:0;margin:0;}
img{border:none;}
a{text-decoration:none;color:#444;}
a:hover{color:#999;}
#title{width:600px;margin:60px auto;text-align:center;}
/* ¶¨Òå¹Ø¼üÖ¡ */
@-webkit-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@-moz-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@-ms-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@-o-keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
@keyframes shade{
	from{opacity:1;}
	15%{opacity:0.4;}
	to{opacity:1;}
}
/* wrap */
#wrap{width:auto;height:auto;margin:0 auto;position:relative;}
#wrap .box{width:280px;height:auto;padding:10px;border:none;float:left;}
#wrap .box .info{width:280px;height:auto;border-radius:8px;box-shadow:0 0 11px #666;background:#fff;}
#wrap .box .info .pic{width:260px;height:auto;margin:0 auto;padding-top:10px;}
#wrap .box .info .pic:hover{
	-webkit-animation:shade 3s ease-in-out 1;
	-moz-animation:shade 3s ease-in-out 1;
	-ms-animation:shade 3s ease-in-out 1;
	-o-animation:shade 3s ease-in-out 1;
	animation:shade 3s ease-in-out 1;
}
#wrap .box .info .pic img{width:260px;border-radius:3px;}
#wrap .box .info .title{width:260px;height:40px;margin:0 auto;line-height:40px;text-align:center;color:#666;font-size:18px;font-weight:bold;overflow:hidden;}
.nav{
    width: 100%;
    height: 50px;
    font-size: 22px;
    overflow: hidden;
    position: fixed;
    z-index: 99999;
    background:rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
}
.nav_li ul{
    width: 800px;
    list-style: none;
    margin: 0 auto;
    position: relative;
    height: 35px;
    margin-top:8px;
    z-index: 3;
}
.nav_li ul li{
    width:25%;
    height: 100%;
    float: left;
    position: relative;
    overflow: hidden;
}
.nav_li ul li a{
    text-decoration: none;
    text-align: center;
    display: block;
    color:#ffffff;
    font-family:"黑体"; 
}
</style>


</head>
<body style="background-image: url(<?=$this->params['w_pic']?>)">

	<div class="nav">
        <div class="nav_li">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/music">Music</a></li>
                <li><a href="/album">Album</a></li>
                <li><a href="#">Demo</a></li>
            </ul>
        </div>
    </div>
	<div id="wrap" style="top:50px;">
	
		<?php if ($list): ?>
			<?php foreach ($list as $key => $v): ?>
				<div class="box">
					<div class="info">
						<div class="pic">
							<a href="<?=$v['img_url']?>"><img src="<?=$v['img_url']?>"></a>
						</div>
						<div class="title"><?=$v['title']?></div>
					</div>
				</div>
			<?php endforeach ?>
		<?php endif ?>
		
	</div>
		
		<input type="hidden" id="page" value="<?=$page?>">
		<input type="hidden" id="countPage" value="<?=$countPage?>">
</body>
<script src="http://static.tianpinwang.com.cn/v1/mobile/js/jquery-weui.min.js"></script>

<script type="text/javascript" src="../resourse/js/jquery.min.js"></script>
<script src="../../resourse/js/jquery.poptrox.min.js"></script>
<script src="../../resourse/js/skel.min.js"></script>
<script src="../../resourse/js/skel-viewport.min.js"></script>
<script src="../../resourse/js/util.js"></script>
<!--[if lte IE 8]><script src="resourse/js/ie/respond.min.js"></script><![endif]-->
<script src="../../resourse/js/main.js"></script>

<script type="text/javascript">
$(document).ready(function (){
	//ÔËÐÐÆÙ²¼Á÷Ö÷º¯Êý
	PBL('wrap','box');
	
	var loading = false;  //状态标记
	window.onscroll = function(){
		
		if(getCheck()){
			//ajax请求数据
			var page = $('#page').val();
			var countPage = $('#countPage').val();

			if(loading) return false;
			loading = true;

			if (page > countPage) {
				return false;
			}
			$.post('',{'page':page},function(data){

				var data = eval('('+data+')');

				var wrap = document.getElementById('wrap');
				for(i in data){
					//´´½¨box
					var box = document.createElement('div');
					box.className = 'box';
					wrap.appendChild(box);
					//´´½¨info
					var info = document.createElement('div');
					info.className = 'info';
					box.appendChild(info);
					//´´½¨pic
					var pic = document.createElement('div');
					pic.className = 'pic';
					info.appendChild(pic);
					//´´½¨img
					var img = document.createElement('img');
					img.src = data[i].src;
					img.style.height = 'auto';
					pic.appendChild(img);
					//´´½¨title
					var title = document.createElement('div');
					title.className = 'title';
					info.appendChild(title);
					//´´½¨a±ê¼Ç
					var a = document.createElement('a');
					a.innerHTML = data[i].title;
					title.appendChild(a);
				}
				loading = false;
				//page +1
				
				var new_page = parseInt(page)+parseInt(1);
				$('#page').val(new_page);
				
				PBL('wrap','box');
			})
		}
	}
});
function PBL(wrap,box){
	//	1.»ñµÃÍâ²ãÒÔ¼°Ã¿Ò»¸öbox
	var wrap = document.getElementById(wrap);
	var boxs  = getClass(wrap,box);
	//	2.»ñµÃÆÁÄ»¿ÉÏÔÊ¾µÄÁÐÊý
	var boxW = boxs[0].offsetWidth;
	var colsNum = Math.floor(document.documentElement.clientWidth/boxW);
	wrap.style.width = boxW*colsNum+'px';//ÎªÍâ²ã¸³Öµ¿í¶È
	//	3.Ñ­»·³öËùÓÐµÄbox²¢°´ÕÕÆÙ²¼Á÷ÅÅÁÐ
	var everyH = [];//¶¨ÒåÒ»¸öÊý×é´æ´¢Ã¿Ò»ÁÐµÄ¸ß¶È
	for (var i = 0; i < boxs.length; i++) {
		if(i<colsNum){
			everyH[i] = boxs[i].offsetHeight;
		}else{
			var minH = Math.min.apply(null,everyH);
			var minIndex = getIndex(minH,everyH); 
			getStyle(boxs[i],minH,boxs[minIndex].offsetLeft,i);
			everyH[minIndex] += boxs[i].offsetHeight;
		}
	}
}
function getClass(wrap,className){
	var obj = wrap.getElementsByTagName('*');
	var arr = [];
	for(var i=0;i<obj.length;i++){
		if(obj[i].className == className){
			arr.push(obj[i]);
		}
	}
	return arr;
}
function getIndex(minH,everyH){
	for(index in everyH){
		if (everyH[index] == minH ) return index;
	}
}
function getCheck(){
	var documentH = document.documentElement.clientHeight;
	var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
	return documentH+scrollH>=getLastH() ?true:false;
}
function getLastH(){
	var wrap = document.getElementById('wrap');
	var boxs = getClass(wrap,'box');
	return boxs[boxs.length-1].offsetTop+boxs[boxs.length-1].offsetHeight;
}
var getStartNum = 0;
function getStyle(box,top,left,index){
    if (getStartNum>=index) return;
    $(box).css({
    	'position':'absolute',
        'top':top,
        "left":left,
        "opacity":"0"
    });
    $(box).stop().animate({
        "opacity":"1"
    },999);
    getStartNum = index;
}
</script>