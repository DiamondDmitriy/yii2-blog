<?php

namespace app\models;

use Yii;
use yii\db\Exception as db_ex;
use yii\helpers\ArrayHelper;



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
            $jenre = self::getDB()->createCommand($sql)->queryAll();
            return ArrayHelper::map($jenre,'alias','name');
        } catch (db_ex $e) {
            Yii::error($e->getMessage());
        }
    }

    public static function hasFile($filePath, $webroot = false)
    {
        if($webroot){
            $filePath = Yii::getAlias('@webroot') . $filePath;
        }

        return file_exists($filePath);
    }
}
