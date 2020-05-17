<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) : ?>

        <div class="alert alert-success">
            Спасибо за ваше сообщение, в скором времени мы дадим обратную связь!
        </div>

        <p>
            <?php if (Yii::$app->mailer->useFileTransport) : ?>
                Поскольку приложение в режиме разработки, отправка не была осуществленна, но сохранена в файле 
                по пути <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                При необходимости настройте отправку в <code>useFileTransport</code> значение <code>mail</code>
            <?php endif; ?>
        </p>

    <?php else : ?>

        <p>
            Если у вас появились замечания, притензии, рекомендации или может быть вы хотите сотрудничать с нами, вы можете заполнить поля
            ниже и мы с вами свяжемся. 
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'value' => (Yii::$app->user->identity->fio ?? '')]) ?>

                <?= $form->field($model, 'email')->textInput(['value' => (Yii::$app->user->identity->mail) ?? '']) ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>