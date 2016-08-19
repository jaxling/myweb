<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Dd;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dd-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dd', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dd_name',
            'table_name',
            'field_name',
            'field_key',
            'field_value',
            //'num',
            //'status',
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return Dd::itemAlias("status", $model->status);
                },
                'filter'=>Dd::itemAlias("status"),
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
