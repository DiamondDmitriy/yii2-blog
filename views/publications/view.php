<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Publications */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="publications-view">

    <?php if ($model->creater_id == Yii::$app->user->identity->id) : ?>
        <p>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены что хотите удалить статью?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

    <img src="\uploads\img\posts\<?= $model->cover_img_url ?>" width="100%">

    <h1 style="margin-top: 60px;margin-bottom: 40px;"><?= Html::encode($this->title) ?></h1>

    <?= $model->content ?>

    <?php Pjax::begin(); ?>
    <h3 class="comments-title">Комментарии</h3>
    <div class="comment-add">
        <?= $this->render('../layouts/comments', [
            'modelComments' => $modelComments,
            'idPost' => $model->id,
        ]);
        ?>
    </div>

    <div class="comments-section border border-secondary">
        <?php

        foreach ($postComments as $_comm) {
            echo $this->render('../layouts/_comment', [
                'comment' => $_comm,
            ]);
        }
        ?>
    </div>
    <?php Pjax::end(); ?>

</div>