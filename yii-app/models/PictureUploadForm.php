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
}