<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Brand;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '品牌';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加品牌', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'name',
            'en_name',
          //  'img',
            [
                'attribute' => 'img',
                'format' => 'image',
                'value'=>function($model) { return $model->img.'!s100'; },
            ],
            'des:ntext',
            //'is_show',
             [
                'attribute' => 'is_show',
                'value' => function ($model, $key, $index, $column) {
                    return Brand::itemAlias("is_show", $model->is_show);
                },
                'filter'=>Brand::itemAlias("is_show"),
            ],
            'create_time',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
