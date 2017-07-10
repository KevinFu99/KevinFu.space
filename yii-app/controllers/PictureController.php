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
use yii\web\UploadedFile;
use yii\web\YiiAsset;
use Yii;

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
        if(Yii::$app->request->isPost){
            $model->file = UploadedFile::getInstance($model,'file');
            $ret = $model->save();
            return $this->render('finish',['status' => $ret, 'type' => 'upload']);
        }
        return $this->render('upload',['model' => $model]);
    }

    public function actionDelete($filename){
        $model = new Picture();
        return $this->render('finish',['type' => 'delete', 'status' => $model->deleteFile($filename)]);
    }
}