<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publications */

$this->title = 'Create Publications';
$this->params['breadcrumbs'][] = ['label' => 'Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
