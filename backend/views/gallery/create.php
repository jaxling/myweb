<?php

use yii\helpers\Html;
use common\models\Gallery;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = '上传 照片';
$this->params['breadcrumbs'][] = ['label' => '照片库', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
