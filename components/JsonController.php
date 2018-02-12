<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.02.2018
 * Time: 22:35
 */

namespace app\components;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class JsonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
    }
}