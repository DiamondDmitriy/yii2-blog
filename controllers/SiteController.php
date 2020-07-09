<?php

namespace app\controllers;

use Yii;
use yii\filters\{AccessControl, VerbFilter};
use yii\web\{Controller, Response};
use app\models\{ContactForm, NewsModel, RegistrationForm, Site};
use app\models\auxiliary\UploadImage;
use yii\web\UploadedFile;

class SiteController extends Controller
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
    public function actionIndex()
    {
        $this->layout = 'main';
        // $this->layout = 'mainPanel';
        // return $this->render('index.twig');
        return $this->render('index.php');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionNews()
    {
        $news = NewsModel::search();

        return $this->render('news', [
            'news' => $news,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * 
     * 
     */
    public function actionPhpinfo()
    {
        phpinfo();
    }

    /**
     * 
     * 
     */
    public function actionRegistration()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->registration()) {
            
            return $this->goBack();
        }

        return $this->render(
            'registration',
            [
                'model' => $model,
            ]
        );
    }

    public function actionFm(){
        return $this->render('fm');
    }
}
