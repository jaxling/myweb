<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Systemconfig */

$this->title = '创建 全局配制';
$this->params['breadcrumbs'][] = ['label' => '全局配制', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemconfig-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
