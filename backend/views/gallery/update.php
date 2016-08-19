<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = '更新 照片: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '照片库', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
