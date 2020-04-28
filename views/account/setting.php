<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>
<div class="account-setting">

    <?php $form = ActiveForm::begin([
        // 'options' => ['class'=>'form-group row']
    ]); ?>

    <?= $form->field($model, 'name')->input('', ['value' => Yii::$app->user->identity->name]) ?>
    <?= $form->field($model, 'lastname')->input('', ['value' => Yii::$app->user->identity->lastname]) ?>
    <?= $form->field($model, 'patronymic')->input('', ['value' => Yii::$app->user->identity->patronymic]) ?>
    <?= $form->field($model, 'age')->input('number', ['value' => Yii::$app->user->identity->age, 'min' => 10, 'max' => 150]) ?>
    <?= $form->field($model, 'mail')->input('email', ['value' => Yii::$app->user->identity->mail]) ?>
    <?= $form->field($model, 'status')->textarea(['value' => Yii::$app->user->identity->status]) ?>

    <div class="form-group">
    <a href="/account" class="btn btn-link">Назад</a>
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary ml-auto','style'=>'display:block']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>