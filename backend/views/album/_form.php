<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Album;


/* @var $this yii\web\View */
/* @var $model common\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(Album::itemAlias('category_id')) ?>


<div class="form-group field-postmtb-album_id">
<label class="control-label" for="postmtb-album_id">相册</label>
<select id="postmtb-album_id" class="form-control" name="Postmtb[album_id]">
<option value="0">相册</option>
<?php
$albums = Album::listId();
foreach ($albums as $key => $value) {
    if($key == $model->album_id) {
        echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
    } else {
        echo '<option value="'.$key.'">'.$value.'</option>';
    } 
}
?>
</select>

<div class="help-block"></div>
</div>
    <?php //$form->field($model, 'create_at')->textInput() ?>

    <?php //$form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
