<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class NewsModel extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    public static function search()
    {
        try {
            $query = (new \yii\db\Query())
                ->select('*')
                ->from('news')
                ->orderBy(['date'=>SORT_DESC])
                ->all();

            return $query;
        } catch (\yii\db\Exception $e) {
            Yii::error($e->getMessage());
        }
    }
}
