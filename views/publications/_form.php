<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use yii\base\View;

/* @var $this yii\web\View */
/* @var $model app\models\Publications */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="publications-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <? $form->field($model, 'image')->fileInput(['id' => 'image-form', 'class' => '', 'style' => 'width: min-content;']) ?>

    <?= Html::img('#', ['width' => '800px', 'id' => 'blant']); ?>

    <?= \Yii::$app->view->renderFile('@app/views/site/layout/uploadImg.php', [
        'form' => $form,
        'model' => $model,
        'widthImg' => '100%'
    ]); ?>


    <!-- <? $form->field($model, 'cover_img_url')->textarea(['rows' => 6]) ?> -->

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
            'inline'
        ],
    ]) ?>


    <?= $form->field($model, 'genre')->widget(Select2::classname(), [
        'language' => 'ru',
        'data' => $genreList,
        'hideSearch' => true,
        'options' => ['placeholder' => 'Выберите жанр'],
        'pluginOptions' => [
            'multiple' => true,
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>