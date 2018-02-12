<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12.02.2018
 * Time: 22:38
 */

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

class IpFormModel extends Model
{
    /**
     * @property string
     */
    public $ip;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['ip', 'required'],
            ['ip', 'ip']
        ];
    }

    /**
     * Hash ip
     *
     * @param string $ip
     * @return string
     */
    public static function hasIp($ip)
    {
        return md5($ip);
    }

    /**
     * Find geo data
     *
     * @param string $ip
     * @return array|bool
     */
    public function findData($ip)
    {
        $this->ip = Html::encode($ip);

        if (!$this->validate()) {
            return false;
        }

        return Yii::$app->getCache()->getOrSet(self::hasIp($this->ip), function() {
            return Yii::$app->geoIp->getInfoByIp($this->ip);
        }, 1800);
    }
}