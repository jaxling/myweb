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

        $where = "";
        $c = intval(Yii::$app->request->get('c'));
        if ($c) {
            $where .= " `post_category_id`=$c AND ";
        }
        $name = strip_tags(Yii::$app->request->get('name'));
        if ($name) {
            $where .= " `title` like '%$name%' or `content` like '%$name%' AND ";
        }

        $where .= " status=1 AND  post_category_id!=99";

        //echo $where;exit;

        $query = Post::find()
            ->where( $where )
            ->orderBy('id DESC');
        $countQuery = clone $query;
        //$pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>'5','defaultPageSize' => 5]);
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>'10','defaultPageSize' => 10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->getView()->title = "Blog - ".$this->w_config['website_name'];  
            
        return $this->render('index',[
            'models' => $models,
            'pages' => $pages,
        ]);
    }


    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = intval($id);
        $model = Post::findOne($id);

        $title = isset($model->title) ? strip_tags($model->title) : 'Go';
        $this->getView()->title = $title." - ".$this->w_config['website_name']; 


        $post_comment = new PostComment();
        $post_comment->post_id = $model->id;

        //评论
        if ($post_comment->load(Yii::$app->request->post())) {
            if ($post_comment->validate()) {
                // form inputs are valid, do 
                if(preg_match('#http|com#i', $post_comment->title) || preg_match('#http|com#i', $post_comment->content)) {
                    //do something
                } else {
                   $post_comment->save(); 
                }
                $this->refresh();
                //$this->redirect(Url::toRoute(['post/view', 'id' => $model->id]));
            }
        }

        $friendlink = [];
        
        return $this->render('view', [
            'model'=>$model,
            'post_comment'=>$post_comment,
            'friendlink'=>$friendlink,
        ]);
    }


    public function actionAbout()
    {
        $id = 100;
        $model = Post::findOne($id);

        $title = isset($model->title) ? strip_tags($model->title) : 'Go';
        $this->getView()->title = $title." - ".$this->w_config['website_name']; 

        $post_comment = new PostComment();
        $post_comment->post_id = $model->id;

        //评论
        if ($post_comment->load(Yii::$app->request->post())) {
            if ($post_comment->validate()) {
                // form inputs are valid, do 
                $post_comment->save();
                $this->refresh();
                //$this->redirect(Url::toRoute(['post/view', 'id' => $model->id]));
            }
        }

        $friendlink = Friendlink::find()->where(['status'=>1,'position'=>1])->all();

        return $this->render('view', [
            'model'=>$model,
            'post_comment'=>$post_comment,
            'friendlink'=>$friendlink,
        ]);
    }



}