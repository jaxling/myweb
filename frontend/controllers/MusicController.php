<?php
namespace frontend\controllers;

use Yii;
use yii\db\Query;


/**
 * Index controller
 */
class MusicController extends FController
{

    public $enableCsrfValidation = false;
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //查询
        $col = "`name`,`author`,`image_url`,`url`";
        $sql = "SELECT {$col} FROM `music` WHERE `is_show` = 1 ORDER BY `order_num`";
        $list = Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($list as $key => $v) {
            $data[$key]['title'] = $v['name'];
            $data[$key]['artist'] = $v['author'];
            $data[$key]['album'] = $v['name'];
            $data[$key]['cover'] = $v['image_url'];
            $data[$key]['mp3'] = $v['url'];
            $data[$key]['ogg'] = '';
        }

        //页面加载完成之后请求数据
        if ($_POST) {
            return json_encode($data);
        }

        return $this->renderPartial('index');
    }
}