<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dd */

$this->title = 'Create Dd';
$this->params['breadcrumbs'][] = ['label' => 'Dds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dd-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
