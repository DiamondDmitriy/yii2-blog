<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PublicationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publications-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'cover_img_url') ?>

    <?= $form->field($model, 'summary') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'creater') ?>

    <?php // echo $form->field($model, 'genre') ?>

    <?php // echo $form->field($model, 'comments_post') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
