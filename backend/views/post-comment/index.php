<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\PostComment;


/* @var $this yii\web\View */
/* @var $searchModel common\models\PostCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'post_id',
            'author',
            //'title',
            'content:ntext',

            'status',
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return PostComment::itemAlias("status", $model->status);
                },
                'filter'=>PostComment::itemAlias("status"),
            ],
            'create_at',
            // 'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
