<?php
/**
 * Created by PhpStorm.
 * User: Kevin Fu 1999
 * Date: 2017-07-04
 * Time: 21:17
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Generate Rbac Roles
     */
    public function actionInit(){
        $auth = Yii::$app->authManager;
        //TODO:设置权限系统
    }
}