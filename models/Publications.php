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
 * @property string $creater
 * @property string $genre
 * @property int $comments_post
 */
class Publications extends \yii\db\ActiveRecord
{
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
            [['title', 'cover_img_url', 'summary', 'content', 'creater', 'genre', 'comments_post'], 'required'],
            [['cover_img_url', 'summary', 'content'], 'string'],
            [['comments_post'], 'integer'],
            [['title', 'creater'], 'string', 'max' => 255],
            [['genre'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'cover_img_url' => 'Cover Img Url',
            'summary' => 'Summary',
            'content' => 'Content',
            'creater' => 'Creater',
            'genre' => 'Genre',
            'comments_post' => 'Comments Post',
        ];
    }
}
