<?php
namespace common\models;

use Yii;
/**
 * Created by PhpStorm.
 * User: Mos
 * Date: 04.06.2015
 * Time: 14:33
 */

class Func{


    public static  function d($params,$flag=1){
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        if($flag){
            exit;
        }
    }

    function getExcerpt($str, $startPos=0, $maxLength=100) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt   = strip_tags($excerpt);
            $excerpt  .= '...';
        } else {
            $excerpt = strip_tags($str);
        }

        return $excerpt;
    }


    public static function getGallery($dir,$rol=null){
        if(file_exists (Yii::getAlias("@backend/web/upload/$dir/"))) {
            $files=array_slice(scandir(Yii::getAlias("@backend/web/upload/$dir/")),2);

            if($rol){
                $num=count($files);
                unset($files[$num-1]);
            }
            return $files;
        }
    }

}