<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('COS_USE_CDN') or define('COS_USE_CDN',false);
defined('UPLOAD_DIR') or define('UPLOAD_DIR',__DIR__.'/../upload');

require(__DIR__ . '/../ext/cos-php-sdk-v4/CosUtil.php');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
