<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.02.2018
 * Time: 21:25
 */

namespace app\controllers;

use Yii;
use app\components\JsonController;
use yii\filters\VerbFilter;
use app\models\forms\IpFormModel;
use yii\web\NotFoundHttpException;

class GeoIpController extends JsonController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'filter' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'get' => ['GET']
                ]
            ]
        ];
    }

    /**
     * Action /geo-ip/get?ip={ip}
     *
     * @param string $ip
     */
    public function actionGet($ip)
    {
        $model = new IpFormModel();

        if (($info = $model->findData($ip)) === false) {
            throw new NotFoundHttpException("IP $ip not found in database");
        }

        return $info;
    }
}