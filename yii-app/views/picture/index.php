<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-05
 * Time: 12:47
 * @var $this \yii\web\View
 */
$this->title = '图片文件列表';
use yii\grid\GridView;
use yii\helpers\Html;
?>

<div class="picture-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => '文件名'
            ],
            [
                'attribute' => 'filesize',
                'label' => '文件大小'
            ],
            [
                'attribute' => 'mtime',
                'label' => '修改日期',
                'format' => ['date', 'php:Y-m-d H:i:s']
            ],
            [
                'attribute' => COS_USE_CDN ? 'access_url' : 'source_url',
                'label' => '地址',
                'value' => function($data) {
                    $url = COS_USE_CDN ? $data['access_url'] : $data['source_url'];
                    return Html::a(Html::encode($url),$url);
                }
            ]
        ],
    ]);?>
</div>
