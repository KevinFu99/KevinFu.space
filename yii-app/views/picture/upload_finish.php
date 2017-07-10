<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-09
 * Time: 22:17
 * @var $status []
 * @var $this \yii\web\View
 */
use yii\helpers\Html;
$this->title = '上传完成';
?>
<?php if($status['code']): ?>
<div class="bg-danger">
    上传失败：原因为<?= $status['message'] ?>
</div>
<?php else: ?>
<div class="bg-success">
    上传成功
</div>
<?php endif; ?>
<?= Html::a('返回','javascript:window.history.back();',['class' => 'btn btn-primary']); ?>

