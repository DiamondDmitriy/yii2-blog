<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


// echo "<pre>";
// print_r(Yii::$app->user);
// echo "</pre>";

Yii::warning(Yii::$app->user->identity->id);