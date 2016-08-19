<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\widgets\LinkPager;
use yii\helpers\Url;
?>

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Blog
                    <small>Go!Go!Go!</small>
                </h1>

            <?php
            if($models):
            foreach ($models as $key => $model) :
            ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="<?= Url::toRoute(['post/view', 'id' => $model->id]);?>"><?= Html::encode($model->title);?></a>
                </h2>
                <?php if($model->author):?>
                <p class="lead">
                    by <?= Html::encode($model->author);?>
                </p>
                <?php endif;?>
                <p><span class="glyphicon glyphicon-time"></span> <?= $model->create_at;?></p>
                <hr>
                <?php
                if ($model->topic_img) {
                    echo '<img class="img-responsive" src="'.Html::encode($model->topic_img).'" alt="">
                    <hr>
                    ';
                }
                ?>
                
                
                <p><?php
                if ($model->desc) {
                    echo Html::encode($model->desc);
                } else {
                    echo Html::encode(@mb_substr(trim(strip_tags($model->content)),0, 30,'utf-8'));
                }
                
                ?></p>
                <a class="btn btn-primary" href="<?= Url::toRoute(['post/view', 'id' => $model->id]);?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php
            endforeach;
            else:
                echo '没有找到合适内容';
            endif;
            ?>



<?php
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>
            </div>

<?= $this->render('postright.php');?>