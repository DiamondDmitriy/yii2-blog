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
    public $patronymic;
    public $age;
    public $url_photo;
    public $publication_count;
    public $like_count;
    public $liked_count;
    public $comments_count;
    public $subscribes_count;
    public $subscribes;
    public $status;
    public $fio;

    public static function getUsersList($id = null)
    {
        try {
            $userQ = (new \yii\db\Query())
                ->select('*')
                ->from('users');

            if (!is_null($id)) {
                $userQ->where(['id' => $id]);
                $userQ = $userQ->one();
                $userQ['fio'] = implode(" ", [$userQ['lastname'], $userQ['name'], $userQ['patronymic']]);
            } else {
                $userQ = $userQ->all();
                foreach ($userQ as &$user) {
                    $user['fio'] = implode(" ", [$userQ['lastname'], $userQ['name'], $userQ['patronymic']]);
                }
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
        return new static(self::getUsersList($id));
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        foreach ($userQ = self::getUsersList() as $user) {
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

            $lastname = isset($userQ['Lastname']) ? $userQ['Lastname'] : '';
            $name = isset($userQ['Name']) ? $userQ['Name'] : '';
            $patronymic = isset($userQ['Patronymic']) ? $userQ['Patronymic'] : '';

            $userQ['fio'] = implode(" ", [$lastname, $name, $patronymic]);

            return new static($userQ);
        } catch (\yii\db\Exception $e) {
            Yii::error($e->getMessage());
        }

        return null;
    }


        /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findOne($expression)
    {

        try {
            $userQ = (new \yii\db\Query())
                ->select('*')
                ->from('users')
                ->where($expression)
                ->one();

            $lastname = isset($userQ['Lastname']) ? $userQ['Lastname'] : '';
            $name = isset($userQ['Name']) ? $userQ['Name'] : '';
            $patronymic = isset($userQ['Patronymic']) ? $userQ['Patronymic'] : '';

            $userQ['fio'] = implode(" ", [$lastname, $name, $patronymic]);

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

    /**
     * upload avatar
     */
    public static function uploadAvatar($base64Image, $id = null)
    {

        if (is_null($id) && !Yii::$app->user->isGuest) {
            $id = Yii::$app->user->identity->id;
        }

        if (!is_null($id)) {
            try {
                Yii::$app->db->createCommand()->update('users', ['url_photo' => $base64Image], "id = $id")->execute();
                
                return ['status' => true];
            } catch (\yii\db\Exception $e) {
                Yii::error($e->getMessage());
                return ['status' => false, 'messange' => $e->getMessage()];
            }
        } else {
            return ['status' => false, 'messange' => 'user is not found'];
        }
    }
}
