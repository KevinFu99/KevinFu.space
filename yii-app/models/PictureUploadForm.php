<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-06
 * Time: 17:39
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use QCloud\Cos\CosUtil;

class PictureUploadForm extends Model
{
    /**
     * @var $file UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'],'file','skipOnEmpty' => false,'extensions' => 'jpg, png, gif', 'mimeTypes'=>'image/jpeg, image/png, image/gif']
        ];
    }


    /**
     * save the uploaded file
     * @return array()
     */
    public function save(){
        $uploadPath = UPLOAD_DIR;
        $filename = date('YmdHis').rand(0,1000).'.'.$this->file->getExtension();
        $filepath=$uploadPath.DIRECTORY_SEPARATOR.$filename;
        if(!($this->file and $this->validate())){
            return [
                'code' => -1,
                'message' => '数据异常',
            ];
        }
        if($this->file->saveAs($filepath)){
            $api=CosUtil::instance();
            $ret = $api->upload($api->bucketName(),$filepath,$api->rootDir().DIRECTORY_SEPARATOR.$filename);
            unset($ret['data']);
            unlink($filepath) or die('unable to delete file'.$filepath);
            return $ret;
        }
        return [
            'code' => 1,
            'message' => 'Unable to Create File: '.$filepath,
        ];
    }
}