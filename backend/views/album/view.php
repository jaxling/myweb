<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Album;
use backend\assets\AppAsset;

use common\models\Gallery;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '相册', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



    <br>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>选择图片上传...</span>
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






<div class="album-view">

    <h1><?= Html::encode($this->title) ?></h1>


<!--     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'des:ntext',
            'category_id',
            [
                'attribute'=> 'status',
                'value' => Album::itemAlias("status", $model->status),
            ],
            'create_at',
            'update_at',
        ],
    ]) ?> -->

</div>
    <div style="clear:both;"></div>
    <div id="gallery_warp">
    <?php
    if ($model->galleries) {
        foreach ($model->galleries as $key => $gallery) {
            echo '<a href="'.$gallery->img_url.'" target="_blank">
            <img  src="'.$gallery->img_url.'!s100" class="img-thumbnail" />
            </a>';
        }
    }
    ?>
    </div>
    <div style="clear:both;"></div>

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
    var url = '/tool/alum?id=<?= $model->id;?>';
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
