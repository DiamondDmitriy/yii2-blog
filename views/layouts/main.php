<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\UserAvatar;

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
            'brandLabel' => Html::tag('span', Yii::$app->name, [
                'class' => 'main-style-title',
            ]),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-dark'
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-brand navbar-nav'],
            'items' => [
                ['label' => 'Новости', 'url' => ['/news']],
                ['label' => 'О сайте', 'url' => ['/about']],
                ['label' => 'Контакты', 'url' => ['/contact']],
            ],
        ]);

        $itemsAuth = [
            ['label' => isset(Yii::$app->user->identity->name) ? Yii::$app->user->identity->name : '', 'url' => ['/account']],
            ('<li>'
                . Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    'Выйти',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'),
            ('<a href="/account" class="text-center align-self-center"  style="border-radius: 50%">' . UserAvatar::widget([
                'width' => 50,
                'height' => 50,
            ]) . '</a>'),
        ];

        $itemsAuthLogin = [
            ['label' => 'Войти', 'url' => ['/login']],
            ['label' => 'Регистрация', 'url' => ['/registration']]

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

    <footer class="footer d-flex" style="height:auto">
        <div class="container">
            <div class="main-info d-flex">
                <p class="pull-left">&copy; Дмитрий Щёлкин Александрович <?= date('Y') ?></p>
                <p class="ml-auto"><?= Yii::powered() ?></p>
            </div>
            <div class="discription">
                <p><small>Разработка дипломного проекта на фреймворке Yii</small></p>
            </div>

        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>