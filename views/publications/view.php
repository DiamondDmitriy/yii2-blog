<?php

use app\models\Publications;
use app\models\Site;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Publications */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$genrePost = Publications::getGenreName($model->genre);
// Yii::warning();
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


    <h1 style="margin-top: 60px;"><?= Html::encode($this->title) ?></h1>

    <div class="panel-info-publ d-flex" style="margin-bottom: 25px;">
        <p><strong>Жанры:</strong> <?= implode(', ', $genrePost) ?></span></p>
        <p class="ml-auto"><strong>Просмотры:</strong> <span><?= $model->watch ?></span></p>
    </div>

    <img src="\uploads\img\posts\<?= $model->cover_img_url ?>" width="100%">

    <?= $model->content ?>
    <p style="font-weight:bold">Автор статьи:
        <span style="font-weight:400"><?= User::getUsersList($model->creater_id)['fio'] ?></span>
    </p>

    <?php Pjax::begin(); ?>
    <h3 class="comments-title" style="margin-bottom:20px;">Комментарии</h3>

    <?php if (!Yii::$app->user->isGuest) : ?>

        <div class="comment-add">
            <?= $this->render('../layouts/_add-comments', [
                'modelComments' => $modelComments,
                'idPost' => $model->id,
            ]);
            ?>
        </div>
    <?php else : ?>
        <div class="alert alert-success">
            Чтобы оставить коментарий <?= Html::a('Войдтите', '/login') ?> в профиль
        </div>
    <?php endif ?>

    <div class="comments-section">
        <?php

        foreach ($postComments as $_comm) {
            echo $this->render('../layouts/_comment', [
                'comment' => $_comm,
            ]);
        }
        ?>
        <?php if (empty($postComments)) : ?>
            <div class="alert alert-success">
                Комментариев нет
            </div>
        <?php endif; ?>
    </div>
    <?php Pjax::end(); ?>

</div>