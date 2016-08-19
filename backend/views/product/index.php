<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'keywords',
            //'des:ntext',
            'market_price',
             'product_price',
            // 'promotion_price',
            /*[
                'attribute' => 'spec',
                'value' => function ($model, $key, $index, $column) {
                    return Product::itemAlias("spec", $model->spec);
                },
                'filter'=>Product::itemAlias("spec"),
            ],*/
            /* 'weight',
             [
                'attribute' => 'weight_unit',
                'value' => function ($model, $key, $index, $column) {
                    return Product::itemAlias("weight_unit", $model->weight_unit);
                },
                'filter'=>Product::itemAlias("weight_unit"),
            ],*/
            [
                'attribute' => 'brand_id',
                'value' => function ($model, $key, $index, $column) {
                    return Product::itemAlias("brand_id", $model->brand_id);
                },
                'filter'=>Product::itemAlias("brand_id"),
            ],
             'stock',
             'serial_number',
            // 'full_cut_shipping_free',
            // 'supply',
            [
                'attribute' => 'is_show',
                'value' => function ($model, $key, $index, $column) {
                    return Product::itemAlias("is_show", $model->is_show);
                },
                'filter'=>Product::itemAlias("is_show"),
            ],
             'create_time',
             //'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
