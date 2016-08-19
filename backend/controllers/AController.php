<?php

namespace backend\controllers;



use Yii;
use yii\web\Controller;

use common\models\Dd;
use common\models\Systemconfig;



/**
 * 后台基础，全局处理等
 */
class AController extends Controller
{
    /**
     * 全局配制
     * @param integer $w_config
     * @return [mixed]
     */
	public $w_config;  

    /**
     * init 初始化
     * @return mixed
     */
	public function init(){
        //加载共用方法
        require_once(Yii::getAlias('@common').'/functions.php');

        $this->w_config = Systemconfig::getConfigValue('website');

        $view = Yii::$app->view;
        $view->params['w_config'] = $this->w_config;  //用于view,view里面这样使用 $this->params['w_config']


        //多语言设置
        $cookies = Yii::$app->request->cookies;
        Yii::$app->language = 'zh-CN';
        if (isset($cookies['language'])) {
            if (in_array($cookies['language']->value, ['zh-CN','en'])) {
                Yii::$app->language = $cookies['language']->value;
            }      
        }

	}

	//关于属性  http://www.yiichina.com/doc/guide/2.0/concept-properties
    // private $_websiteconfig;
    // public function getWebsiteconfig()
    // {
    // 	$this->_websiteconfig = Systemconfig::getConfigValue('website');
    //     return $this->_websiteconfig;
    // }

    // public function setWebsiteconfig($value)
    // {
    //     $this->_websiteconfig = $value;
    // }

}

