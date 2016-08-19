<?php
return [
	'language'=>'zh-CN',
    'sourceLanguage' => 'en-US', //http://www.yiichina.com/doc/guide/2.0/tutorial-i18n
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],

        ], 
        
    ],
];
