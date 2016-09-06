<?php
namespace frontend\controllers;

use Yii;
use yii\db\Query;
use common\models\Category;


/**
 * Index controller
 */
class IndexController extends FController
{


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //读取
        return $this->render('index');
    }


    /**
     * 清除缓存
     * @return [type] [description]
     */
    public function actionClear(){
        Yii::$app->cache->flush();
    }
}