<?php
use yii\helpers\Html;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>上传</title>
    </head>
    <body>

        <form action="<?php echo $action; ?>" method="post" enctype="Multipart/form-data">
            <input type="hidden" name="policy" value="<?php echo $policy; ?>" />
            <input type="hidden" name="signature" value="<?php echo $sign; ?>" />
            <input type="file" name="file" required="required" />
            <input type="submit" id="upyun_submit" value=" &nbsp;&nbsp;上传&nbsp;&nbsp; "   />
        </form>

        <?php
        if($img_url) {
            echo '<img src="'.Html::encode($img_url).'"  style="max-width: 300px;" />
            <br><br>
            <input type="text"  value="'.Html::encode($img_url).'" style="width:100%;max-width: 300px;" />
            <br><br>
            ';
        }
        ?>


<script type="text/javascript">
    <?php if($img_url):?>
    <?php if($upload_field):?>
    window.parent.$('#<?= $upload_field?>').val('<?= $img_url?>');
    <?php endif;?>
    window.parent.$('#myModal').modal('hide');
    <?php endif;?>
</script>
    </body>
</html>
