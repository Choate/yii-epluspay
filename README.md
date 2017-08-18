# 招行E+支付 Yii 2 扩展

# 安装
基于composer安装

`php composer.phar require choate/yii-epluspay`


# 说明

## 基本配置

```php
'components' => [
    'eplusclient'        => [
        'class' => 'choate\yii\epluspay\Client',
        'channelNo'  => 'xxxx',
        'serverUrl'  => 'http://example.com',
        'lang'       => 'zh_CN',
        'publicKeyNo' => 'xxxx',
        'encryption' => [
           'class' => 'choate\epluspay\helpers\Sha1WithRSAHelper',
           'params' => [
               "private key file path or \Closure",
               "public key file path or \Closure",
           ],
        ], 
    ],
    'epluspayclient' => [
        class' => 'choate\yii\epluspay\PayOrdersClient',
        'shopId' => 'xxx',
        'notifyUrl' => 'notify url',
        //'client' => 'eplusclient',
        // 统一配置
        'client' => [
            'class' => 'choate\yii\epluspay\Client',
            'channelNo'  => 'xxxx',
            'serverUrl'  => 'http://example.com',
            'lang'       => 'zh_CN',
            'publicKeyNo' => 'xxxx',
            'encryption' => [
                'class' => 'choate\epluspay\helpers\Sha1WithRSAHelper',
                'params' => [
                    "private key file path or \Closure",
                    "public key file path or \Closure",
                ],
            ],  
        ],
    ],
],
```

