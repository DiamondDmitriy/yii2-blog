<?php

use yii\helpers\Html;

echo  Html::tag('div', '', [
    'style' => [
        'width' => $width . $unit,
        'height'=>$height . $unit,
        'background-image'=>"url($imagePath)",
    ],
    'class' => 'user-img',
]);
