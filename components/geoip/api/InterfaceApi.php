<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.02.2018
 * Time: 21:21
 */

namespace app\components\geoip\api;


interface InterfaceApi
{
    /**
     * init geo ip model
     *
     * @param string $ipAddress
     * @return void
     */
    public function init($ipAddress);

    /**
     * Get array info in [lat, lon, city, country]
     *
     * @return array|boolean
     */
    public function getLocationInfo();
}