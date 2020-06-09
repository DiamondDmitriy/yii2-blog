<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\PublicationsSearch;
use app\models\RegistrationForm;
use app\models\settingAcountModel;
use yii\web\UploadedFile;
use app\models\UploadImage;
use app\models\User;

class AccountController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($id = null)
    {
        $this->layout = 'main';

        if (\Yii::$app->user->isGuest && is_null($id)) {
            throw new \yii\web\ForbiddenHttpException("Доступ только для авторизованых пользователей");
        } else if (is_null($id)) {
            $id = \Yii::$app->user->identity->id;
        }

        $dataProvider = new PublicationsSearch();
        $modelImage = new UploadImage();

        return $this->render('index.php', [
            'dataProvider' => $dataProvider->search(['creater_id' => $id]),
            'modelImage' => $modelImage,
            'idAcount' => $id
        ]);
    }

    public function actionSetting()
    {
        $this->layout = 'main';

        if (\Yii::$app->user->isGuest) {
            throw new \yii\web\ForbiddenHttpException("Доступ закры!");
        }

        $id = Yii::$app->user->identity->id;
        $model = settingAcountModel::findOne(['id' => $id]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                if ($model->save()) {
                    return $this->redirect(['/account']);
                }
            }
        }

        return $this->render('setting', [
            'model' => $model,
        ]);
    }


    public function actionUploadImage()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();

            $status = User::uploadAvatar($post['imageBase64']);
            return $status['status'];
        } else {
            throw new \yii\web\ForbiddenHttpException("Нет доступа");
        }
    }
}
