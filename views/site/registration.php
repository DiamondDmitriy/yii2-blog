<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$url_sign_in = '/login';
?>

<div class="site-sign-in">
    <!-- Html::encode($this->title)  -->
    <h1>Ты у нас новенький?</h1>
    <p>Давай зарегистрируем тебя на платформе :)</p>

    <?php $form = ActiveForm::begin([
        'id' => 'sign-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label'],
        ],
    ]); ?>

    <?php
    if (Yii::$app->session->hasFlash('registrationError')) {
        echo '<p class="help-block help-block-error ">'.Yii::$app->session->getFlash('registrationError').'</p>';
    }
    ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['placeholder' => 'same@youmail.com']) ?>

    <?= $form->field($model, 'login')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_repeat')->passwordInput() ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11" style="margin-top: 20px;">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <div class="col-lg-offset-1 col-lg-11" style="margin-top: 20px;">
            <?= Html::a('Войти', $url_sign_in, []) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- <div class="col-lg-offset-1" style="color:#999;"> -->
    <!-- You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br> -->
    <!-- To modify the username/password, please check out the code <code>app\models\User::$users</code>. -->
    <!-- </div> -->
</div>