<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'app',
    'name' => 'Yii2 Chat Application',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'defaultRoute' => 'chat',
    'bootstrap' => [
        'log',
        'app\components\ModuleManager',
        'app\components\EventManager',
    ],
    'aliases' => [
        '@bower'    => '@vendor/bower-asset',
        '@npm'      => '@vendor/npm-asset',
        '@modules'  => 'app\modules',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1f4vtVSY5RbfAkUXtmvJYB0CeYgvVbJC',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'chat/default/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'assetManager' => [
            'appendTimestamp' => true,
            'linkAssets' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'action' => yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY, // используем временный редирект вместо постоянного
            ],
            'rules' => [
                ''                              => 'chat/default/index',
                '<action:signup|login|logout>'  => 'chat/default/<action>',

                [
                    'class' => 'yii\web\GroupUrlRule',
                    'prefix' => 'admin',
                    'routePrefix' => 'admin',
                    'rules' => [
                        '' => 'default/index',

                        '<_a:create>'                   => 'default/<_a>',
                        '<_a:view|update|delete>/<id>'  => 'default/<_a>',

                        '<module>/<_a:view|update|delete>/<id>' => '<module>/default/<_a>',

                        '<module>'                          => '<module>/default/index',
                        '<module>/<controller>'             => '<module>/<controller>/index',
                        '<module>/<controller>/<action>'    => '<module>/<controller>/<action>',
                    ],
                ],

                '<module>/<_a:view|update|delete>/<id>' => '<module>/default/<_a>',

                '<module>'                          => '<module>/default/index',
                '<module>/<controller>'             => '<module>/<controller>/index',
                '<module>/<controller>/<action>'    => '<module>/<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'traceLine' => '<a href="phpstorm://open?file={file}&line={line}">{file}:{line}</a>',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
