<?php

namespace app\components\geoip;

use app\components\geoip\api\InterfaceApi;
use yii\base\Component as Base;
use yii\base\ErrorException;

class Component extends Base
{
    /**
     * @property string
     */
    public $modelName;

    /**
     * @property InterfaceApi
     */
    private $model;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->model = new $this->modelName;

        if (!$this->model instanceof InterfaceApi) {
            throw new ErrorException('Error, model not interface ' . InterfaceApi::class);
        }
    }

    /**
     * Get array info [city, country, coords] by ip
     *
     * @param string $ipAddress
     * @return array|boolean
     */
    public function getInfoByIp($ipAddress)
    {
        /** @var InterfaceApi $this->model */

        $this->model->init($ipAddress);

        return $this->model->getLocationInfo();
    }
}