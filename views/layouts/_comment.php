<?php

use yii\helpers\Html;
use app\widgets\UserAvatar;

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
        <?= UserAvatar::widget([
            'width' => 70,
            'height' => 70,
            'id_user'=>$comment['user_id'],
        ]) ?>
    </div>
    <div class="comment__right">
        <h5 class="user-fio">
            <?= Html::a($comment['fio'], ['/account', 'id' => $comment['user_id']],['data-pjax'=>0]) ?>
        </h5>
        <div class="tetx-comment">
            <?= Html::tag('p', Html::encode($comment['comment']),  ['class' => 'text']) ?>
        </div>
        <div class="date-comment ml-auto">
            <?= Html::tag('p', $comment['date'], ['class' => 'date']) ?>
        </div>
    </div>
</div>