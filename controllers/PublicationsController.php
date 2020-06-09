<?php

namespace app\controllers;

use app\models\CommentsModel;
use Yii;
use app\models\Publications;
use app\models\PublicationsSearch;
use app\models\Site;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use app\models\UploadImage;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * PublicationsController implements the CRUD actions for Publications model.
 */
class PublicationsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Publications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicationsSearch();
        $postData = Yii::$app->request->post();
        $dataProvider = $searchModel->search($postData);

        if (isset($postData['clear-filters'])) {
            $searchModel = new PublicationsSearch();
            $dataProvider = $searchModel->search([]);
            $dataProvider = $searchModel->search([]);
        } elseif (Yii::$app->request->isPost) {
            \Yii::warning($postData['PublicationsSearch']);
            $dataProvider = $searchModel->search($postData['PublicationsSearch']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publications model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelComments = new CommentsModel();
        $postComments =  CommentsModel::search($id);

        //save comments 
        if (Yii::$app->request->isPost) {
            $modelComments->load(Yii::$app->request->post());
            $modelComments->date = date("Y-m-d H:i:s");
            $modelComments->user_id =  Yii::$app->user->identity->id;
            if ($modelComments->save()) {
                $modelComments->comment = '';
                $postComments =  CommentsModel::search($id);
            }
        } else {
            Publications::inrementWatch($id);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelComments' => $modelComments,
            'postComments' => $postComments,
        ]);
    }

    /**
     * Creates a new Publications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publications();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->image =  UploadedFile::getInstance($model, 'image');
            $model->cover_img_url = $model->uploadImage();
            $model->date_create = date("Y-m-d H:i:s");

            $model->save(false);

            return $this->redirect('/account');
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Publications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Publications model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Publications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
