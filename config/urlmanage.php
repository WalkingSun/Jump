<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/16
 * Time: 17:52
 */
return [
    'enablePrettyUrl' => true, // 路由美化
    'enableStrictParsing' => true, // 严格检查路由美化,后缀加s
    'showScriptName' => false,
    'cache' => false, // 关闭路由缓存
    'rules' => [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'site'
            ],
            'extraPatterns' => [
                'index' => 'index',
                'login' => 'login'
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'code'
            ],
            'extraPatterns' => [
                'index' => 'index',
                'login' => 'login'
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/user'
            ],
            'extraPatterns' => [
                'login' => 'login',
                'logout' => 'logout',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/purchaseorder'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'detail' => 'detail',
                'add' => 'add',
                'submit' => 'submit',
                'share' => 'share',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/supplier'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'detail' => 'detail',
                'common' => 'common',
                'add' => 'add',
                'edit' => 'edit',
                'enable' => 'enable',
            ],
        ],
         [
             'class' => 'yii\rest\UrlRule',
             'pluralize' => false,
             'controller' => [
                    'v1/material'
                ],
                'extraPatterns' => [
                    'types' => 'types',
                    'list' => 'list',
                    'plist' => 'plist',
                    'slist' => 'slist',
                    'tlist' => 'tlist',
                    'add' => 'add',
                    'init' => 'init',
                    'group' => 'group',
                ],
         ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/tree'
            ],
            'extraPatterns' => [
                'material' => 'material',
                'supplier' => 'supplier',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/storage'
            ],
            'extraPatterns' => [
                'list' => 'list',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/order'
            ],
            'extraPatterns' => [
                'beforeadd' => 'beforeadd',
                'info' => 'info',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/shop'
            ],
            'extraPatterns' => [
                'pcenter' => 'pcenter',
                'list' => 'list',
            ],
        ],
        
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/department'
            ],
            'extraPatterns' => [
                'list' => 'list',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/purreqorder'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'detail' => 'detail',
                'add' => 'add',
                'submit' => 'submit',
                'paylist' => 'paylist',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/iostock'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'stocki' => 'stocki',
                'stockidtl' => 'stockidtl',
                'stockidto' => 'stockidto',
                'stockiadd' => 'stockiadd',
                'stockisubmit' => 'stockisubmit',
                'stocko' => 'stocko',
                'stockodtl' => 'stockodtl',
                'stockoadd' => 'stockoadd',
                'stockosubmit' => 'stockosubmit',
                'pickingo' => 'pickingo',
                'pickingodtl' => 'pickingodtl',
                'pickingoadd' => 'pickingoadd',
                'pickingosubmit' => 'pickingosubmit',
                'pickingi' => 'pickingi',
                'pickingidtl' => 'pickingidtl',
                'pickingiadd' => 'pickingiadd',
                'pickingisubmit' => 'pickingisubmit',
                'detail' => 'detail',
                'add' => 'add',
                'submit' => 'submit',
                'test' => 'test',
                'transfero' => 'transfero',
                'transfero_dtl' => 'transfero_dtl',
                'transfero_sub' => 'transfero_sub',
                'transferi' => 'transferi',
                'transferi_dtl' => 'transferi_dtl',
                'transferi_sub' => 'transferi_sub',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/message'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'readed' => 'readed',
                'pay' => 'pay',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/invbackup'
            ],
            'extraPatterns' => [
                'fitype' => 'fitype',
                'list' => 'list',
                'detail' => 'detail',
                'add' => 'add',
                'submit' => 'submit',
                'complete' => 'complete',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/transferorder'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'detail' => 'detail',
                'add' => 'add',
                'submit' => 'submit',
                'revlist' => 'revlist',
                'approval' => 'approval',
                'refuse' => 'refuse',
                'revadd' => 'revadd',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/inventorys'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'test' => 'test',
            ],
        ],

        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/iostocksdtl'
            ],
            'extraPatterns' => [
                'stocko' => 'stocko',
                'stocki' => 'stocki',
            ],
        ],

        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/dishcost'
            ],
            'extraPatterns' => [
                'list' => 'list',
            ],
        ],

        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/materialcost'
            ],
            'extraPatterns' => [
                'list' => 'list',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/unit'
            ],
            'extraPatterns' => [
                'list' => 'list',
                'detail' => 'detail',
                'add' => 'add',
                'edit' => 'edit',
                'enable' => 'enable',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'v1/wallet'
            ],
            'extraPatterns' => [
                'statement' => 'statement',
                'detail' => 'detail',
                'info' => 'info',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/pay'
            ],
            'extraPatterns' => [
                'wx' => 'wx',
                'check' => 'check',
            ],
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize' => false,
            'controller' => [
                'v1/notify'
            ],
            'extraPatterns' => [
                'wx' => 'wx',
            ],
        ],

    ],

];
