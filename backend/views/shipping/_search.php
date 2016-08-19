<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ShippingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipping-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'shipping_code') ?>

    <?= $form->field($model, 'shipping_name') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'defult_first_weight') ?>

    <?php // echo $form->field($model, 'defult_first_price') ?>

    <?php // echo $form->field($model, 'defult_next_weight') ?>

    <?php // echo $form->field($model, 'defult_next_price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
