<?php

use app\models\Site;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$imgUrlEmpty = !empty($model->cover_img_url) ? '/uploads/img/posts/' . $model->cover_img_url : Yii::$app->params['defaultImg']['profile'];
$imgPost = Html::img(Site::hasFile($imgUrlEmpty, true) ? $imgUrlEmpty : Yii::$app->params['defaultImg']['profile'], ['width' => '180px', 'height'=>'180px']);
?>

<div class="publication-card d-flex border" style="margin-top:20px;">
    <?= $imgPost; ?>
    <div class="publication-card__container">
        <a href="/publications/view?id=<?= $model->id ?>">
            <h3 class="publication-card__title"><?= Html::encode($model->title) ?></h3>
        </a>
        <p class="publication-card__summary"><?= Html::encode($model->summary) ?></p>
    </div>
</div>