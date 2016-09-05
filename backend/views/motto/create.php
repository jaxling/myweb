<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Motto */

$this->title = 'Create Motto';
$this->params['breadcrumbs'][] = ['label' => 'Mottos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
