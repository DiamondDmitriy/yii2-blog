<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


Html::tag('h1', 'Hello ', []);

echo "<pre>";
print_r(Yii::$app->user);
echo "</pre>";
