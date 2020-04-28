<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$pathImg = '';
?>

<div class="publication-card d-flex border">
    <img src="<?= $pathImg . '/' . $model->cover_img_url ?>" width="180px">
    <div class="publication-card__container">
        <a href="/publications/view?id=<?= $model->id ?>">
            <h3 class="publication-card__title"><?= Html::encode($model->title) ?></h3>
        </a>
        <p class="publication-card__summary"><?= Html::encode($model->summary) ?></p>
    </div>
</div>