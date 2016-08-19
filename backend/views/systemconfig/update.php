<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Systemconfig */

$this->title = '更新 全局配制: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '全局配制', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="systemconfig-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
