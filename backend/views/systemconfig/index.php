<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Dd;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SystemconfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '全局配制';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemconfig-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::a('创建 全局配制', ['create'], ['class' => 'btn btn-success']) ?>
    </p>  
<?php
$list = Dd::find()
    ->where(['table_name' => 'systemconfig','field_name'=>'type'])
    ->orderBy('id ASC')
    ->all();
foreach ($list as $key => $value) {
    echo ' <a href="/systemconfig?SystemconfigSearch[type]='.$value->field_key.'"> '.$value->field_value.' </a> &nbsp;&nbsp;';
}
?>
      
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'type',
                'value' => function ($model, $key, $index, $column) {
                    return Dd::getDdValue('systemconfig','type',$model->type);
                },
                'filter'=>Dd::getDdValue('systemconfig','type'),
            ],
            'name',
            'keyword',
            'value1:ntext',
            // 'value2:ntext',
            // 'value3:ntext',
            // 'is_open',
            // 'sort_number',
            // 'remark',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
