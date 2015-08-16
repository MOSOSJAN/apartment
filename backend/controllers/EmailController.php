<?php

namespace backend\controllers;

use common\models\Func;
use Yii;
use backend\models\Emails;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ContactForm;


/**
 * EmailController implements the CRUD actions for Emails model.
 */
class EmailController extends Controller
{
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

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Emails::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->is_new = 1;
        $model->save();
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    public function actionCreate($email){
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->name = "Administrator";
            $model->email = Yii::$app->params['adminEmail'];
            if ($model->sendEmail($_POST['to'])) {

                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionEmail(){
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post())) {

            $model->name = "Administrator";

            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {

                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->redirect(['site/index']);
        }

    }


    /**
     * Deletes an existing Emails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
