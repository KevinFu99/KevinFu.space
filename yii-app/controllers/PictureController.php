<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-05
 * Time: 09:08
 */

namespace app\controllers;

use QCloud\Cos\CosUtil;
use yii\filters\AccessControl;
use yii\web\Controller;

class PictureController extends Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //TODO: Create RBAC Rules For PictureController
            ],
        ];
    }*/

    public function actionIndex()
    {
        $api = CosUtil::instance();
        $message = $api->listFolder($api->bucketName(),'/');
        return $this->render('../generic/display',['message' => $message]);
    }
}