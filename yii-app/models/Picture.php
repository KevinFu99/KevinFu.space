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

    public $filename;
    public $filesize;
    public $modifyTime;
    public $sourceUrl;

    protected $recordSet;
    protected $currentIndex = 0; //Current Index in Recordset
    protected $context = ''; //As is stated in Tencent COS
    protected $listover; //Bool
    protected $pageSize;

    protected $api;
    protected $_hasData;

    public function attributeLabels()
    {
        return [
            'filename' => '文件名',
            'filesize' => '文件大小',
            'modifyTime' => '修改时间',
            'sourceUrl' => '文件地址'
        ];
    }

    public function hasData(){
        return $this->_hasData;
    }

    function __construct(array $config = [])
    {
        $this->api = CosUtil::instance();
        parent::__construct($config);
    }

    protected function assignProperties($info){
        $this->filename = $info['name'];
        $this->filesize = $info['filesize'];
        $this->modifyTime = $info['mtime'];
        $this->sourceUrl = $info['source_url'];
        $this->_hasData = true;
    }

    protected function analyzeRecordSet($recordSet){
        if($recordSet['code']) throw new \Exception($recordSet['message']);
        $recordSet = $recordSet['data'];
        $this->context = $recordSet['context'];
        $this->listover = $recordSet['listover'];
        $this->recordSet = $recordSet['infos'];
    }

    public function openList($pageSize){
        if(isset($this->recordSet)) return;
        $this->pageSize = $pageSize;
        $this->analyzeRecordSet($this->api->listFolder($this->api->bucketName(),self::$rootDir,$this->pageSize,'eListFileOnly'));
    }

    public function next(){
        if(!isset($this->recordSet[$this->currentIndex])){
            $this->currentIndex = 0;
            if($this->listover){
                $this->_hasData = false;
                return;
            }else
                $this->analyzeRecordSet($this->api->listFolder($this->api->bucketName(),self::$rootDir,$this->pageSize,'eListFileOnly',0,$this->context));
        }
        $this->assignProperties($this->recordSet[$this->currentIndex]);
        $this->currentIndex++;
    }

    public function closeList(){
        unset($this->recordSet);
        $this->currentIndex = 0;
        $this->context = '';
    }
    
}