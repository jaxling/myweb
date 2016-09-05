<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Motto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'english')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chinese')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'add_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
