<?php

use app\models\Publications;
use app\models\Site;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$imgUrlEmpty = !empty($model->cover_img_url) ? '/uploads/img/posts/' . $model->cover_img_url : Yii::$app->params['defaultImg']['profile'];
$imgPost = Html::img(Site::hasFile($imgUrlEmpty, true) ? $imgUrlEmpty : Yii::$app->params['defaultImg']['profile'], ['width' => '180px', 'height' => '180px']);

$genrePost = Publications::getGenreName($model->genre);

$mainCSS = <<<CSS
.publication-card__container{
    margin: 0px 25px;
    width:100%;
    display: flex;  
    flex-direction: column;
}
.publication-card__container p{
    margin:0;
}

.date{
    font-size:14px;
    color: gray;
    text-align: end;
    font-weight: bold;
    margin-top: auto !important;
}
.publication-card__summary{
    text-align:justify;
}

CSS;

$this->registerCss($mainCSS);
?>

<div class="publication-card d-flex border" style="margin-top:20px;">
    <?= $imgPost; ?>
    <div class="publication-card__container">
        <a href="/publications/view?id=<?= $model->id ?>">
            <h3 class="publication-card__title"><?= Html::encode($model->title) ?></h3>
        </a>
        <div class="panel-info-publ d-flex">
            <p><strong>Жанры:</strong> <?= implode(', ', $genrePost) ?></span></p>
            <p class="ml-auto"><strong>Просмотры:</strong> <span><?= $model->watch ?></span></p>
        </div>
        <p class="publication-card__summary"><?= Html::encode($model->summary) ?></p>


        <p class="date"><?= $model->date_create ?></p>
    </div>
</div>