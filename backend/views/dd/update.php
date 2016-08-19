<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dd */

$this->title = 'Update Dd: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dd-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
