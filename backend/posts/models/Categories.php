<?php

namespace backend\posts\models;

use Yii;
use common\models\Func;
use common\behaviors\Upload;
/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $lang
 * @property integer $paret_id
 * @property string $img
 * @property string $description
 */
class Categories extends \yii\db\ActiveRecord
{

    public $_category_arr;
    public $ids = array();
    public static $update = null;
    public $images;
    /**
     * @inheritdoc
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
                'class' => Upload::className(),
                'fileName' => 'img',
                'filePath' => 'cats/',
                'update' => self::$update
            ],
        ];
    }


    public static function tableName()
    {
        return 'categories';
    }

    public function addParentId($id){
        $model = $this->findOne($id);

        $model->forlang_id = $id;
        $model->save();
    }


    public function addPostWhithNewLang($id,$lang){

        $model = $this->findAll($id);
        //Func::d($model);
        $connection = \Yii::$app->db;
        $connection->createCommand()->insert('categories', [
            'forlang_id' => $id,
            'lang' => $lang,
            'paret_id' => $model[0]->paret_id,
        ])->execute();

        $id = Yii::$app->db->getLastInsertID();

        return $this->find()->where(['id' => $id,'lang'=> $lang])->one();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['paret_id'], 'integer'],
            [['description','slug'], 'string'],
            [['title', 'lang'], 'string', 'max' => 250],
            [['img'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'lang' => 'Lang',
            'paret_id' => 'Paret Name',
            'img' => 'Img',
            'description' => 'Description',
        ];
    }
}
