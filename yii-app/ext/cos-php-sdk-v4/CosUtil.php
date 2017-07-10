<?php
/**
 * A tool for the site
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-04
 * Time: 21:43
 */

namespace QCloud\Cos;
require __DIR__ . DIRECTORY_SEPARATOR . 'include.php';

class CosUtil extends Api
{
    private static $bucketNames = [
        'default' => 'kspacestatic',
    ];
    private static $rootDirs = [
        'default' => 'pictures',
    ];

    private static $instances = array();

    private $name;
    /**
     * Generate An Instance
     * @param string $name
     * @return CosUtil
     */
    public static function instance($name = 'default'){
        if(!isset(self::$instances[$name])) self::$instances[$name] = new CosUtil($name);
        return self::$instances[$name];
    }

    public function __construct($name)
    {
        $this->name = $name;
        $config = require (__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
        parent::__construct($config[$name]);
    }

    /**
     * The Bucket Name Of Current Configuration
     * @return string
     */
    public function bucketName(){
        return self::$bucketNames[$this->name];
    }

    /**
     * Root Directory
     * @return string
     */
    public function rootDir(){
        return self::$rootDirs[$this->name];
    }
}