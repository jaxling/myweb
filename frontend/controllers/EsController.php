<?php
namespace frontend\controllers;

use common\models\Es;
use yii\web\Controller;

/**
 *
 */
class EsController extends Controller
{

    public function actionIndex()
    {
        $Es = new Es();
        $Es->primaryKey = 1; //primaryKey 定义 _id

        $name = 'John';
        $sex = '男';
        $age = '19';

        $Es->name = $name;
        $Es->sex = $sex;
        $Es->age = $age;
        $Es->create_time = time();
        $res = $Es->save();

        var_dump($res);
        exit;

    }

    public function actionIndex2()
    {
        $Es = new Es();
        $res = $Es::find()->all();

        var_dump($res);
    }
}
