<?php

use yii\helpers\Html;
use yii;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
//没有登录，跳转到首页
if (Yii::$app->user->isGuest == '游客') {
    //$this->context->redirect("/");
    header("Location:/");
    exit;
}
?>
<!-- Main content -->
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>




        </div>
    </div>

</section>
