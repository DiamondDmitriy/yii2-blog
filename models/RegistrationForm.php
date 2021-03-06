<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\LoginForm;

class RegistrationForm extends Model
{
    public $name;
    public $lastname;
    public $email;
    public $login;
    public $password;
    public $password_repeat;

    private $insert = <<<SQL
    INSERT INTO users(NAME, LASTNAME, LOGIN , AUTH_KEY, MAIL) VALUES (:name, :lastname, :login, :auth_key, :mail)
SQL;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password', 'password_repeat', 'email', 'name'], 'required', 'message' => 'Не забудь про меня!'],
            ['email', 'email', 'message' => 'Не верный формат!'],
            ['lastname', 'safe'],
            ['password', 'validatePassword', 'message' => 'Пароль некорректный'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароль не совпадает'],
            ['login', 'validateLogin', 'message' => 'Логин некорректный'],

            [['login', 'password', 'email'], 'string', 'message' => 'Длинна должна быть от 6 символов', 'length' => [6, 22]]
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'lastname' => 'Фамилия',
            'mail' => 'Email',
            'login' => 'логин',
            'password' => 'пароль',
            'password_repeat' => 'повторите пароль',
        ];
    }

    public function getDB()
    {
        return \Yii::$app->db;
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->commonValidate($attribute)) {
                $this->addError($attribute, 'Логин является не корректным');
            }
        }
    }

    /**
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateLogin($attribute, $params)
    {
        // if (!$this->hasErrors()) {
        // if (!$this->commonValidate($attribute)) {
        //     $this->addError($attribute, 'Логин является не корректным');
        // }

        // login ununicated
        // if(false){
        // }
        // }

        return false;
    }




    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function registration()
    {

        if (!$this->validateHack($this->login) || !$this->validateHack($this->password)) {
            return false;
        }

        $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);

        try {
            $this->getDB()->createCommand($this->insert)
                ->bindValues([
                    ':name' => $this->name,
                    ':lastname' => $this->lastname,
                    ':mail' => $this->email,
                    ':login' => $this->login,
                    ':auth_key' => $hash,
                ])->execute();
        } catch (\yii\db\Exception $e) {
            Yii::error($e->getMessage());
        }

        $this->loginAfter($hash);
        return true;
    }
    public function loginAfter($authKey)
    {
        $identity = User::findOne(['auth_key' => $authKey]);
        Yii::$app->user->login($identity);
    }


    public function commonValidate($field)
    {
        if (!is_string($field) || $field === '') {
            return false;
        }

        if (!preg_match('/^[a-zA-Z\d]{6,}$/', $field)) {
            Yii::warning(preg_match('/^[a-zA-Z\d]{6,}$/', $field));
            return false;
        }
        
        return true;
    }
    public function validateHack($attribute)
    {
        if (!$this->commonValidate($attribute)) {
            Yii::$app->session->setFlash('registrationError','Логин или пароль не является корректным!');
            return false;
        }
        return true;
    }
}
