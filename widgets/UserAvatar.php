<?php

namespace app\widgets;

use app\models\Site;
use app\models\User;
use Yii;
use yii\base\Widget;

class UserAvatar extends Widget
{
    public $height;
    public $width;
    public $id_user; // id запрошенного пользователя 
    public $unitHW = 'px';
    public $selectUserId; // id полльзоватля

    public function init()
    {
        parent::init();

        $this->selectUserId = (\Yii::$app->user->isGuest) ? null : \Yii::$app->user->identity->id;

        $this->height = $this->height ?? 50;
        $this->width = $this->width ?? 50;
        $this->id_user = $this->id_user ?? $this->selectUserId;
    }

    public function run()
    {
        $image = $this->getImageAvatar();


        return $this->render('@app/views/layouts/_user-avatar', [
            'width' => $this->width,
            'height' => $this->height,
            'unit' => $this->unitHW,
            'imagePath' => $image,
        ]);
    }

    /**
     * логика получение изображения
     */
    private function getImageAvatar()
    {

        $user = Site::getAccountUser($this->id_user);
        $imgProfile = !empty($user->url_photo) ? $user->url_photo : \Yii::$app->params['defaultImg']['profile'];


        return $imgProfile;
    }
}
