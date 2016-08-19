<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Product;
use common\models\ProductCategory;
use common\models\ProductGallery;
use common\models\Category;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group field-product-spec">
        <label class="control-label" for="product-spec">商品分类</label>
        <select class="form-control" name="product_category_id">
        <!-- 添加到商品分类表中 -->
        <?php
            //如果是修改。查询分类
            $id = Yii::$app->request->get('id');

            $ui = '';
            if($id){
                $ui = ProductCategory::find()->select('category_id')->where(['product_id'=>$id])->Scalar();
            }
            //查询分类列表、最低级的
            $list = Category::getList();
            $cate_list = [];
            if($list){
                foreach ($list as $k => $v) {
                    $name = '';
                    if($v['level'] != 3) {
                        $name = ' --- ';
                        continue;
                    }/*
                    if($v['level'] == 3) {  
                        $name = ' ------ ';
                    }*/
                    $cate_list[$v['id']] = $name.$v['name'];
                }
            }
            foreach ($cate_list as $k => $v) {
                if($ui){
                    if($k == $ui){
                        echo "<option selected = 'selected' value='".$k."'>".$v."</option>";    
                    }else{
                        echo "<option value='".$k."'>".$v."</option>";
                    }
                }else{
                    echo "<option value='".$k."'>".$v."</option>";    
                }                    
            }

        ?>
        </select>
        <div class="help-block"></div>
    </div>
<?php if(Yii::$app->request->get('id')) {?>
    <br>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>上传商品图片</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>
<?php }?>
    <div style="clear:both;"></div>
    <div id="gallery_warp" style="margin:-30px 0 30px 0;">

    <?php
        $cid = Yii::$app->request->get('id');
        $pic = ProductGallery::find()->where(['product_id' => $cid])->orderBy('id DESC')->asArray()->all();
        //var_dump($pic);exit;
        if ($cid && $pic) {
            foreach ($pic as $key => $gallery) {
                echo '<a href="'.$gallery['img_url'].'" target="_blank">
                <img  src="'.$gallery['img_url'].'!s100" class="img-thumbnail" />
                </a>';
            }
        }
    ?>
    </div>
    <div style="clear:both;"></div>


    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'market_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promotion_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spec')->dropDownList(Product::itemAlias('spec')) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight_unit')->dropDownList(Product::itemAlias('weight_unit')) ?>

    <?= $form->field($model, 'brand_id')->dropDownList(Product::itemAlias('brand_id')) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_cut_shipping_free')->dropDownList(Product::itemAlias('full_cut_shipping_free')) ?>

    <?= $form->field($model, 'supply')->dropDownList(Product::itemAlias('supply')) ?>

    <?= $form->field($model, 'is_show')->dropDownList(Product::itemAlias('is_show')) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
AppAsset::addCss($this,'/jQuery_File_Upload/css/jquery.fileupload.css');
AppAsset::addScript($this,'/jQuery_File_Upload/js/vendor/jquery.ui.widget.js');
AppAsset::addScript($this,'/jQuery_File_Upload/js/jquery.iframe-transport.js');
AppAsset::addScript($this,'/jQuery_File_Upload/js/jquery.fileupload.js');
?>
<?php $this->beginBlock('footer_js') ?>
console.log("test");

/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    //var url = '/jQuery_File_Upload/server/php/';

    var url = '/tool/alum?id=<?= $model->id;?>&use=1';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                var img_text = '<a href="'+file.url+'" target="_blank"><img src="'+file.thumbnailUrl+'" class="img-thumbnail"></a>';
                $("#gallery_warp").prepend(img_text);
                //$(img_text).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['footer_js'], \yii\web\View::POS_END); ?>