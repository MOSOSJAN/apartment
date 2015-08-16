<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use common\models\Func;
use yii\db\Expression;

/**
 * This is the model class for table "statistics".
 *
 * @property integer $id
 * @property string $ip_adress
 * @property string $session_id
 * @property string $country
 * @property string $city
 * @property string $date
 * @property string $brauzer
 */
class Statistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistics';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => null,
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip_adress', 'session_id', 'country', 'city', 'date', 'brauzer','platform'], 'string', 'max' => 50],
            [['count'],'integer']
        ];
    }


    public function setStatistics(){
        if($this->getReferer()){
            return;
        }

        $ip = Yii::$app->getRequest()->getUserIP();
        $session = Yii::$app->session;
        $session->open();
        $ses_id = session_id();
        $session->close();
        $geo = $this->getGeoLocation($ip);

        if(!$this->findeUser($ses_id)) {
            $this->session_id = $ses_id;
            $this->ip_adress = $ip;
            $this->country = $geo['country'];
            $this->city = $geo['city'];
            $this->brauzer = $this->getBrouser();
            $this->count = 1;
            $this->platform = $this->get_os($_SERVER['HTTP_USER_AGENT']);
            $this->save();
        }
    }

    public function getGeoLocation($ip){
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));

        $geos['country'] = $geo["geoplugin_countryCode"];
        $geos['city'] = $geo["geoplugin_city"];

        return $geos;
    }

    public function getBrouser(){
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
        elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
        elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
        elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
        elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
        else $browser = "";

        return $browser;
    }

    public function getReferer(){
        $referer = parse_url(Yii::$app->request->referrer);

        if(empty($referer['path'])){// Func::d($referer);
            return false;
        }
        $home = parse_url(Url::home(true));


        if($referer['host'] == $home['host']){
            return true;
        }else{
            return false;
        }
    }

    public function findeUser($session_id){
        $model = $this->find()->where(['session_id' => $session_id])->one();

        if(isset($model)){
            $model->count = $model->count + 1;
            $model->save();
            return true;
        }else{
            return false;
        }
    }


    function get_os($user_agent)
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "iPod") !== false) $browser = "iPod";
        elseif (strpos($user_agent, "iPhone") !== false) $browser = "iPhone";
        elseif (strpos($user_agent, "iPad") !== false) $browser = "iPad";
        elseif (strpos($user_agent, "Android") !== false) $browser = "Android";
        elseif (strpos($user_agent, "webOS") !== false) $browser = "webOS";
        elseif (strpos($user_agent, "Windows") !== false) $browser = "Windows";
        else $browser = "";

        return $browser;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_adress' => 'Ip Adress',
            'session_id' => 'Session ID',
            'country' => 'Country',
            'city' => 'City',
            'date' => 'Date',
            'brauzer' => 'Brauzer',
        ];
    }
}
