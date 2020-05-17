<?php

use yii\helpers\Html;

// Yii::warning($comment);
?>

<div class="comment d-flex">
    <div class="comment__left">
        <div class="user-img border" style="width:70px; height:70px;"></div>
    </div>
    <div class="comment__right">
        <h5 class="user-fio">
            <?= Html::a($comment['fio'], ['http://diary/account', 'id' => $comment['user_id']]) ?>
        </h5>
        <div class="tetx-comment">
            <?= Html::tag('p', Html::encode($comment['comment'])) ?>
            <?= Html::tag('p', $comment['date']) ?>
        </div>
    </div>
</div>