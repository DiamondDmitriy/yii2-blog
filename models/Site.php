<?php

namespace app\models;

use Yii;
use yii\db\Exception as db_ex;


class Site extends yii\base\Model
{


    public static function getDb()
    {
        return Yii::$app->db;
    }


    /**
     * 
     */
    public static function getJenre()
    {
        $sql = <<<SQL
SELECT * FROM `jenre` 
SQL;

        try {
            return self::getDB()->createCommand($sql)->queryAll();
        } catch (db_ex $e) {
            Yii::error($e->getMessage());
        }
    }
}
