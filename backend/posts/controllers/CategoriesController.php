<?php

namespace backend\posts\controllers;

use backend\models\Lang;
use Yii;
use backend\posts\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\Func;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get'],
                ],
            ],
        ];
    }

    public static $_category_arr;
    public static $ids = array();
    public $model;
    public $lang;

    public function init(){
        $this->lang = Lang::getCurrent()->url;
        $this->model = new Categories();
        $res = $this->model->find()->where(['lang' => 'am'])->groupBy('forlang_id')->all();

        foreach ($res as $value) {
            $cats[$value->paret_id][] = $value;
        }
        self::$_category_arr = $cats;
        //Func::d($this->lang);
    }

    public function actionCategories(){

        return $this->render('categories', [
            'model' => $this->model,
        ]);
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->model->update = null;
        if ($this->model->load(Yii::$app->request->post())) {

            if(!$this->model->paret_id) $this->model->paret_id = 0;

            $this->model->lang = $this->lang;
            $this->model->save();

            $id = Yii::$app->db->getLastInsertID();
            $this->model->addParentId($id);
            return $this->redirect(['categories']);
        } else {
            return $this->render('create', [
                'model' => $this->model,
            ]);
        }
    }


    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$lang = 'am')
    {
        $model = $this->findForUpdate($id,$lang);
        $model->update = true;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['categories']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['categories']);
    }



    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findForUpdate($id,$lang){


        if(($model = $this->model->find()->where(['forlang_id' => $id,"lang" => $lang])->one()) != null){
            return $model;
        }elseif(($model = $this->model->findOne(['forlang_id' => $id,"lang != :lang", [':lang' => $lang]])) !==null){

            $model = $model->addPostWhithNewLang($id,$lang);
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    /**
     * List all categories
     *
     * @param integer $parent_id
     * @param integer $level
     */
    public static  function outTree($parent_id, $level) {
        //Func::d(self::$_category_arr);
        if (isset(self::$_category_arr[$parent_id])) {
            foreach (self::$_category_arr[$parent_id] as $value) {
                if($level){
                    $style = $level * 25;
                }else{
                    $style = 10;
                }

                echo '<li class="cats" style="padding-left:' . $style . 'px;">';
                echo '<a href="'.Url::toRoute(['update','id' => $value->id]).'">' . $value->title . '</a>' ;
                self::$ids[] = $value->id;
                echo
                    '<div class="tools">
                            <a href="'.Url::toRoute(['update','id' => $value->id]).'"><i class="fa fa-edit"></i></a>
                            <a href="'.Url::toRoute(['/posts/categories/delete','id' => $value->id]).'"><i class="fa fa-trash-o"></i></a>
                        </div>';
                echo '</li>';
                $level++;
                self::outTree($value->id, $level);
                $level--;
            }
        }
    }
}
