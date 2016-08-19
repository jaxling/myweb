<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGallery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '商品相册', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gallery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此项？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'img_url:url',
            'img_url_thumb:url',
            'product_id',
            'title',
            'desc:ntext',
            'is_page_img',
            'is_show',
            'create_at',
            'update_at',
        ],
    ]) ?>

</div>
