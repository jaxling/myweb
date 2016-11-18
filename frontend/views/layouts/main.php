<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<style type="text/css">
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
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="nav">
        <div class="nav_li">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/music">Music</a></li>
                <li><a href="/album">Album</a></li>
                <li><a href="/gallery">Demo</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
