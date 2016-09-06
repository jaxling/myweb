<?php

namespace frontend\controllers;



use Yii;
use yii\web\Controller;

use common\models\Dd;
use common\models\Systemconfig;



/**
 * 前台基础，全局处理等
 */
class FController extends Controller
{



	public $w_config = array();  //用于Controller 
    public $w_pic = [];

	public function init(){
        //加载共用方法
        require_once(Yii::getAlias('@common').'/functions.php');

        $this->w_config = Systemconfig::getConfigValue('website');

        $view = Yii::$app->view;
        $view->params['w_config'] = $this->w_config;  //用于view,view里面这样使用 $this->params['w_config']

        //站点背景图，全局
        $img_url = \common\models\Gallery::find()
                ->select("img_url")
                ->where(['album.status' => 1,'gallery.status' => 1,'album.category_id' => 4])
                ->joinWith('album',['gallery.album_id' => 'album.id'])
                ->asArray()
                ->all();

        $view->params['w_pic'] = $this->w_pic = $img_url[array_rand($img_url)]['img_url'];


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

