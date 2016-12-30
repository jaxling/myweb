<!DOCTYPE HTML>
<html>
  <head>
    <title>Ling's Album</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="resoursejs/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="resoursecss/main.css" />
    <noscript><link rel="stylesheet" href="resoursecss/noscript.css" /></noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="resoursecss/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="resoursecss/ie9.css" /><![endif]-->
  </head>
<style type="text/css">
  .nav{
    width: 100%;
    height: 50px;
    font-size: 23.5px;
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
    margin-top:12.5px;
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
    font-family:"楷体"; 
}
</style>
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
    <div id="wrapper" style="top:10%;">

      <div id="main">
        <div id="reel">

          <!-- Header Item -->

            <!-- <div id="header" class="item" data-width="400">
              <div class="inner">
                <h1>Albums</h1>
                <p>By Ling</p>
              </div>
            </div> -->

          <!-- Thumb Items -->

            <?php if ($list): ?>
              <?php foreach ($list as $k => $v): ?>

                <!-- <article class="item thumb" data-width="282">
                  <h2><?=$v['name']?></h2>
                  <a href="/album/<?=$v['id']?>" class="image">
                    <img src="<?=$v['page_img']?>" alt="">
                  </a>
                </article> -->

                <article class="item thumb" data-width="282">
                  <h2><?=$v['name']?></h2>
                  <a href="/album/<?=$v['id']?>" class="">
                    <img src="<?=$v['page_img']?>" alt="">
                  </a>
                </article>
                
              <?php endforeach ?>
            <?php endif ?>
            

        </div>
      </div>
    </div>

    <!-- Scripts -->
      <script src="resoursejs/jquery.min.js"></script>
      <script src="resoursejs/jquery.poptrox.min.js"></script>
      <script src="resoursejs/skel.min.js"></script>
      <script src="resoursejs/skel-viewport.min.js"></script>
      <script src="resoursejs/util.js"></script>
      <!--[if lte IE 8]><script src="resoursejs/ie/respond.min.js"></script><![endif]-->
      <script src="resoursejs/main.js"></script>

  </body>
</html>