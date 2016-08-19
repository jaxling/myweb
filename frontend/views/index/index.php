<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
?>


<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">Lifei's note! Since 2007.</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute(['post/index']);?>">See blog</a></p>
    </div>


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="http://img1.imgtn.bdimg.com/it/u=1067430041,1449275162&fm=21&gp=0.jpg" style="width:100%;" alt="">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="http://img3.imgtn.bdimg.com/it/u=2412847390,539820635&fm=21&gp=0.jpg" style="width:100%;" alt="">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="http://img2.imgtn.bdimg.com/it/u=3406081147,4219562975&fm=21&gp=0.jpg" style="width:100%;" alt="">
      <div class="carousel-caption">
        ...
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div style="padding-bottom: 25px;"></div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>技术</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="<?= Url::toRoute(['post/index', 'c' => 1]);?>">More &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>生活</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="<?= Url::toRoute(['post/index', 'c' => 2]);?>">More &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>随笔</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="<?= Url::toRoute(['post/index', 'c' => 3]);?>">More &raquo;</a></p>
            </div>
        </div>

    </div>
</div>