<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class CommentsModel extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['user_id', 'comment', 'id_post']],

            [['comment'], 'filter', 'filter' => 'trim'],
            [['comment', 'id_post'], 'required', 'message' => 'Поле не должно быть пустым'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment' => 'Оставте комментарий',
        ];
    }

    public static function search($post_id)
    {
        try {
            $query = (new \yii\db\Query())
                ->select('*')
                ->from('comments')
                ->where(['id_post' => $post_id])
                ->all();

            foreach ($query as &$comment) {
                $user = User::getUsersList($comment['user_id']);
                $comment['fio'] = implode(' ', [$user['lastname'], $user['name'], $user['patronymic']]);
                $comment['url_photo'] = $user['url_photo'];
                $comment['user_age'] = $user['age'];
            }

            return $query;
        } catch (\yii\db\Exception $e) {
            Yii::error($e->getMessage());
        }
    }
}
