<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widjet\Pjax;

?>


<div class="publications-form">

    <?= $form->field($model, 'image')->fileInput(['id' => 'image-form', 'class' => '', 'style' => 'width: min-content;']) ?>
    <?= Html::img('#',['id'=>'blah', 'width'=>($widthImg)?? '400px','style'=>'margin-bottom:20px']); ?>

</div>

<?php
// скрипты и стили
$JS_RELOAD_PJAX = <<<JS
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#image-form").change(function() {
  readURL(this);
});
JS;

$this->registerJs($JS_RELOAD_PJAX,  yii\web\View::POS_END);
