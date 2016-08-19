<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'keywords') ?>

    <?= $form->field($model, 'des') ?>

    <?= $form->field($model, 'market_price') ?>

    <?php  echo $form->field($model, 'product_price') ?>

    <?php  echo $form->field($model, 'promotion_price') ?>

    <?php  echo $form->field($model, 'spec') ?>

    <?php  echo $form->field($model, 'weight') ?>

    <?php  echo $form->field($model, 'weight_unit') ?>

    <?php  echo $form->field($model, 'brand_id') ?>

    <?php  echo $form->field($model, 'stock') ?>

    <?php  echo $form->field($model, 'serial_number') ?>

    <?php  echo $form->field($model, 'full_cut_shipping_free') ?>

    <?php  echo $form->field($model, 'supply') ?>

    <?php  echo $form->field($model, 'is_show') ?>

    <?php  echo $form->field($model, 'create_time') ?>

    <?php  echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
