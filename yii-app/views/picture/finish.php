<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-09
 * Time: 22:17
 * @var $status []
 * @var $this \yii\web\View
 * @var $type string
 */
use yii\helpers\Html;
use yii\helpers\Url;
$type = $type == 'upload' ? '上传' : '删除';
$this->title = $type.'完成';
?>
<?php if($status['code']): ?>
<div class="bg-danger">
    <?=$type ?>失败：原因为<?= $status['message'] ?>
</div>
<?php else: ?>
<div class="bg-success">
    <?= $type ?>成功
</div>
<?php endif; ?>
<?= Html::a('返回',Url::to(['picture/index']),['class' => 'btn btn-primary']); ?>

