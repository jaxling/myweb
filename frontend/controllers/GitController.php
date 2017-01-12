<?php

namespace console\controllers;

use Yii;
/**
 * 更新代码
 */
class GitController extends \yii\console\Controller
{

    public $enableCsrfValidation = false;  //必须加上此选项
    
	public function actionIndex(){
		echo "-----------------------------\n";
		/*echo exec("cd /var/www/qqxinli && sudo -u www-data git pull origin master"); */
		echo exec("whoami");
	}

}