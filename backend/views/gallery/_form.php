<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Gallery;
use common\models\Album;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'img_url')->textInput(['maxlength' => true,'style'=>'width:60%;display: inline; margin-right: 20px;']) ?>

    <?php //$form->field($model, 'img_url_thumb')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'album_id')->textInput() ?>
    <?= $form->field($model, 'album_id')->dropDownList(Album::listId()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_page_img')->dropDownList(Gallery::itemAlias('is_page_img')) ?>

    <?= $form->field($model, 'status')->dropDownList(Gallery::itemAlias('status')) ?>

    <?= $form->field($model, 'sort_number')->textInput() ?>

    <?php //$form->field($model, 'create_at')->textInput() ?>

    <?php //$form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php $this->beginBlock('footer_js') ?>
//
jQuery(document).ready(function () {
    var button = '<button type="button" data-toggle="modal" data-target="#myModal" id="upload_img_url" upload_field="gallery-img_url"  style="">上传</button>';
    $('#gallery-img_url').after(button);
    $('#upload_img_url').click(function(){
        var upload_field = $(this).attr('upload_field');
        $('#upload_img_iframe').attr('src','/tool/uploadupyun?upload_field='+upload_field);
    });
    

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>  


