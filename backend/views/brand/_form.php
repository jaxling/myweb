<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Brand;
/* @var $this yii\web\View */
/* @var $model common\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_name')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'img')->textInput(['maxlength' => true,'style'=>'width:60%;display: inline; 
    margin:0 20px 10px;']) ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'is_show')->dropDownList(Brand::itemAlias('is_show')) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('footer_js') ?>
//
jQuery(document).ready(function () {
    var button = '<button type="button" data-toggle="modal" data-target="#myModal" id="upload_img_url" upload_field="brand-img"  style="">上传</button>';
    $('#brand-img').after(button);
    $('#upload_img_url').click(function(){
        var upload_field = $(this).attr('upload_field');
        $('#upload_img_iframe').attr('src','/tool/uploadupyun?upload_field='+upload_field);
    });
    

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>  