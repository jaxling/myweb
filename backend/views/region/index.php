<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '地区';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加地区', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           

            'id',
            'parent_id',
            'name',
            'pinyin',
            'code',
            // 'level',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
