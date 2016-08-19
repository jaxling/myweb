<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Shipping;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ShippingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '快递';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipping-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加快递', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           

            'id',
            'shipping_code',
            'shipping_name',
            //'desc:ntext',
            'defult_first_weight',
            'defult_first_price',
            'defult_next_weight',
            'defult_next_price',
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return Shipping::itemAlias("status", $model->status);
                },
                'filter'=>Shipping::itemAlias("status"),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
