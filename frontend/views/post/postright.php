<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
?> 

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <form action="/post/index" method="get" accept-charset="utf-8">
                    <h4>Search</h4>
                    <div class="input-group">
                        
                        
                        <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['name']))echo Html::encode($_GET['name']);?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                       
                    </div>
                    <!-- /.input-group -->
                     </form>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="<?= Url::toRoute(['post/index', 'c' => 1]);?>">技术</a>
                                </li>

                                <li><a href="<?= Url::toRoute(['post/index', 'c' => 3]);?>">随笔</a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="<?= Url::toRoute(['post/index', 'c' => 2]);?>">生活</a>
                                </li>
                                <li><a href="<?= Url::toRoute(['post/index', 'c' => 4]);?>">其它</a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- friendlink Well -->
                <?php if(isset($friendlink) && !empty($friendlink)) :?>
                <div class="well">
                    <h4>Friendlinks</h4>
                    <div class="row">
                            <ul class="list-unstyled">
                            <?php foreach ($friendlink as $key => $link) :?>

                                <li style="padding: 3px 15px;float: left;"><a href="<?= $link->href ?>" target="_blank"><?= $link->name ?></a>
                                </li>
                            <?php endforeach;?>


                            </ul>
    
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <?php endif;?>

            </div>

        
        <!-- /.row -->