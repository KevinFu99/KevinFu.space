<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-05
 * Time: 09:08
 */

namespace app\controllers;

use app\models\Picture;
use app\models\PictureUploadForm;
use yii\data\ArrayDataProvider;
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

    public function actionIndex($context = '')
    {
        $api = new Picture();
        $api->context = $context;
        $api->pageSize = 20;
        $api->listFiles();
        return $this->render('index',[
            'listOver' => $api->listOver,
            'context' => $api->context,
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $api->recordSet,
            ])
        ]);
    }

    public function actionViewpicture($url)
    {
        return $this->render('viewpicture',['url' => $url]);
    }

    public function actionUpload(){
        $model = new PictureUploadForm();
        return $this->render('upload',['model' => $model]);
    }
}