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
use app\models\auxiliary\UploadImage;

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

        if(\Yii::$app->user->isGuest){
            throw new \yii\web\ForbiddenHttpException("Доступ только для авторизованых пользователей");
        }

        $dataProvider = new PublicationsSearch();

        return $this->render('index.php', [
            'dataProvider' => $dataProvider->search(['creater_id'=>\Yii::$app->user->identity->id]),
        ]);
    }

    public function actionSetting()
    {
        $this->layout = 'main';

        if(\Yii::$app->user->isGuest){
            throw new \yii\web\ForbiddenHttpException("Доступ только для авторизованых пользователей");
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
}
