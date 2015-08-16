<?php

namespace backend\posts\models;

use Yii;
use common\models\Func;
use yii\db\Connection;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\behaviors\Upload;
use yii\db\Expression;

use mongosoft\file\UploadImageBehavior;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $img
 * @property string $date
 * @property integer $cat_id
 * @property string $long
 * @property integer $parrent_id
 */
class Posts extends ActiveRecord
{
    public static  $update = null;
    public $images;

    public function rules()
    {
        return [
            [['id', 'cat_id', 'parrent_id'], 'integer'],
            [['description','slug'], 'string'],
            [['title'], 'string', 'max' => 250],
            [[ 'created_at'], 'string', 'max' => 50],
            [[ 'updated_at'], 'string', 'max' => 50],
            [['lang'], 'string', 'max' => 10],
            [['img'], 'file', 'extensions' => 'png, jpg, jpeg', 'on' => ['insert', 'update']],
            [['images'], 'file', 'extensions' => 'png, jpg, jpeg', 'on' => ['insert', 'update']],
        ];
    }

    /*
   * @slug
   */
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => Upload::className(),
                'fileName' => 'img',
                'filePath' => 'posts/',
                'update' => self::$update
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function addParentId($id){
        $model = $this->findOne($id);

        $model->parrent_id = $id;
        $model->save();
    }

    public function addPostWhithNewLang($id,$lang){
        $connection = \Yii::$app->db;
        $connection->createCommand()->insert('posts', [
            'parrent_id' => $id,
            'lang' => $lang,
        ])->execute();

        $id = Yii::$app->db->getLastInsertID();

        return $this->find()->where(['id' => $id,'lang'=> $lang])->one();
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => '',
            'img' => 'Img',
            'created_at' => 'Date',
            'cat_id' => 'Category',
            'lang' => 'Lang',
            'parrent_id' => 'Parrent ID',
            'slug' => 'Slug'
        ];
    }
}
