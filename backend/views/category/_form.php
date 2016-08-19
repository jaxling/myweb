<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pinyin_name')->textInput(['maxlength' => true]) ?>

    <?php 
        $list = Category::getList();
        $cid = Yii::$app->request->get('id');
        $cate_list = [];
        $cate_list[0] = '最高级';

        if($list) {
            foreach ($list as $k => $v) {
                if($v['level'] == 3) {  //第三级不能作为上级
                    continue;
                }
                //如果是修改
                if($cid){
                    if($cid == $v['id']){    //自己不能作为上级
                        continue;
                    }
                }
                $name = '';
                if($v['level'] == 2) {
                    $name = ' --- ';
                }
                $cate_list[$v['id']] = $name.$v['name'];
            }
        }
        echo $form->field($model, 'parent_id')->dropDownList($cate_list);
    ?>

    <?= $form->field($model, 'is_show')->dropDownList(Category::itemAlias('is_show')) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true,'style'=>'width:60%;display: inline; 
    margin:0 20px 10px;']) ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->beginBlock('footer_js') ?>
//
jQuery(document).ready(function () {
    var button = '<button type="button" data-toggle="modal" data-target="#myModal" id="upload_img_url" upload_field="category-img"  style="">上传</button>';
    $('#category-img').after(button);
    $('#upload_img_url').click(function(){
        var upload_field = $(this).attr('upload_field');
        $('#upload_img_iframe').attr('src','/tool/uploadupyun?upload_field='+upload_field);
    });
    

});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>  
