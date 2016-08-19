<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductGallery */

$this->title = '添加商品图片';
$this->params['breadcrumbs'][] = ['label' => '商品相册', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
