<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProductGallery;

/* @var $this yii\web\View */
/* @var $model common\models\ProductGallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'img_url')->textInput(['maxlength' => true,'style'=>'width:60%;display: inline; margin-right: 20px;']) ?>

    <?= $form->field($model, 'product_id')->dropDownList(ProductGallery::itemAlias('product_id')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_page_img')->dropDownList(ProductGallery::itemAlias('is_page_img')) ?>

    <?= $form->field($model, 'is_show')->dropDownList(ProductGallery::itemAlias('is_show')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('footer_js') ?>
//
jQuery(document).ready(function () {
    var button = '<button type="button" data-toggle="modal" data-target="#myModal" id="upload_img_url" upload_field="productgallery-img_url"  style="">上传</button>';
    $('#productgallery-img_url').after(button);
    $('#upload_img_url').click(function(){
        var upload_field = $(this).attr('upload_field');
        $('#upload_img_iframe').attr('src','/tool/uploadupyun?upload_field='+upload_field);
    });
    

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>  