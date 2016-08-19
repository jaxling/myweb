<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ProductGallery;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductGallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品相册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-gallery-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加商品图片', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'img_url',
                'format' => 'image',
                'value'=>function($model) { return $model->img_url.'!s100'; },
            ],
            [
                'attribute' => 'product_id',
                'value' => function ($model, $key, $index, $column) {
                    return ProductGallery::itemAlias("product_id", $model->product_id);
                },
                'filter'=>ProductGallery::itemAlias("product_id"),
            ],
            'title',
            // 'desc:ntext',
            [
                'attribute' => 'is_page_img',
                'value' => function ($model, $key, $index, $column) {
                    return ProductGallery::itemAlias("is_page_img", $model->is_page_img);
                },
                'filter'=>ProductGallery::itemAlias("is_page_img"),
            ], 
            [
                'attribute' => 'is_show',
                'value' => function ($model, $key, $index, $column) {
                    return ProductGallery::itemAlias("is_show", $model->is_show);
                },
                'filter'=>ProductGallery::itemAlias("is_show"),
            ],
             'create_at',
            // 'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
