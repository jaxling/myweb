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
        $cache = Yii::$app->cache;

        //读取站点素材相册中sort_number asc排名    //站点背景图，全局
        $img_url = $cache->get('img_url');

        if ($img_url === false) {
            $img_url = \common\models\Gallery::find()
                    ->where(['album.status' => 1,'gallery.status' => 1,'album.category_id' => 4])
                    ->andwhere("sort_number < 900")
                    ->joinWith('album',['gallery.album_id' => 'album.id'])
                    ->orderBy('sort_number asc')
                    ->asArray()
                    ->limit(8)
                    ->all();
            $cache->set('img_url', $img_url);
        }

        //读取友情链接
        $friend_link = $cache->get('friend_link');

        if ($friend_link === false) {
            $friend_link = \common\models\FriendLink::find()->where(['status' => 1])->asArray()->all();
            $cache->set('friend_link', $friend_link);
        }

        //网站宗旨
        $post = \common\models\Post::find()->where(['post_category_id' => 99])->one();

        //随机读取一句格言
        $sql = "SELECT COUNT(`id`) FROM `motto`";
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        $sql = "SELECT * FROM `motto` ORDER BY FLOOR(1 + (RAND() *$count)) LIMIT 1;";
        $motto = Yii::$app->db->createCommand($sql)->queryone();

        return $this->render('index',[
            'post' => $post,
            'motto' => $motto,
            'img_url' => $img_url,
            'friend_link' => $friend_link,
        ]);
    }


    /**
     * 清除缓存
     * @return [type] [description]
     */
    public function actionClear(){
        Yii::$app->cache->flush();
    }
}