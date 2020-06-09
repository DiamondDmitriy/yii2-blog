<?php

use yii\helpers\Html;
$label = $label?? '';
?>


<div class="publications-form">

    <?= $form->field($model, 'image')->fileInput(['id' => 'image-form', 'class' => '', 'style' => 'width: min-content;'])->label($label) ?>
    <?= Html::img('#',['id'=>'blah', 'width'=>($widthImg)?? '400px','style'=>'margin-bottom:20px']); ?>

</div>

<?php
// скрипты и стили
$JS_RELOAD_PJAX = <<<JS
let base64Image;

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      base64Image = e.target.result;
      $('#blah').attr('src', base64Image);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#image-form").change(function() {
  readURL(this);
});
JS;

$this->registerJs($JS_RELOAD_PJAX,  yii\web\View::POS_END);
