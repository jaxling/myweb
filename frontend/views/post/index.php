<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Mrling.site</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/music">Music</a>
                    </li>
                    <li>
                        <a href="/album">Album</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <a href="">Page Heading</a>
                </h1>
                <p> Posted on August 28, 2013 at 10:00 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php if ($list): ?>
                    <?php foreach ($list as $k => $v): ?>
                        <h2>
                            <a href="/post/<?=$v['id']?>"><?=$v['title']?></a>
                        </h2>
                        <hr>

                        <!-- First Blog Post -->
                        
                        <p class="lead"><?=$v['title']?><span style="margin-left: 15px;"></span>
                            <?=date('Y-m-d H:i',strtotime($v['create_at']))?></p>
                        <!-- <hr>
                        <img class="img-responsive" src="http://placehold.it/900x300" alt=""> -->
                        <hr>
                        <p>
                            <?php 
                              if(strlen($v['content'])>600){
                                echo mb_substr($v['content'],0,200,'utf-8').'...';
                              }else{
                                echo $v['content'];
                              }
                            ?>
                        </p>
                        <?php if (strlen($v['content'])>600): ?>
                            <a class="btn btn-primary" href="/post/<?=$v['id']?>">查看详情</a>
                        <?php endif ?>

                        <hr></br>
                    <?php endforeach ?>
                <?php else: ?>
                    <br/>
                    <p class="lead">没有记录~</p><a href="/post">返回</a>
                <?php endif ?>

                <!-- Second Blog Post -->
                

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <div class="col-md-4">
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="/zixun" onsubmit="return checksearch()" id="searchform">
                        <div class="input-group">
                            <input type="text" class="form-control" id="title" value="<?=$title?>" placeholder='输入你想搜索的关键词'>
                            <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" id="search">
                                    <span class="glyphicon glyphicon-search"></span>
                                </input>
                            </span>
                        </div>
                    </form>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Contact Me</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li style="width:400px;margin-top:10px;">Email：357341139@qq.com </li>
                                <li style="width:400px;margin-top:10px;">GitHub：
                                    <a href="https://github.com/niwish">https://github.com/niwish</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <div class="well">
                    <h4>Hot Posts</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php foreach ($hot_ask as $k => $v): ?>
                                    <li style="width:400px;margin-top:10px;">
                                        <a href="/post/<?=$v['id']?>">
                                            <?php 
                                              if(strlen($v['title'])>45){
                                                echo mb_substr($v['title'],0,14,'utf-8').'...';
                                              }else{
                                                echo $v['title'];
                                              }
                                            ?>
                                            <span style="float:right;margin-right:80px;">
                                                <?=date('Y-m-d H:i',strtotime($v['create_at']))?>
                                            </span>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Mrling.site <?=date('Y')?></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="/resourse/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/resourse/js/bootstrap.min.js"></script>

</body>

</html>
