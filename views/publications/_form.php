<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Publications */
/* @var $form yii\widgets\ActiveForm */

?>


<div class="publications-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?php Pjax::begin([
        'id' => 'pjax_upload_img',
    ]); ?>

    <?php if ($model->image) : ?>
        <img src="/uploads/<?= $model->image ?>" alt="" width="100%">
    <?php endif; ?>

    <?php Pjax::end(); ?>
    <?= $form->field($model, 'image')->fileInput(['id' => 'image-form', 'class' => '', 'style' => 'width: min-content;', 'onChange' => 'updatePjax()']) ?>





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

<?php
// скрипты и стили

$JS_RELOAD_PJAX = <<< JS
function updatePjax(){
    setData = {'image': $('#image-form').val()};

    $.ajax({
        url:'/publications/create',
        data: setData,
        method: "POST",
    },()=>{
        $.pjax.reload('#pjax_upload_img');
    });
}




JS;

$this->registerJs($JS_RELOAD_PJAX,  yii\web\View::POS_END);
