<?php

use app\models\Site;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\grid\{GridView};
use yii\widgets\{ListView, Pjax};



$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;

$genreList = Site::getJenre();
$sortList = ['date_create' => 'дата', 'watch' => 'просмотры'];

$mainCss = <<<CSS
.sidebar-filters{
    background-color: #e9ecef;
    color: #6c757d;
    border-radius: 0.25rem;
    padding: 10px;
}

.main-content{

}
CSS;

$this->registerCSS($mainCss);
?>

<div class="publications-index wrap">

    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <aside class="sidebar-filters mr-auto border">
                <?php Pjax::begin();

                $form = ActiveForm::begin([
                    'class' => 'filters-form'
                ]);

                echo $form->field($searchModel, 'title')->textInput();

                echo $form->field($searchModel, 'genre')->widget(Select2::classname(), [
                    'language' => 'ru',
                    'data' => $genreList,
                    'hideSearch' => true,
                    'options' => ['placeholder' => 'Выберите жанр'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);

                echo $form->field($searchModel, 'sortField')->widget(Select2::classname(), [
                    'language' => 'ru',
                    'data' => $sortList,
                    'hideSearch' => true,
                    'options' => ['placeholder' => 'Сортировка'],
                    'pluginOptions' => [
                        'multiple' => false,
                        'allowClear' => true
                    ],
                ])->label('Поле порядка');

                echo $form->field($searchModel, 'orderSort')->widget(SwitchInput::classname(), [])->label('По убыванию');

                echo '<div class="d-flex">';
                echo Html::submitButton('Поиск', ['class' => 'btn btn-primary mr-auto']);
                echo Html::input('submit', 'clear-filters', 'Сбросить', ['id'=>'clear-submit','class' => 'btn btn-secondary', 'data-pjax' => 0]);
                echo '</div>';
                ActiveForm::end();
                Pjax::end();
                ?>
            </aside>
        </div>
        <div class="main-content col-sd-8 col-lg-9 col-sm-12">
            <div class="title-section d-flex" style="margin-bottom:20px;">
                <h1><?= Html::encode($this->title) ?></h1>

                <?= (Yii::$app->user->isGuest) ? '' : Html::a('Добавить публикацию', ['create'], ['class' => 'align-self-center btn btn-success d-block ml-auto', 'style' => 'height: max-content;']) ?>

            </div>

            <?php Pjax::begin() ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_itemPublication',
            ]); ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>