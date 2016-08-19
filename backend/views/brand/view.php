<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Brand;
/* @var $this yii\web\View */
/* @var $model common\models\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '品牌', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此项？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'en_name',
            //'img:image', 
            [
                'attribute'=>'img',
                'value'=>$model->img.'!s50x50',
                'format' => ['image',['width'=>'50','height'=>'50']],
            ],            
            'des:ntext',
            [
                'attribute'=> 'is_show',
                'value' => Brand::itemAlias("is_show", $model->is_show),
            ],
           /* [
                'attribute' => 'is_show',
                'value' => function ($model, $key, $index, $column) {
                    return Brand::itemAlias("is_show", $model->is_show);
                },
                'filter'=>Brand::itemAlias("is_show"),
            ],*/

            'create_time',
        ],
    ]) ?>

</div>
