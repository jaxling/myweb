<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Album;
use common\models\Gallery;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '照片库';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('上传 照片', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'album_id',
            //'album.name',
            [
                'attribute' => 'album_id',
                'value' => 'album.name',
                'filter'=>Album::listId(),
            ],            

            'title',
            [
                'attribute' => 'img_url',
                'format' => 'image',
                'value'=>function($data) { return $data->img_url.'!s100'; },
            ],

            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return Gallery::itemAlias("status", $model->status);
                },
                'filter'=>Gallery::itemAlias("status"),
            ],
            //'img_url:url',
            //'img_url_thumb:url',
            [
                'attribute' => 'is_page_img',
                'value' => function ($model, $key, $index, $column) {
                    return Gallery::itemAlias("is_page_img", $model->is_page_img);
                },
                'filter'=>Gallery::itemAlias("is_page_img"),
            ],
            
            // 'desc:ntext',
            // 'is_page_img',
            // 'status',
             'sort_number', 
            // 'create_at',
            // 'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
