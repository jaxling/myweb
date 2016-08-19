<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Friendlink;



/* @var $this yii\web\View */
/* @var $model common\models\Friendlink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="friendlink-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Friendlink::itemAlias('status')) ?>

    <?php //$form->field($model, 'create_at')->textInput() ?>

    <?php //$form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
