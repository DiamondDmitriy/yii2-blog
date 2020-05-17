<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>


<div class="publications-form">

    <?php $formComment = ActiveForm::begin([
        'options'     => [ 'data-pjax' => true],
    ]); ?>

    <?= $formComment->field($modelComments, 'comment')->textarea(['rows' => 6]) ?>
    <?= $formComment->field($modelComments, 'id_post')->hiddenInput(['value'=>$idPost])->label('')?>

    <div class="form-group">
        <?= Html::submitButton('Добавить комментарий', ['class' => 'btn btn-primary d-block ml-auto']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>