<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-06
 * Time: 16:43
 * @var $this \yii\web\View
 * @var $url string
 */
$this->title = '查看图片';
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row"> <img src="<?=$url ?>" /> </div>
<div class="row"> <?= Html::a('返回',Url::to(['picture/index']),['class' => 'btn btn-info']); ?> </div>
