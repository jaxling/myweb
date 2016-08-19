<?php

namespace console\controllers;

use Yii;
use common\components\Myhelpers;
use common\models;

class ScreenController extends \yii\console\Controller
{


	public $enableCsrfValidation = false;  //必须加上此选项


    public function actionIndex()
    {
        echo 'test';

        return 1;
    }

}
