<?php
namespace frontend\widgets;
use backend\models\Lang;

class Langs extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('lang/view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}