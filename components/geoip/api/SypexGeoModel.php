<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.02.2018
 * Time: 21:20
 */

namespace app\components\geoip\api;

use Yii;
use IgI\SypexGeo\SxGeo;

class SypexGeoModel implements InterfaceApi
{
    /**
     * @property array|boolean
     */
    private $info;

    /**
     * @property string
     */
    private $ip;

    /**
     * @inheritdoc
     */
    public function init($ipAddress)
    {
        $this->setIp($ipAddress);

        $geo = new SxGeo(Yii::getAlias('@runtime') . DIRECTORY_SEPARATOR . 'SxGeoCity.dat', SXGEO_BATCH | SXGEO_MEMORY);

        try {
            $this->info = $geo->getCityFull($this->getIp());
        } catch (\Exception $e) {
            Yii::error('Error api model ' . get_class($this) . ': ' . $e->getMessage());
            $this->info = false;
        }
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @inheritdoc
     */
    public function getLocationInfo()
    {
        if ($this->info && !empty($this->info['city'])) {
            return [
                'lat' => $this->info['city']['lat'],
                'lon' => $this->info['city']['lon'],
                'country' => $this->info['country']['name_en'],
                'city' => $this->info['city']['name_en']
            ];
        }

        return false;
    }
}