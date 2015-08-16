<?php

namespace backend\controllers;

use common\models\Func;
use common\models\Statistics;

class StatisticsController extends \yii\web\Controller
{
    public $model;
    public $month;
    public $day;

    public function init(){
        $this->model = new Statistics();

        $day =  date('d');
        $day1 = substr($day,0,1);
        if($day1 == 0){
            $this->day = substr($day,1,2);
        }else{
            $this->day =  date('d');
        }

        $month =  date('m');
        $month1 = substr($month,0,1);
        if($month1 == 0){
            $this->month = substr($month,1,2);
        }else{
            $this->month =  date('m');
        }
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBrowsers(){

        $query = (new \yii\db\Query())->from('statistics')->where(['brauzer'=>'Chrome']);
        $chrome = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['brauzer'=>'Firefox']);
        $firefox = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['brauzer'=>'Opera']);
        $opera = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['brauzer'=>'Internet Explorer']);
        $ie = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['brauzer'=>'Safari']);
        $safari = $query->sum('count');

        $result['chrome'] = $chrome;
        $result['firefox'] = $firefox;
        $result['opera'] = $opera;
        $result['ie'] = $ie;
        $result['safari'] = $safari;

        echo json_encode($result);

    }

    public function actionMonth(){



        for($i=1;$i<=$this->day;$i++){
            $query = (new \yii\db\Query())->from('statistics')->where(['DAY (date)'=> $i])->andWhere(['MONTH (date)' => $this->month]);
            $model[] = $query->sum('count');
            if($model[$i-1] == null){
                $model[$i-1] = 0;
            }
        }

        echo json_encode($model);
    }


    public function actionPlatforms(){

        $query = (new \yii\db\Query())->from('statistics')->where(['platform'=>'iPhone']);
        $result['iPhone'] = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['platform'=>'iPad']);
        $result['iPad'] = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['platform'=>'Android']);
        $result['Android'] = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['platform'=>'webOS']);
        $result['webOS'] = $query->sum('count');

        $query = (new \yii\db\Query())->from('statistics')->where(['platform'=>'Windows']);
        $result['Windows'] = $query->sum('count');


        echo json_encode($result);

    }

    public function actionCountries(){
        $query = (new \yii\db\Query())->select(['country'])->from('statistics')->Where(['MONTH (date)' => $this->month]);
        $query =  $query->all();

        $array = [];
        foreach($query as $one){
            $array[] = $one['country'];
        }
        echo json_encode(array_count_values($array));
    }

}
