<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Post;


/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建 文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'post_category_id',
                'value' => function ($model, $key, $index, $column) {
                    return Post::itemAlias("post_category_id", $model->post_category_id);
                },
                'filter'=>Post::itemAlias("post_category_id"),
            ],            
            // 'desc:ntext',
            // 'content:ntext',
            // 'topic_img',
            // 'author',
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return Post::itemAlias("status", $model->status);
                },
                'filter'=>Post::itemAlias("status"),
            ],
            // 'hits',
            'create_at',
            // 'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
