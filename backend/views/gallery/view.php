<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Gallery;
use common\models\Album;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */



$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '照片库', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'img_url:url',
            [
                'attribute'=>'img_url',
                'value'=>$model->img_url,
                'format' => ['image',['width'=>'50','height'=>'50']],
            ],             
            'img_url_thumb:url',
            'album.name',
             
            //'album_id',
            'title',
            'desc:ntext',
            'is_page_img',
            [
                'attribute'=> 'status',
                'value' => Gallery::itemAlias("status", $model->status),
            ],
            'create_at',
            'update_at',

            
        ],
    ]) ?>

</div>
