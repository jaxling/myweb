<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\assets\AppAsset;


//$this->registerCssFile('/css/umeditor/themes/default/css/umeditor.css');

// $this->registerJsFile('/css/umeditor/umeditor.config.js',[AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
// $this->registerJsFile('/css/umeditor/umeditor.min.js',[AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
// $this->registerJsFile('/css/umeditor/lang/zh-cn/zh-cn.js',[AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);



/* @var $this yii\web\View */
/* @var $model common\models\Test */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerCssFile('/css/umeditor/themes/default/css/umeditor.css');

$this->registerJsFile('/css/umeditor/umeditor.config.js',[AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
$this->registerJsFile('/css/umeditor/umeditor.min.js',[AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
$this->registerJsFile('/css/umeditor/lang/zh-cn/zh-cn.js',[AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);

// AppAsset::register($this);  
// AppAsset::addCss($this,'/css/umeditor/themes/default/css/umeditor.css');
// //AppAsset::addScript($this,'/css/umeditor/third-party/jquery.min.js');
// AppAsset::addScript($this,'/css/umeditor/umeditor.config.js');
// AppAsset::addScript($this,'/css/umeditor/umeditor.min.js');
// AppAsset::addScript($this,'/css/umeditor/lang/zh-cn/zh-cn.js');
?>

<?php $this->beginBlock('footer_js') ?>

$(function () {
    var um = UM.getEditor('test-content',{
        imageUrl:"/tool/umfile",
        imagePath:''
    });

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>  


