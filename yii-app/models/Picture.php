<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-05
 * Time: 11:16
 */

namespace app\models;

use QCloud\Cos\CosUtil;
use yii\base\Model;

class Picture extends Model
{
    protected static $rootDir = '/pictures';

    public $pageSize;
    public $listOver;
    public $recordSet;

    protected $context = ''; //As is stated in Tencent COS
    protected $api;

    function __construct(array $config = [])
    {
        $this->api = CosUtil::instance();
        parent::__construct($config);
    }

    public function listFiles(){
        if(defined('YII_DEBUG') and YII_DEBUG) assert(isset($pageSize));
        $info = $this->api->listFolder($this->api->bucketName(),self::$rootDir,$this->pageSize,'eListFileOnly',0,$this->context);
        if($info['code']) throw new \Exception($info['message']);
        $info=$info['data'];
        $this->context = $info['context'];
        $this->listOver = $info['listover'];
        $this->recordSet = $info['infos'];
    }
}