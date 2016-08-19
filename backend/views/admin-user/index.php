<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Dd;
use common\models\AdminUser;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered','style'=>'width:auto;max-width:none;'],
        'options' => ['class' => 'grid-view','style'=>'overflow:auto'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            [
                'attribute' => 'created_at',
                'value' => function ($model, $key, $index, $column) {
                    return date('Y-m-d H:i:s',$model->created_at);
                }

            ],
            [
                'attribute' => 'branch',
                'value' => function ($model) { return AdminUser::itemAlias("branch",  $model->branch); },
                'filter'=>AdminUser::itemAlias("branch"),
            ],
            [
                'attribute' => 'work_status',
                'value' => function ($model) { return AdminUser::itemAlias("work_status", $model->work_status); },
                'filter'=>AdminUser::itemAlias("work_status"),
            ],
            //'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
