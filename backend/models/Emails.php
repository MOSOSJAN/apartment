<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "emails".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $user_ip
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emails';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body', 'user_ip'], 'required'],
            [['body'], 'string'],
            [['name', 'email'], 'string', 'max' => 200],
            [['subject'], 'string', 'max' => 250],
            [['user_ip'], 'string', 'max' => 50]
        ];
    }

    public function insertNew($model,$ip){

        $this->name = $model->name;
        $this->subject = $model->subject;
        $this->body = $model->body;
        $this->email = $model->email;
        $this->user_ip = $ip;
        $this->is_new = 0;
        $this->save();
    }

    public function getNotRead(){
        $model = $this->find()
                    ->where(['is_new' => 0])
                    ->orderBy(['created_at'=> SORT_DESC])
                    ->all();

        return $model;

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'user_ip' => 'User Ip',
        ];
    }
}
