<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    	'urlManager' => [
    		'class' => 'yii\web\UrlManager',
    		// Disable index.php
    		'showScriptName' => false,
    		// Disable r= routes
    		'enablePrettyUrl' => true,
    		'rules' => [],
    	],    		
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
