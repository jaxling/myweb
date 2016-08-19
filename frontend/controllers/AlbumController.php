<?php
namespace frontend\controllers;

use Yii;
use yii\db\Query;
use common\models\Category;


/**
 * Index controller
 */
class AlbumController extends FController
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionView()
    {
        return $this->renderPartial('view');
    }
}