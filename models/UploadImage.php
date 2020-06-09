<?php

namespace app\models;

use Yii;


class UploadImage extends yii\base\Model
{
    public $image;


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image' => '',
        ];
    }

    public static function uploadImageBase64()
    {

        return null;
    }
}
