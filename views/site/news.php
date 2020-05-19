<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
use app\models\Site;
// use yii\web\View;

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

$mainStyle = <<<CSS
.news__container .news__img{
width: 100%;
height:25vw;
background-position: center;
background-size: cover;
background-repeat: no-repeat;
}

.news__container .news__content{
height: 300px;
overflow-y: hidden;
}
.news__container{
    margin-bottom:40px;
}

.news__container.expand .news__content{
height: auto;
}

.read-news{
    margin-top: 20px;
}
CSS;

$mainJs = <<<JS
$('.read-news').click(function(){
    let isCollaps = this.parentElement.classList.toggle('expand');

    if(isCollaps){
        this.innerText = 'Свернуть';
    }else{
        this.innerText = 'Читать дальше...';
    }
});
JS;

$this->registerCss($mainStyle);
$this->registerJS($mainJs, yii\web\View::POS_READY);


?>

<div class="page-news">
    <h1 style="margin-bottom: 40px">Новостной блок</h1>
</div>

<?php

foreach ($news as $new) {
    $imgUrl = (Site::hasFile($new['img_url'], true)) ? $new['img_url'] : '/images/none_img.png';

    $template = <<<HTML
<div class="news__container">
    <div class="news__img" style="background-image: url('{$imgUrl}');"></div>
    <h3 class="news__title" style="margin: 30px 0;">{$new['title']}</h3>
    <div class="news__content">{$new['content']}</div>
    <button class="read-news btn btn-link text-info d-block ml-auto">Читать дальше...</button>
</div>
HTML;
    echo $template;
}
?>