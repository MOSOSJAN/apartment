<?php
namespace common\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Func;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\helpers\BaseFileHelper;


class Upload extends Behavior{


    public $fileName = 'img';
    public $galleryName = 'images';
    public $filePath;
    public $update;


    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'upload',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updateImage',
            BaseActiveRecord::EVENT_BEFORE_DELETE => 'deleteImage',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'gallery',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'gallery',
        ];
    }

    public function upload($event){

        $defImg = $this->owner->{$this->fileName};
        $uploadedFile = UploadedFile::getInstance($this->owner, $this->fileName);


        if (!empty($uploadedFile)) {
            if (empty($defImg)) {
                $image = $this->uploadImage($uploadedFile);
                $this->owner->{$this->fileName} = $image;
            }

        }

    }

    public function updateImage($event){
        //Func::d($this->klu4);
        if($this->update !== null) {
            $uploadedFile = UploadedFile::getInstance($this->owner, $this->fileName);
            if($uploadedFile !=null){
                $defImg = $this->owner->{$this->fileName};
                $this->owner->{$this->fileName} = $this->updateImg($uploadedFile, $defImg);
            }
        }
    }


    public function uploadImage($file){


        $imageName = 'image_'.time().'.'.$file->extension;

        $file->saveAs('upload/'.$this->filePath.$imageName);

        Image::thumbnail(Yii::getAlias('@backend/web/upload/'.$this->filePath.$imageName), 300, 300)
            ->save(Yii::getAlias('@backend/web/upload/'.$this->filePath.'thumbs/'.$imageName), ['quality' => 80]);

        return $imageName;
    }

    public function update($event){
        $uploadedFile = UploadedFile::getInstance($this->owner, $this->fileName);
        $defImg = $this->owner->{$this->fileName};

        if(!empty($uploadedFile)){
            $img = $this->updateImg($uploadedFile,$defImg);
            $this->owner->{$this->fileName} = $img;
        }
    }


    public function updateImg($file,$def_img = null){

        if($def_img != null){
            unlink(Yii::getAlias('@backend/web/upload/'.$this->filePath.'thumbs/'.$def_img)) && unlink(Yii::getAlias('@backend/web/upload/'.$this->filePath.$def_img));
        }

        $imageName = 'image_'.time().'.'.$file->extension;
        $file->saveAs('upload/'.$this->filePath.$imageName);

        Image::thumbnail('@backend/web/upload/'.$this->filePath.$imageName, 300, 300)
            ->save(Yii::getAlias('@backend/web/upload/'.$this->filePath.'thumbs/'.$imageName), ['quality' => 80]);

        return $imageName;

    }

    public function deleteImage($event){
        $def_img = $this->owner->{$this->fileName};
        if($def_img != null){
            @unlink(Yii::getAlias('@backend/web/upload/'.$this->filePath.'thumbs/'.$def_img));
            @unlink(Yii::getAlias('@backend/web/upload/'.$this->filePath.$def_img));
        }

        $id = $this->owner->id;
        $dir = $this->filePath.$id;
        BaseFileHelper::removeDirectory(Yii::getAlias("@backend/web/upload/$dir"));    }


    public function gallery($event){
        $uploadedFiles = UploadedFile::getInstances($this->owner, $this->galleryName);
        if($uploadedFiles !== null){
            if($this->owner->id == null){
                $id = Yii::$app->db->getLastInsertID();
            }else{
                $id = $this->owner->id;

            }

            $dir = $this->filePath.$id;
            BaseFileHelper::createDirectory(Yii::getAlias('@backend/web/upload/'.$dir.'/thumbs'), 509, true);

            $i=0;
            foreach ($uploadedFiles as $file) {

                $imageName = 'image_'.time().$i.'.'.$file->extension;
                $file->saveAs('upload/'.$dir.'/'. $imageName);

                Image::thumbnail('@backend/web/upload/'.$dir.'/'.$imageName, 300, 300)
                    ->save(Yii::getAlias('@backend/web/upload/'.$dir.'/thumbs/'.$imageName), ['quality' => 80]);
                $i++;

            }
        }


    }


}