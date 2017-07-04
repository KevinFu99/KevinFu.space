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
    public static $config = [
        'default' => [
            'app_id' => '1253859841',
            'secret_id' => 'AKIDiJhtuld0Wrzuc8hYGqFRBmALJ8lBoQYk',
            'secret_key' => 'rOkwyrZ5OXVGpCRULzSjohQxIRYZxENP',
            'region' => 'tj',
            'timeout' => 600
        ],
    ];

    private static $instances = array();

    /**
     * Generate An Instance
     * @param string $name
     * @return CosUtil|null
     */
    public static function instance($name = 'default'){
        if(!isset($config[$name])) return null;
        if(isset(self::$instances[$name])) return self::$instances[$name];
        else return new CosUtil($config[$name]);
    }
}