<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index" style="overflow:auto;">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>上级编号</th>
            <th>显示状态</th>
            <th>图片</th>
            <th>级别</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($list)) {
            foreach ($list as $k => $v) {
                $name = '';
                for ($i=2; $i <=$v['level'] ; $i++) { 
                    $name .= "----";
                }
                $img = $v['img'] ? "<img src=\"".$v['img']."!s50x50\" />" : '' ;
                echo 
                '<tr data-key="'.$v['id'].'">
                <td>'.$v['id'].'</td>
                <td>'.$name.Html::encode($v['name']).'</td>
                <td>'.$v['parent_id'].'</td>
                <td>'.Category::itemAlias("is_show", $v['is_show']).'</td>
                <td>'.$img.'</td>
                <td>'.$v['level'].'</td>
                <td>
                    <a href="/category/view/'.$v['id'].'">
                      <span class ="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="/category/update/'.$v['id'].'">
                      <span class ="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a href="/category/delete/'.$v['id'].'" data-method="post" data-confirm="您确定要删除此项吗？" >
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </td>
                  </tr>';
            }
        }    
        ?>
    </tbody>
</table>
