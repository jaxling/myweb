<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use common\models\Dd;

/* @var $this yii\web\View */
/* @var $model common\models\Dd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dd-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dd_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'table_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Dd::itemAlias('status')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
