<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications".
 *
 * @property int $id
 * @property string $title
 * @property string $cover_img_url
 * @property string $summary
 * @property resource $content
 * @property int $creater_id
 * @property string $genre
 * @property int $comments_post
 */
class Publications extends \yii\db\ActiveRecord
{

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['title', 'cover_img_url', 'summary', 'content', 'creater_id', 'genre', 'comments_post'], 'required'],
            [['cover_img_url', 'summary', 'content'], 'string'],
            [['comments_post', 'creater_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['genre'], 'safe'],

            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'cover_img_url' => 'Изображение',
            'summary' => 'Краткое содержание',
            'content' => 'Содержание',
            'creater_id' => 'Создатель',
            'genre' => 'Жанр',
            'comments_post' => 'Комментарии id',
            'image'=> 'Превью изображения',
        ];
    }

    // public function beforeSave($insert)
    // {

    // }


    public function uploadImage($tmp = false)
    {
        if ($this->validate() && $tmp) {

            $this->image->saveAs("uploads/tmp/{$this->image->baseName}.{$this->image->extension}");
        } else if (!$tmp) {
            $this->image->baseName = uniqid();
            var_dump($this->image->baseName);
            // $this->image->saveAs("uploads/img/{$this->image->baseName}.{$this->image->extension}");
        } else {
            return false;
        }
    }
}
