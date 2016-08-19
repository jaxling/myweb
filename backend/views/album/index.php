<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Album;


/* @var $this yii\web\View */
/* @var $searchModel common\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '相册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建 相册', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'des:ntext',
            [
                'attribute' => 'category_id',
                'value' => function ($model, $key, $index, $column) {
                    return Album::itemAlias("category_id", $model->category_id);
                },
                'filter'=>Album::itemAlias("category_id"),
            ],            
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return Album::itemAlias("status", $model->status);
                },
                'filter'=>Album::itemAlias("status"),
            ],
            'create_at',
            // 'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
