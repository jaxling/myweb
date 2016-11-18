<?php
namespace frontend\controllers;

use Yii;
use yii\db\Query;
use common\models\Album;
use common\models\Category;


/**
 * Index controller
 */
class AlbumController extends FController
{

    public $enableCsrfValidation = false;
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $sql = "SELECT * FROM `album` WHERE `status` = 1";
        $list = Yii::$app->db->createCommand($sql)->queryAll();

        if($list){
            foreach ($list as $k => $v) {
                $sql = "SELECT `img_url` FROM `gallery` 
                        WHERE `album_id` = {$v['id']} AND `status` = 1 AND `is_page_img` = 2 
                        ORDER BY `sort_number` ASC";
                $res = Yii::$app->db->createCommand($sql)->queryScalar();
                if ($res) {
                    $list[$k]['page_img'] = $res;
                }
            }
        }

        return $this->renderPartial('index',[
            'list' => $list,
        ]);
    }

    public function actionView(){
        
        $album_id = (int)Yii::$app->request->get('id');
        
        if (!Album::findOne($album_id)) {
            exit('error album id');
        };

        $page = Yii::$app->request->post('page',1);

        $pageSize = 10;

        $db = Yii::$app->db;
        $sql = "SELECT COUNT(*) FROM `gallery` WHERE `album_id` = {$album_id} AND `status` = 1";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();

        $countPage = ceil($count / $pageSize);
        $offset = ($page-1)*$pageSize;
        $limit = $offset.','.$pageSize;

        $col = "`id`,`img_url`,`title`,`desc`";
        $sql = "SELECT {$col} FROM `gallery` 
                WHERE `album_id` = {$album_id} AND `status` = 1
                ORDER BY `is_page_img` DESC,`sort_number` ASC
                LIMIT {$limit}";
        $list = Yii::$app->db->createCommand($sql)->queryAll();

        if (Yii::$app->request->post('page')) {
            $data = [];
            foreach ($list as $key => $v) {
                $data[$key]['src'] = $v['img_url'];
                $data[$key]['title'] = $v['title'];
            }

            return json_encode($data);
        }
        
        return $this->renderPartial('view',[
            'list' => $list,
            'page' => $page+1,
            'countPage' => $countPage,
        ]);
    }
}