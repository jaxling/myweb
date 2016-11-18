<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Music;
/* @var $this yii\web\View */
/* @var $model common\models\Music */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="music-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_url')->textInput(['maxlength' => true,'style'=>'width:60%;display: inline; 
    margin:0 20px 10px;']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true,'style'=>'width:60%;display: inline; 
    margin:0 20px 10px;']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lyrics')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_show')->dropDownList(Music::itemAlias('is_show')) ?>

    <?= $form->field($model, 'order_num')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('footer_js') ?>
//封面图
jQuery(document).ready(function () {
    var button = '<button type="button" data-toggle="modal" data-target="#myModal" id="upload_img_url" upload_field="music-image_url"  style="">上传</button>';
    $('#music-image_url').after(button);
    $('#upload_img_url').click(function(){
        var upload_field = $(this).attr('upload_field');
        $('#upload_img_iframe').attr('src','/tool/uploadupyun?upload_field='+upload_field);
    });

    var button = '<button type="button" data-toggle="modal" data-target="#myModal" id="upload_img" upload_field="music-url"  style="">上传</button>';
    $('#music-url').after(button);
    $('#upload_img').click(function(){
        var upload_field = $(this).attr('upload_field');
        $('#upload_img_iframe').attr('src','/tool/uploadupyun?upload_field='+upload_field);
    });
    

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>