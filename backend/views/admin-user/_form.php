<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Dd;
use common\models\AdminUser;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>


<div class="form-group field-adminuser-password\">
<label class="control-label" for="adminuser-password">密码</label>
<input type="text" id="adminuser-password" class="form-control" name="AdminUser[password]" value="" maxlength="255">
<div class="help-block"></div>
</div>


    <?php //$form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model,'branch')->dropDownList(AdminUser::itemAlias("branch")); ?>

    <?php echo $form->field($model,'work_status')->dropDownList(AdminUser::itemAlias("work_status")); ?>


    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
