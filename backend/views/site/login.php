<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Ling's CMS Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/supersized.css">
        <link rel="stylesheet" href="../css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body oncontextmenu="return false">

        <div class="page-container">
            <h1>Login</h1>

            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->error(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->error(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                <div class="col-xs-4">
                    <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'id' => 'submit']) ?>
                </div>
            
            <?php ActiveForm::end(); ?>

            <div class="connect">
                <p><?=Html::encode($motto['english'])?></p>
                <p style="margin-top:20px;"><?=Html::encode($motto['chinese'])?></p>
            </div>
        </div>
        <div class="alert" style="display:none">
            <h2>消息</h2>
            <div class="alert_con" style="height:160px;">
                <p id="ts"></p>
                <p style="line-height:40px"><a class="btn">确定</a></p>
            </div>
        </div>
    </body>

</html>
<!-- Javascript -->
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/supersized.3.2.7.min.js"></script>
<script src="../js/supersized-init.js"></script>
<script src="../js/layer.js"></script>
<script>


    $(".btn").click(function(){
        is_hide();
    })
    var u = $("#loginform-username");
    var p = $("#loginform-password");
    $("#submit").on('click',function(){
        if(u.val() == '' || p.val() =='')
        {
            $("#ts").html("用户名或密码不能为空~");
            is_show();
            return false;
        }else{
            $('form').submit();
        }
    });
    var success = <?php echo $error;?>;
    if(success == 1){
        $("#ts").html("账号或密码错误~");
        is_show();
    }

    window.onload = function()
    {
        $(".connect p").eq(0).animate({"left":"0%"}, 600);
        $(".connect p").eq(1).animate({"left":"0%"}, 400);
    }
    function is_hide(){ $(".alert").animate({"top":"-40%"}, 300) }
    function is_show(){ $(".alert").show().animate({"top":"45%"}, 300) }
</script>
