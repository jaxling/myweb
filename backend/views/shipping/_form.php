<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Shipping;

/* @var $this yii\web\View */
/* @var $model common\models\Shipping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shipping_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'defult_first_weight')->textInput() ?>

    <?= $form->field($model, 'defult_first_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'defult_next_weight')->textInput() ?>

    <?= $form->field($model, 'defult_next_price')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'status')->dropDownList(shipping::itemAlias('status')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
