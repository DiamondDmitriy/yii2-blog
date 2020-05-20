<?php

use yii\helpers\Html;

// Yii::warning($comment);
$mainCss = <<<CSS
.comment__right{
    width:100%;
    margin:0px 15px;
}

.text{
    margin:0;
    text-align: justify;
}
.date-comment{
    width: max-content;
}
.date{
    margin:0;
    font-size:12px;
    color:gray; 
    font-weight:bold;
}
CSS;

$this->registerCSS($mainCss);
?>

<div class="comment d-flex " style="margin-top:20px;">
    <div class="comment__left">
        <div class="user-img border" style="width:70px; height:70px;"></div>
    </div>
    <div class="comment__right">
        <h5 class="user-fio">
            <?= Html::a($comment['fio'], ['http://diary/account', 'id' => $comment['user_id']]) ?>
        </h5>
        <div class="tetx-comment">
            <?= Html::tag('p', Html::encode($comment['comment']),  ['class' => 'text']) ?>
        </div>
        <div class="date-comment ml-auto">
            <?= Html::tag('p', $comment['date'], ['class' => 'date']) ?>
        </div>
    </div>
</div>