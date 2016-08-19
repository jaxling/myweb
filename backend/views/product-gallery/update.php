<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGallery */

$this->title = '修改商品图片: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '商品相册', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
