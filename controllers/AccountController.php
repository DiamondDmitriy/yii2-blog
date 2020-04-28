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
use app\models\UploadImage;

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

        $dataProvider = new PublicationsSearch();
        $modelUploadImg = new UploadImage();

        return $this->render('index.php', [
            'dataProvider' => $dataProvider->search([]),
            'modelUploadImg' => $modelUploadImg,
        ]);
    }

    public function actionSetting()
    {
        $model = new settingAcountModel();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // echo $model->update();
                return $this->redirect(['/account']);
            }
        }

        return $this->render('setting', [
            'model' => $model,
        ]);
    }
}
