<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use backend\assets\AppAsset;
use common\models\Post;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'post_category_id')->dropDownList(Post::itemAlias('post_category_id')) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['style' => 'width:760px;height:500px;']) ?>

    <?= $form->field($model, 'topic_img')->fileInput(['maxlength' => true]) ?>
    <?php
    if($model->topic_img){ 
        echo '<img src="'.$model->topic_img.'!s150" 
         class="img-thumbnail delete_img" delete_attr="topic_img" id="topic_img_'.$model->id.'" >';
    }
    ?>
    


    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(Post::itemAlias('status')) ?>

    <?php //$form->field($model, 'hits')->textInput() ?>

    <?php //$form->field($model, 'create_at')->textInput() ?>

    <?php //$form->field($model, 'update_at')->textInput() ?>

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

jQuery(document).ready(function () {

    var um = UM.getEditor('post-content',{
        imageUrl:"/tool/umfile",
        imagePath:''
    });

    //var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.delete_img').click(function(){
        var delete_attr = $(this).attr('delete_attr');
        if(confirm('确定删除？')) {
            $.ajax({
                type: "POST",
                url: "/post/deleteimg" ,
                data: { id:"<?= $model->id ?>",delete_attr:delete_attr, _csrf: "<?= Yii::$app->request->csrfToken ?>" },
                success: function (data) {
                    if(data == 'ok') {
                        $('#topic_img_<?= $model->id ?>').remove();
                    }
                }
            });            
        }
    });

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>  
