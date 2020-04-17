<?php

namespace app\models;

use Yii;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $name;
    public $lastname;
    public $mail;
    public $login;
    public $auth_key;

    private $sql_users = <<<SQL
SELECT * FROM `users`
SQL;

    public function getDb()
    {
        return Yii::$app->db;
    }


    public static function getUsersList($id = null)
    {
        try {
            $userQ = (new \yii\db\Query())
                ->select('*')
                ->from('users');

            if (!is_null($id)) {
                $userQ->where(['id' => $id]);
                $userQ = $userQ->one();
            } else {
                $userQ = $userQ->all();
            }


            return $userQ;
            // return new static($userQ);
        } catch (\yii\db\Exception $e) {
            Yii::error($e->getMessage());
            return null;
        }
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {

        // $t = ($this->getUsersList($id)) ?  : null;
        $t = new static(self::getUsersList($id));
        // var_dump($t);
        return $t;
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        foreach ($userQ = $this->getUsersList() as $user) {
            // if ($user['accessToken'] === $token) {
            return new static($user);
            // }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        try {
            $userQ = (new \yii\db\Query())
                ->select('*')
                ->from('users')
                ->where(['login' => $username])
                ->orWhere(['mail' => $username])
                ->one();

            return new static($userQ);
        } catch (\yii\db\Exception $e) {
            Yii::error($e->getMessage());
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password, $auth_key)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $auth_key);
    }
}
