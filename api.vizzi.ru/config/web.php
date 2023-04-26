<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
	'name' => 'Booking',
	'version' => '0.4 dev',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'ru-RU',
	'timezone' => 'Europe/Moscow',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'FHOYGIf2fhfxTGB8xu_TyaRZTK0VfzJI',
			'baseUrl'=> '',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]		
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => ['site/login'],
			//'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		/*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
		*/

		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => false,
			'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'vh526442.eurodir.ru',
        'username' => 'info@vh526442.eurodir.ru',
        'password' => 'fV7yO5wN6v',
        'port' => '465',
        'encryption' => 'ssl',
			],
		],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
'urlManager' => [
    'enablePrettyUrl' => true,
	//'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
		['class' => 'yii\rest\UrlRule', 'controller' => 'api/reviews'],
		['class' => 'yii\rest\UrlRule', 'controller' => 'api/camps'],
		['class' => 'yii\rest\UrlRule', 'controller' => 'api/tours'],
		['class' => 'yii\rest\UrlRule', 'controller' => 'api/campsfiles'],
    ['class' => 'yii\rest\UrlRule', 'controller' => 'api/services-files'],
		['class' => 'yii\rest\UrlRule', 'controller' => 'api/user'],
        '' => 'site/index',
        '<action>'=>'site/<action>',
		//materials/default/read?id=22
		'catalog/default/view/<id:\d+>' => 'catalog/default/view',	
//		'service/<controller>/<action>' => 'service/<controller>/<action>',
    ],
],

    ],
	'modules' => [
        'api' => [
        'class' => 'app\modules\api\Module',
		],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],	
        //'escort' => [
        //    'class' => 'app\modules\escort\Module',
        //],
		'favorites' => [
            'class' => 'app\modules\favorites\Module',
        ],
		'msg' => [
            'class' => 'app\modules\msg\Module',
        ],
		'admin' => [
            'class' => 'app\modules\admin\Module', 
        ],
        'manager' => [
            'class' => 'app\modules\manager\Module', 
        ],	
        'catalog' => [
            'class' => 'app\modules\catalog\Module', 
        ], 		//promocodes
	],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
//        'allowedIPs' => ['77.222.120.122'],
      'allowedIPs' => ['193.93.122.1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
//        'allowedIPs' => ['77.222.120.122'],
      'allowedIPs' => ['193.93.122.1'],
    ];
}

return $config;
