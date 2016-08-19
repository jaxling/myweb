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
                            ['label' => '充值', 'icon' => 'fa fa-file-code-o', 'url' => ['/cart']],
                            ['label' => '支付', 'icon' => 'fa fa-file-code-o', 'url' => ['/cart']],
                            ['label' => '资金', 'icon' => 'fa fa-file-code-o', 'url' => ['/cart']],                            
                        ],
                    ],
                    ['label' => '订单', 'icon' => 'fa fa-dashboard', 'url' => ['/order'],
                        'items' => [
                            ['label' => '订单', 'icon' => 'fa fa-file-code-o', 'url' => ['/order']],
                            ['label' => '购物车', 'icon' => 'fa fa-file-code-o', 'url' => ['/cart']],
                        ],
                    ],
                    ['label' => '商品', 'icon' => 'fa fa-dashboard', 'url' => ['/product'],
                        'items' => [
                            ['label' => '商品', 'icon' => 'fa fa-file-code-o', 'url' => ['/product']],
                            ['label' => '分类', 'icon' => 'fa fa-file-code-o', 'url' => ['/category']],
                            ['label' => '品牌', 'icon' => 'fa fa-file-code-o', 'url' => ['/brand']],
                            ['label' => '商品相册', 'icon' => 'fa fa-file-code-o', 'url' => ['/product-gallery']],
                        ],

                    ],
                    
                    ['label' => '文章', 'icon' => 'fa fa-dashboard', 'url' => ['/post'],
                        'items' => [
                            ['label' => '文章', 'icon' => 'fa fa-file-code-o', 'url' => ['/post']],
                            ['label' => '评论', 'icon' => 'fa fa-file-code-o', 'url' => ['/post-comment']],
                        ],
                    ],
                    ['label' => '相册', 'icon' => 'fa fa-file-code-o', 'url' => ['/album'],
                        'items' => [
                            ['label' => '相册', 'icon' => 'fa fa-file-code-o', 'url' => ['/album']],
                            ['label' => '图片库', 'icon' => 'fa fa-file-code-o', 'url' => ['/gallery']],
                        ],
                    ],
                    ['label' => '配送管理', 'icon' => 'fa fa-file-code-o', 'url' => ['/album'],
                        'items' => [
                            ['label' => '配送方式', 'icon' => 'fa fa-file-code-o', 'url' => ['/shipping-template']],
                            ['label' => '快递', 'icon' => 'fa fa-file-code-o', 'url' => ['/shipping']],
                            ['label' => '地区', 'icon' => 'fa fa-dashboard', 'url' => ['/region'],],
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
