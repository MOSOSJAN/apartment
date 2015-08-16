<?php

namespace backend\posts\controllers;

use Yii;
use backend\posts\models\Posts;
use backend\posts\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Lang;
use common\models\Func;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    private $model;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public  function init(){
        $this->model  = new Posts();
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Posts::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->model;
        $model->update = null;

        if ($model->load(Yii::$app->request->post())) {
            $model->cat_id = $_POST['category'];
            $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->update = true;
        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            return $this->redirect(['update', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if(($model = $this->model->findOne($id)) != null){
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeleteimg($id){
        //var_dump($id);
        unlink(Yii::getAlias('@backend/web/upload/posts/'.$_POST['item'].'/'.$id));
        unlink(Yii::getAlias('@backend/web/upload/posts/'.$_POST['item'].'/thumbs/'.$id));
        echo json_encode($_POST);
    }


}
