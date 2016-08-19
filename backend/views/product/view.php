<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ProductGallery;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定要删除此商品？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'keywords',
            'des:ntext',
            'market_price',
            'product_price',
            'promotion_price',
            'spec',
            'weight',
            'weight_unit',
            'brand_id',
            'stock',
            'serial_number',
            'full_cut_shipping_free',
            'supply',
            'is_show',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
    <div style="clear:both;"></div>
    <p style="margin:-3px 0 10px 9px"><b>商品展示图</b></p>
    <div id="gallery_warp">

    <?php
        $cid = Yii::$app->request->get('id');
        $pic = ProductGallery::find()->where(['product_id' => $cid])->orderBy('id DESC')->asArray()->all();
        //var_dump($pic);exit;
        if ($cid && $pic) {
            foreach ($pic as $key => $gallery) {
                echo '<a href="'.$gallery['img_url'].'" target="_blank">
                <img  src="'.$gallery['img_url'].'!s100" class="img-thumbnail" />
                </a>';
            }
        }
    ?>
    </div>
    <div style="clear:both;"></div>