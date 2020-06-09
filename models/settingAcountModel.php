<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string|null $lastname
 * @property string $patronymic
 * @property int $age
 * @property string $auth_key
 * @property string|null $mail
 * @property string $login
 * @property string $url_photo
 * @property int $publication_count
 * @property int $like_count
 * @property int $liked_count
 * @property int $comments_count
 * @property int $subscribes_count
 * @property string $subscribes
 * @property string $status
 */
class settingAcountModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'mail'], 'required', 'message' => 'Поле не должно быть пустым'],
            [['age', 'publication_count', 'like_count', 'liked_count', 'comments_count', 'subscribes_count'], 'integer'],
            [['url_photo', 'subscribes'], 'string'],
            [['name', 'lastname', 'mail', 'login'], 'string', 'max' => 64],
            [['patronymic'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1024],
            ['age', 'integer', 'max' => 150],
            // ['name', 'value'=>$this->name]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'lastname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'age' => 'Возраст',
            'auth_key' => 'Auth Key',
            'mail' => 'Email',
            'login' => 'Login',
            'url_photo' => 'Url Photo',
            'publication_count' => 'Publication Count',
            'like_count' => 'Like Count',
            'liked_count' => 'Liked Count',
            'comments_count' => 'Comments Count',
            'subscribes_count' => 'Subscribes Count',
            'subscribes' => 'Subscribes',
            'status' => 'Статус',
        ];
    }
}
