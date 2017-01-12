<?php
namespace frontend\controllers;
use yii;
use common\models\Post;
use common\models\PostComment;
use common\models\Friendlink;

use yii\data\Pagination;
use yii\helpers\Url;
/**
 * Post controller
 */
class PostController extends FController
{



    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $cur_page = Yii::$app->request->get('page');

        $where = '';
        $title = trim(Yii::$app->request->get('title',''));

        if (isset(explode('_p',$title)[1])) {
            $cur_page = explode('_p',$title)[1];
            $title = explode('_p',$title)[0];
        }
        $where .= " WHERE `title` LIKE '%{$title}%' OR `author` LIKE '%{$title}%' OR `content` LIKE '%{$title}%' OR `desc` LIKE '%{$title}%'";
        //总数
        $sql = "SELECT count(*) FROM `post`".$where;
        $count = Yii::$app->db->createCommand($sql)->queryScalar();

        //分页
        $page_btn = 10;    //几个按钮
        $page_limit = 20; //一页多少数据
        $page_sum = intval(($count+$page_limit-1)/$page_limit);
        if (!$cur_page) {
            $cur_page = 1;
        }elseif ($cur_page>$page_sum) {
            $cur_page = $page_sum;
        }
        $page_offset = ($cur_page-1)*$page_limit;

        //分页后的列表
        $sql = "SELECT * FROM `post` ".$where." ORDER BY `create_at` DESC LIMIT $page_offset,$page_limit";
        $list = Yii::$app->db->createCommand($sql)->queryAll();

        
        //热门心事
        $sql = "SELECT * FROM `post` ORDER BY `hits` DESC ,`create_at` DESC LIMIT 10";
        $hot_ask = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->renderPartial('index',[
            'title'=>$title,
            'list' => $list,
            'page_btn' => $page_btn,
            'page_sum' => $page_sum,
            'cur_page' => $cur_page,
            'page_limit' => $page_limit,
            'page_offset' => $page_offset,
            'hot_ask' => $hot_ask,
        ]);
    }


    public function actionView()
    {
        $id = (int)Yii::$app->request->get('id');

        $sql = "SELECT * FROM `ask` WHERE `id` = {$id}";
        $detail = Yii::$app->db->createCommand($sql)->queryOne();

        if (!$detail) throw new BadRequestHttpException('该心事不存在');

        //增加该心事点击量
        $sql = "UPDATE `ask` SET `click` = {$detail['click']}+1 WHERE `id` = {$id}";
        $aaa = Yii::$app->db->createCommand($sql)->execute();

        //查询该心事的回复列表
        $sql = "SELECT * FROM `answer` WHERE `ask_origin_id` = {$detail['origin_id']}";
        $answer = Yii::$app->db->createCommand($sql)->queryAll();

        //热门心事
        $sql = "SELECT * FROM `ask` WHERE `id` <> {$id} ORDER BY `click` DESC ,`create_time` DESC LIMIT 10";
        $hot_ask = Yii::$app->db->createCommand($sql)->queryAll();

        //页面SEO
        $sql = "SELECT * FROM `seo` WHERE `position` = 'zixun_details'";
        $seo = Yii::$app->db->createCommand($sql)->queryOne();

        $content = $detail["content"];
        $seo['title'] = str_replace('{title}', $detail['title'], $seo['title']);
        if(strlen($detail["content"])>600){
            $content = mb_substr($detail["content"],0,200,'utf-8').'...';
        }
        $seo['description'] = str_replace('{description}',$content,$seo['description']);

        Yii::$app->view->params['seo'] = $seo;

        return $this->render('detail',[
            'detail' => $detail,
            'answer' => $answer,
            'hot_ask' => $hot_ask,
        ]);
    }

    public function actionDemo(){
        return $this->renderPartial('demo');
    }

}