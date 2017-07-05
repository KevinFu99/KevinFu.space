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
    private static $config = [
        'default' => [
            'app_id' => '1253859841',
            'secret_id' => 'AKIDiJhtuld0Wrzuc8hYGqFRBmALJ8lBoQYk',
            'secret_key' => 'rOkwyrZ5OXVGpCRULzSjohQxIRYZxENP',
            'region' => 'tj',
            'timeout' => 600
        ],
    ];
    private static $bucketNames = [
        'default' => 'kspacestatic',
    ];

    private static $instances = array();

    private $name;
    /**
     * Generate An Instance
     * @param string $name
     * @return CosUtil
     */
    public static function instance($name = 'default'){
        if(!isset(self::$config[$name])) return null;
        if(!isset(self::$instances[$name])) self::$instances[$name] = new CosUtil(self::$config[$name],$name);
        return self::$instances[$name];
    }

    public function __construct($config,$name)
    {
        $this->name = $name;
        parent::__construct($config);
    }

    /**
     * The Bucket Name Of Current Configuration
     * @return string
     */
    public function bucketName(){
        return self::$bucketNames[$this->name];
    }
}