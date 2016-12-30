<!DOCTYPE HTML>
<html>
  <head>
    <title>Ling丶</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="resourse/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="resourse/css/main1.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="resourse/css/ie8.css" /><![endif]-->
    <style type="text/css">.iiimg img{border:1px solid #fff;}</style>
  </head>
  <body style="background-image: url(<?=$this->params['w_pic']?>)">

    <!-- Header -->
      <section id="header">
        <header>
          <h1>STRUGGLE</h1>
          <p>By Ling</p>
        </header>
        <footer >
          <a href="#banner" class="button style2 scrolly-middle" style="text-decoration:none">
          Individual Resume</a>
        </footer>
      </section>

    <!-- Banner -->
      <section id="banner" style="border:1px solid #fff;background-color:#000;opacity:0.6;">
          <h2><?=$post->title?></h2>
        </header>
        <?=$post->content?>
      </section>

    <!-- Feature 1 -->
      <article id="first" class="container box style1 right" style="margin-left:-15px;display:none;">
        <a class="image fit"><img src="images/pic01.jpg" alt="" /></a>
        <div class="inner">
          <header>
            <h2>Lorem ipsum<br />
            dolor sit amet</h2>
          </header>
          <p>Tortor faucibus ullamcorper nec tempus purus sed penatibus. Lacinia pellentesque eleifend vitae est elit tristique velit tempus etiam.</p>
        </div>
      </article>

    <!-- Feature 2 -->
    <!-- Portfolio -->
      <article class="container box style2" style="margin-left:-15px;">
        <header style="border:1px solid #fff;background-color:#000;opacity:0.5;color:#fff;"><!-- background-color:transparent;color:#fff -->
          <h2>Own photos</h2>
          <p>The picture below is my own shot<br />
            Representative photo of the year.</p>
        </header>
        <div class="inner gallery">
          <div class="row 0%">

            <?php foreach ($img_url as $k => $v): ?>
              <div class="3u 12u(mobile)">
                <a href="<?=$v['img_url']?>" class="image fit iiimg">
                  <img src="<?=$v['img_url']?>" alt="<?=$v['title']?>" title="<?=$v['title']?>" />
                </a>
              </div>
            <?php endforeach ?>

            </div>
          </div>
        </div>
      </article>

    <!-- Contact -->
      <article class="container box style3" style="width:900px;height:240px;">
        <header>
          <h2>Famous classic</h2>
          <p><?=$motto['english']?></p>
        </header>
      </article>

    <!-- FriendLink -->
    <section id="footer">
      <ul class="icons">

        <?php foreach ($friend_link as $key => $v): ?>
          <li>
            <a href="<?=$v['href']?>" class="icon <?=$v['logo']?>" target="_blank">
              <span class="label"><?=$v['name']?></span>
            </a>
          </li>
        <?php endforeach ?>
        
      </ul>
      <div class="copyright">
        <ul class="menu">
          <li>&copy; Ling's&nbsp; All rights reserved.</li>
        </ul>
      </div>
    </section>

    <!-- Scripts -->
      <script src="resourse/js/jquery.min.js"></script>
      <script src="resourse/js/jquery.scrolly.min.js"></script>
      <script src="resourse/js/jquery.poptrox.min.js"></script>
      <script src="resourse/js/skel.min.js"></script>
      <script src="resourse/js/util.js"></script>
      <!--[if lte IE 8]><script src="resourse/js/ie/respond.min.js"></script><![endif]-->
      <script src="resourse/js/main1.js"></script>

  </body>
</html>