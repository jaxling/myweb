<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Dd;

/* @var $this yii\web\View */
/* @var $model common\models\Systemconfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="systemconfig-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(Dd::getDdValue('systemconfig','type')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'value2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'value3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_open')->textInput() ?>

    <?= $form->field($model, 'sort_number')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'create_time')->textInput() ?>

    <?php //$form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
