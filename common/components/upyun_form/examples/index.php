<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Form sdk for UPYUN</title>
    </head>
    <body>
        <?php
        require_once('../config.php');
        ?>
        <form action="<?php echo $action; ?>" method="post" enctype="Multipart/form-data">
            <input type="hidden" name="policy" value="<?php echo $policy; ?>" />
            <input type="hidden" name="signature" value="<?php echo $sign; ?>" />
            <input type="file" name="file" />
            <input type="submit" />
        </form>
    </body>
</html>
