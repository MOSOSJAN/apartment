<?php

namespace backend\posts\models;


class CategoryTree extends Categories{


    public function asd(){
        $res = $this->find()->all();

        foreach ($res as $value) {
            $cats[$value->paret_id][] = $value;
        }
        $this->_category_arr = $cats;
    }

    public function getParents($id){
        $res = $this->find()->select('id')->where(['paret_id'=>$id])->all();
        if($res){

            foreach($res as $one){
                $res[] = $this->getParents($one['id']);

            }
        }else return null;

        return $res;
    }

    public function getIdis($res){
        //Func::d($res);
        if(is_array($res)){
            foreach($res as $one){
                if(is_array($one)){
                    $id[] = $this->getIdis($one);
                }elseif($one !== null){
                    $id[] = $one['id'];
                }
            }

            return $id;
        }else{
            return null;
        }
    }

    public function outTree($parent_id, $level) {
        $this->asd();

        if (isset($this->_category_arr[$parent_id])) {
            foreach ($this->_category_arr[$parent_id] as $value) {

                echo "<ul>";
                echo "<li><label><input type='radio' class='flat-red' name='category' value='". $value->id . "'> " . $value->title . "</label></li>";
                $this->ids[] = $value->id;

                $level++;
                $this->outTree($value->id, $level);
                $level--;
                echo "</ul>";
            }
        }
    }
}