<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Motto */

$this->title = 'Update Motto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mottos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="motto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
