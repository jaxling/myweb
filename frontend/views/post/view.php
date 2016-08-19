<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
?>

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

            <?php
            if($model):
            ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="/post/<?= $model->id;?>"><?= Html::encode($model->title);?></a>
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
                                
                <?php
                echo $model->content;                
                ?>

                <hr>
            <?php
            else:
                echo '没有找到合适内容';
            endif;
            ?>


                <!-- Blog Comments -->
                <div class="post-post-comment well">

                    <?php //$form = ActiveForm::begin(['action' => ['post/post-comment'],'method'=>'post',]); ?>
                    <?php $form = ActiveForm::begin(); ?>
                        <div style="display: none;">
                        <?= $form->field($post_comment, 'post_id') ?>
                        </div>
                        <?= $form->field($post_comment, 'author') ?>
                        <?php //$form->field($post_comment, 'title') ?>
                        <?= $form->field($post_comment, 'content')->textarea(['rows'=>3]) ?>
                        <?php //$form->field($post_comment, 'create_at') ?>
                        <?php //$form->field($post_comment, 'update_at') ?>
                        <?php //$form->field($post_comment, 'status') ?>
                    
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>

                </div><!-- post-post-comment -->            


                <!-- Posted Comments -->
                <?php
                if(!empty($model->postcomment)):
                    foreach ($model->postcomment as $key => $comment) :
                ?>
                <hr>
                <!-- Comment -->
                <div class="media">
                    <div class="media-body">
                        <h5 class="media-heading">Author: <?= Html::encode($comment->author) ?>
                            <small><?= Html::encode($comment->create_at) ?></small>
                        </h5>
                        <?= Html::encode($comment->content) ?>
                    </div>
                </div>

                <?php
                endforeach;
                endif;
                ?>

                <!-- Comment -->
                

            </div>

<?= $this->render('postright.php',['friendlink'=>$friendlink]);?>            