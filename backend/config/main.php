<?php

use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'Stand Auto',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'formatter' => [
            'class' => 'yii\i18n\formatter',
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'currencyCode' => '€'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                //user
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/user',
                    'extraPatterns' => [
                        'GET login' => 'login',
                    ],
                ],

                //veiculos
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/vehicle',
                    'extraPatterns' => [
                        'GET total' =>'total', //total
                        'GET {id}/price' => 'price', //preço do veiculo
                        'GET brand/{id}' => 'brand', //por marca
                        'GET model/{id}' => 'model', //por modelo
                        'GET {id}/status' => 'status',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ]
                ],

                //marcas
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/marcas',
                    'extraPatterns' => [],
                    'tokens' => []
                ],

                //modelos
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/modelos',
                    'extraPatterns' => [
                        'GET pormarca/{idBrand}' => 'modelospormarca',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                        '{idBrand}' => '<idBrand:\\d+>'
                    ]
                ],

                //testdrives
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/testdrive',
                    'extraPatterns' => [
                        'GET user' => 'mytestdrives', //user pode ver os seus testdrives
                    ],
                ],

                //vendauser
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/vendauser',
                ],

                //login
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/login',
                    'extraPatterns' => [
                        //'GET login' => 'behaviors',
                        //'GET signup' => 'signup',
                    ],
                ]
            ],
        ]
    ],
    'params' => $params,
];
