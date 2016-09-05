<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Photo</title>
<style type="text/css">
/* ±êÇ©ÖØ¶¨Òå */
body{padding:0;margin:0;background:#ddd url(../images/bg1.jpg) repeat;}
img{border:none;}
a{text-decoration:none;color:#444;}
a:hover{color:#999;}
#title{width:600px;margin:20px auto;text-align:center;}
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
</style>
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript">
window.onload = function(){
	//ÔËÐÐÆÙ²¼Á÷Ö÷º¯Êý
	PBL('wrap','box');
	//Ä£ÄâÊý¾Ý
	var data = [
					{'src':'1.jpg','title':'231231'},
					{'src':'2.jpg','title':'123123'},
					{'src':'3.jpg','title':'12321'},
					{'src':'4.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'},
					{'src':'5.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'},
					{'src':'6.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'},
					{'src':'7.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'},
					{'src':'8.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'},
					{'src':'9.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'},
					{'src':'10.jpg','title':'ËØ²Ä¼ÒÔ°-sucaijiayuan.com'}
				];
	
	
	//ÉèÖÃ¹ö¶¯¼ÓÔØ
	window.onscroll = function(){
		//Ð£ÑéÊý¾ÝÇëÇó
		if(getCheck()){
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
				img.src = '../images/'+data[i].src;
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
			PBL('wrap','box');
		}
	}
}
/**
* ÆÙ²¼Á÷Ö÷º¯Êý
* @param  wrap	[Str] Íâ²ãÔªËØµÄID
* @param  box 	[Str] Ã¿Ò»¸öboxµÄÀàÃû
*/
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
			var minH = Math.min.apply(null,everyH);//»ñµÃ×îÐ¡µÄÁÐµÄ¸ß¶È
			var minIndex = getIndex(minH,everyH); //»ñµÃ×îÐ¡ÁÐµÄË÷Òý
			getStyle(boxs[i],minH,boxs[minIndex].offsetLeft,i);
			everyH[minIndex] += boxs[i].offsetHeight;//¸üÐÂ×îÐ¡ÁÐµÄ¸ß¶È
		}
	}
}
/**
* »ñÈ¡ÀàÔªËØ
* @param  warp		[Obj] Íâ²ã
* @param  className	[Str] ÀàÃû
*/
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
/**
* »ñÈ¡×îÐ¡ÁÐµÄË÷Òý
* @param  minH	 [Num] ×îÐ¡¸ß¶È
* @param  everyH [Arr] ËùÓÐÁÐ¸ß¶ÈµÄÊý×é
*/
function getIndex(minH,everyH){
	for(index in everyH){
		if (everyH[index] == minH ) return index;
	}
}
/**
* Êý¾ÝÇëÇó¼ìÑé
*/
function getCheck(){
	var documentH = document.documentElement.clientHeight;
	var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
	return documentH+scrollH>=getLastH() ?true:false;
}
/**
* »ñµÃ×îºóÒ»¸öboxËùÔÚÁÐµÄ¸ß¶È
*/
function getLastH(){
	var wrap = document.getElementById('wrap');
	var boxs = getClass(wrap,'box');
	return boxs[boxs.length-1].offsetTop+boxs[boxs.length-1].offsetHeight;
}
/**
* ÉèÖÃ¼ÓÔØÑùÊ½
* @param  box 	[obj] ÉèÖÃµÄBox
* @param  top 	[Num] boxµÄtopÖµ
* @param  left 	[Num] boxµÄleftÖµ
* @param  index [Num] boxµÄµÚ¼¸¸ö
*/
var getStartNum = 0;//ÉèÖÃÇëÇó¼ÓÔØµÄÌõÊýµÄÎ»ÖÃ
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
    getStartNum = index;//¸üÐÂÇëÇóÊý¾ÝµÄÌõÊýÎ»ÖÃ
}
</script>


</head>
<body>
	<div id="wrap">
	
		<div class="box">
			<div class="info">
				<div class="pic"><img src="../images/1.jpg"></div>
				<div class="title"><a href="http://www.sucaijiayuan.com">ËØ²Ä¼ÒÔ°-sucaijiayuan.com</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="../images/2.jpg"></div>
				<div class="title"><a href="http://www.sucaijiayuan.com">ËØ²Ä¼ÒÔ°-sucaijiayuan.com</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="../images/3.jpg"></div>
				<div class="title"><a href="http://www.sucaijiayuan.com">ËØ²Ä¼ÒÔ°-sucaijiayuan.com</a></div>
			</div>
		</div>
		
		<div class="box">
			<div class="info">
				<div class="pic"><img src="../images/4.jpg"></div>
				<div class="title"><a href="http://www.sucaijiayuan.com">ËØ²Ä¼ÒÔ°-sucaijiayuan.com</a></div>
			</div>
		</div>
	</div>
</body>
</html>