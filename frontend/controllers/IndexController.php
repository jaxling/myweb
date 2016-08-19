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
        $this->layout = 'main.php';
        //$this->getView()->title = $this->w_config['website_name'];
        if((Yii::$app->user->isGuest)){
            $userinfo = (new Query)
                ->select("*")
                ->from('user')
                ->where('id = :id',[':id'=>Yii::$app->user->id])
                ->all(); //one            
        $list = Category::getList();

        $a = [];    //存放第一级分类的 id
        $b = [];
        $c = [];
        //重新按照level排序分类列表
        foreach ($list as $k => $v) {
            if($v['level'] == 1){
                $a[] = $k;
            }elseif($v['level'] == 2){
                $b[] = $k;
            }else{
                $c[] = $k;
            }
        }
        //输出第一级
        if($a){
            foreach ($a as $k => $v) {
                //var_dump($list[$k]);
            }
        }
        /*var_dump($a);
        var_dump($b);
        var_dump($c);
        var_dump($list);*/         
        }
        

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