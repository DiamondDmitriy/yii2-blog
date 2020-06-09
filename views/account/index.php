<?php

use app\models\Site;
use yii\bootstrap4\ActiveForm as Bootstrap4ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\UserAvatar;

$isGuest = Yii::$app->user->isGuest;
$carrentId = isset($idAcount) ? $idAcount : $idUser;
$user =  Site::getAccountUser($carrentId);
$fio = isset($user->fio) ?  $user->fio : 'не задано';
$idUser = isset($user->id)? $user->id : null ; 


$this->title = 'Аккаунт';
$this->params['breadcrumbs'][] = $this->title;

$iconSetting = <<<HTML
<svg class="bi bi-gear" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 014.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 01-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 011.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 012.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 012.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 011.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 01-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 018.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 001.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 00.52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 00-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 00-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 00-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 00-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 00.52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 001.255-.52l.094-.319z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 100 4.492 2.246 2.246 0 000-4.492zM4.754 8a3.246 3.246 0 116.492 0 3.246 3.246 0 01-6.492 0z" clip-rule="evenodd"/>
</svg>
HTML;

$iconDownload = <<<HTML
<svg class="bi bi-download" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M.5 8a.5.5 0 01.5.5V12a1 1 0 001 1h12a1 1 0 001-1V8.5a.5.5 0 011 0V12a2 2 0 01-2 2H2a2 2 0 01-2-2V8.5A.5.5 0 01.5 8z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M5 7.5a.5.5 0 01.707 0L8 9.793 10.293 7.5a.5.5 0 11.707.707l-2.646 2.647a.5.5 0 01-.708 0L5 8.207A.5.5 0 015 7.5z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M8 1a.5.5 0 01.5.5v8a.5.5 0 01-1 0v-8A.5.5 0 018 1z" clip-rule="evenodd"/>
</svg>
HTML;

$addPost = <<<HTML
<svg class="bi bi-plus-square-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2zm6.5 4a.5.5 0 00-1 0v3.5H4a.5.5 0 000 1h3.5V12a.5.5 0 001 0V8.5H12a.5.5 0 000-1H8.5V4z" clip-rule="evenodd"/>
</svg>
HTML;
?>


<div class="row">
  <div class="col-md-6 col-lg-4 col-sm-12">

    <?= UserAvatar::widget([
      'width' => 300,
      'height' => 300,
      'id_user'=> $carrentId,
    ]) ?>

    <?php if (!$isGuest && $carrentId == $idUser ) : ?>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><button class="btn btn-link" style="display: contents;" data-toggle="modal" data-target=".bd-uploadImg-modal"><?= $iconDownload ?> Загрузить изображение</button></li>
        <li class="list-group-item"><a href="/account/setting"><?= $iconSetting ?> Настройки</a></li>
      </ul>
    <?php endif; ?>

  </div>
  <div class="col-sm-12 col-md-6 ml-auto">
    <ul class="border list-group list-group-flush">
      <li class="list-group-item"><span class="font-weight-bold">ФИО:</span> <span class="justify-content-end"><?= $fio ?></span></li>
      <li class="list-group-item"><span class="font-weight-bold">Статус:</span> <span class="text-right"><?= !empty($user->status) ? $user->status : 'Не задан' ?></span> </li>
      <li class="list-group-item"><span class="font-weight-bold">Возраст:</span> <span class="pull-right"><?= !empty($user->age) ? $user->age : 'Не задан'  ?></span></li>
    </ul>
  </div>
</div>


<div class="row">
  <div class="col-md-12" style="padding-left:0; padding-right:0px;">
    <div class=" p-3 mb-2 bg-secondary text-white d-flex" style="margin-top:100px;">
      <h4 class="font-weight-bold align-self-center mb-0">Публикации</h4>
      <a href="/publications/create" class="btn btn-primary ml-auto">Добавить</a>
    </div>
  </div>

  <div class="col-md-12">

    <?= ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '../publications/publication_card',
      'summary' => 'Показано {count} из {totalCount}',
      'layout' => "{pager}\n{summary}\n{items}\n{pager}",

      'pager' => [
        'firstPageLabel' => 'Первая',
        'lastPageLabel' => 'Последняя',
        'nextPageLabel' => 'Следующая',
        'prevPageLabel' => 'Предыдущая',
        'maxButtonCount' => 1,
      ],
    ]);
    ?>
  </div>
</div>




<!-- modal -->
<div class="modal fade bd-uploadImg-modal" id="bd-uploadImg-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Загрузка изображения</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php
      Pjax::begin();
      $form = Bootstrap4ActiveForm::begin([
        'id' => 'upload-img',
        'options' => [
          'class' => 'form-horizontal',
          'data-pjax' => true,
        ],
        'fieldConfig' => [
          'template' => '<div class="col-md-4">{label}</div><div class="col-md-5">{input}</div><div class="col-md-6">{error}</div>',
        ],
      ]);
      ?>
      <div class="modal-body">
        <p>Выберите изображение на своём компьтере</p>
        <?= \Yii::$app->view->renderFile('@app/views/site/layout/uploadImg.php', [
          'form' => $form,
          'model' => $modelImage,
          'widthImg' => '100%',
          'label' => 'Загрузить аватар',
        ]); ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'id' => 'img-submit']); ?>
      </div>

      <?php
      Bootstrap4ActiveForm::end();
      Pjax::end();
      ?>
    </div>
  </div>
</div>


<?php

$JS_MODAL = <<<JS
let imgFile;

$('#bd-uploadImg-modal').on('hidden.bs.modal', function(){
  $('#blah')[0].src = '#';
  $('#image-form')[0].value = '';
});

$("#image-form").change(function() {
  imgFile = this.files;
});

$('form').on('beforeSubmit',function (){
  let data = {'imageBase64': base64Image };
  (base64Image !== undefined) && uploadImage(data);
  return false;
});


function refreshAvatar(){
  document.location.reload(true);
}

function errorUpdateAvatar(){

}

function uploadImage(data){
    $.ajax({
      url:'/account/upload-image',
      type: 'POST',
      data: data,
    }).done(response=>{
          if(response){
            refreshAvatar();
          }  else{
            errorUpdateAvatar();
          }
    });
}
JS;


$this->registerJs($JS_MODAL,  yii\web\View::POS_END);
