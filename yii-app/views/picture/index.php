<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-05
 * Time: 12:47
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ArrayDataProvider
 * @var $listOver bool
 * @var $context string
 * @var $model app\models\PictureUploadForm
 */
$this->title = '图片文件列表';
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="picture-index">
    <div class="picture-upload">
        <?= Html::label('上传文件') ?>
        <?php $form = ActiveForm::begin(['action' => ['picture/upload'],'options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'file')->fileInput() ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div><!-- picture-upload -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
                'format' => 'raw', //防止编码链接
                'label' => '地址',
                'value' => function($data) {
                    $url = COS_USE_CDN ? $data['access_url'] : $data['source_url'];
                    return Html::a(Html::encode($data['name']),$url);
                }
            ],
            [
                'label' => '操作',
                'format' => 'raw',
                'value' => function($data) {
                    return
                        Html::a(
                            '查看图片',
                            Url::to(['picture/viewpicture','url' => COS_USE_CDN ? $data['access_url'] : $data['source_url']]),
                            ['class' => 'btn btn-primary']).
                        Html::a(
                            '删除图片',
                            Url::to(['picture/delete','filename' => $data['name']]),
                            ['class' => 'btn btn-danger']);
                }
            ]
        ],
        'emptyText'=>'无图片',
        'emptyTextOptions'=>['style'=>'color:red;font-weight:bold'],
        'layout'=>"{items}"
    ]);?>
    <?php
    if(!$listOver){
        echo Html::a('下一页',Url::to(['picture/index','context' => $context]),['class' => 'btn btn-primary']);
    }
    ?>
</div>
