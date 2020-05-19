<?php

use app\models\Site;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$imgUrlEmpty = !empty($model->cover_img_url) ? '/uploads/img/posts/' . $model->cover_img_url : Yii::$app->params['defaultImg']['post'];
$imgUrl = Site::hasFile($imgUrlEmpty, true) ? $imgUrlEmpty : Yii::$app->params['defaultImg']['post'];
$cover = Html::tag('div', '', [
    'style' => "background: url('$imgUrl') no-repeat center",
    'class' => "cover-img",
]);

$mainCss = <<<CSS
.cover-img{
    width: 100%;
    height: 28vh;
    background-size: cover;
}

.publication-list-item{
    margin-bottom: 80px;
}

.publication-list-item__title{
    margin:20px 0;
}

.publication-list-item__container{
    padding: 0px 25px;
}

CSS;


$this->registerCSS($mainCss);
?>

<div class="publication-list-item border">
    <?= $cover; ?>
    <div class="publication-list-item__container">
        <a href="/publications/view?id=<?= $model->id ?>">
            <h3 class="publication-list-item__title"><?= Html::encode($model->title) ?></h3>
        </a>
        <p class="publication-list-item__summary"><?= Html::encode($model->summary) ?></p>
    </div>
</div>