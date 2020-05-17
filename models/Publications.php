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
            [['title'], 'string', 'max' => 255, 'min' => 3],
            [['genre', 'data_create'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg'],

            // [['title', 'genre', 'image', 'content', 'summary'], 'required'],
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
            'image' => 'Превью изображения',
            'data_create'=>'data',
        ];
    }

    public function parsingGenre($genre)
    {
        if (!empty($genre))
            return implode(',', $genre);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->genre = $this->parsingGenre($this->genre);
            $this->creater_id = Yii::$app->user->identity->id;

            return true;
        }
        return false;
    }


    public function uploadImage()
    {
        $fileName =  $this->getNameImage();

        if ($this->validate()) {
            $this->image->saveAs("uploads/img/posts/" . $fileName);
            return  $fileName;
        } else {
            return false;
        }
    }

    public function getNameImage()
    {
        return md5(uniqid($this->image->baseName)) . '.' . $this->image->extension;
    }
}
