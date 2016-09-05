<?php
namespace frontend\controllers;

use Yii;
use yii\db\Query;


/**
 * Index controller
 */
class MusicController extends FController
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