<?php
//use yii\bootstrap\Nav;
?>
<aside class="main-sidebar">

    <section class="sidebar">


<?php
//https://github.com/mdmsoft/yii2-admin/blob/master/docs/guide/using-menu.md 
//no use
// echo Nav::widget([
//     'items' => mdm\admin\classes\MenuHelper::getAssignedMenu(Yii::$app->user->id)
// ]);
?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '用户', 'icon' => 'fa fa-dashboard', 'url' => ['/user'],
                        'items' => [
                            ['label' => '用户', 'icon' => 'fa fa-file-code-o', 'url' => ['/user']],                     
                        ],
                    ],
                    ['label' => '文章', 'icon' => 'fa fa-dashboard', 'url' => ['/post'],
                        'items' => [
                            ['label' => '格言', 'icon' => 'fa fa-file-code-o', 'url' => ['/motto']],
                            ['label' => '文章', 'icon' => 'fa fa-file-code-o', 'url' => ['/post']],
                            ['label' => '评论', 'icon' => 'fa fa-file-code-o', 'url' => ['/post-comment']],
                        ],
                    ],
                    ['label' => '音乐', 'icon' => 'fa fa-file-code-o', 'url' => ['/music'],
                        'items' => [
                            ['label' => '音乐', 'icon' => 'fa fa-file-code-o', 'url' => ['/music']],
                        ],
                    ],
                    ['label' => '相册', 'icon' => 'fa fa-file-code-o', 'url' => ['/album'],
                        'items' => [
                            ['label' => '相册', 'icon' => 'fa fa-file-code-o', 'url' => ['/album']],
                            ['label' => '图片库', 'icon' => 'fa fa-file-code-o', 'url' => ['/gallery']],
                        ],
                    ],


                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => '系统设置',
                        'icon' => 'fa fa-dashboard',
                        'url' => '#',
                        'items' => [
                            ['label' => '数据字典', 'icon' => 'fa fa-file-code-o', 'url' => ['/dd'],],
                            
                            ['label' => '友情链接', 'icon' => 'fa fa-file-code-o', 'url' => ['/friendlink']],
                            ['label' => '全局配制', 'icon' => 'fa fa-dashboard', 'url' => ['/systemconfig'],],
                            [
                                'label' => '权限',
                                'icon' => 'fa fa-circle-o',
                                'url' => ['/admin-user'],
                                'items' => [
                                    ['label' => '管理员', 'icon' => 'fa fa-circle-o', 'url' => ['/admin-user'],],
                                    ['label' => '分配权限', 'icon' => 'fa fa-circle-o', 'url' => ['/admin#/assignment'],],
                                    // [
                                    //     'label' => 'Level Two',
                                    //     'icon' => 'fa fa-circle-o',
                                    //     'url' => '#',
                                    //     'items' => [
                                    //         ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    //         ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    //     ],
                                    // ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
