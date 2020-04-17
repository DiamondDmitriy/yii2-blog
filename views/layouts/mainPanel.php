<?php

// use app\widgets\Alert;
// use yii\helpers\Html;
// use yii\bootstrap\Nav;
// use yii\bootstrap\NavBar;
// use yii\widgets\Breadcrumbs;
// use app\assets\AppAsset;

use yii\web\View;

// AppAsset::register($this);
// $this->registerCssFile(yii::getAllias('@web'));
$this->registerCssFile(dirname(__DIR__).'..\web\css\mainPanel.css');

// echo Yii::getAlias('@web');
echo dirname(__DIR__).'..\web\css\mainPanel.css';
?>


<section>
    <div class="person">
        <div class="person__img">
            <img src="" alt="">
        </div>
        <h2>Дмитрий Александрович</h2>

    </div>

    <nav>
        <ul>
            <li>Личные сообщения <img src="" alt=""></li>
            <li>Мои дневники <img src="" alt=""></li>
            <li>Календарь <img src="" alt=""></li>
            <li>Подписки <img src="" alt=""></li>
            <li>Общение <img src="" alt=""></li>
            <li>Настройки <img src="" alt=""></li>
        </ul>
    </nav>

</section>

<section class="">
    <article>
        <?= $content ?>
    </article>
</section>