<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-dark'
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-brand navbar-nav'],
            'items' => [
                ['label' => 'Главная', 'url' => ['/']],
                ['label' => 'О сайте', 'url' => ['/about']],
                ['label' => 'Контакты', 'url' => ['/site/contact']],
            ],
        ]);



        $itemsAuth = [
            ['label' => Yii::$app->user->identity->name, 'url' => ['/account']],
            ('<li>'
                . Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    'Выйте',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'),
            (Html::a('', '/account', [
                'class' => 'text-center align-self-center',
                'style' => 'border-radius: 50%; width: 50px; background-color: white; height: 50px; color: black'
            ])),
        ];

        $itemsAuthLogin = [
            ['label' => 'Войти', 'url' => ['/auth/login']]
        ];

        echo Nav::widget([
            'options' => ['class' => 'navbar-brand navbar-nav ml-auto'],
            'items' => (Yii::$app->user->isGuest) ? $itemsAuthLogin : $itemsAuth,

        ]);

        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>