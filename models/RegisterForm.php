<?php

namespace app\models;

use Yii;
use app\models\Role;
use app\models\User;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class RegisterForm extends Model
{
    public string $name = '';
    public string $surname = '';
    public string $patronymic = '';
    public string $login = '';
    public string $email = '';
    public string $password = '';
    public string $password_repeat = '';
    public string $phone = '';
    public ?string $avatar = '';
    public object | string | null $imageFile = '';
    public bool $rules = false;

    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'password', 'password_repeat', 'phone'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password', 'password_repeat', 'phone'], 'string', 'max' => 255],

            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яё\s\-]+$/ui', 'message' => 'Кирилица, пробелы, тире'],

            [['login', 'email'], 'unique', 'targetClass' => User::class],

            ['login', 'match', 'pattern' => '/^[a-z\s\d\-]+$/i', 'message' => 'Латиница, цифры, пробелы, тире'],

            ['email', 'email'],

            ['password', 'string', 'min' => 6],
            ['password', 'match', 'pattern' => '/^[a-z\d\-]+$/i', 'message' => 'Латиница, цифры, тире'],

            ['password_repeat', 'compare', 'compareAttribute' => 'password'],

            ['phone', 'match', 'pattern' => '/^\+7\([\d]{3}\)\-[\d]{3}\-[\d]{2}\-[\d]{2}$/', 'message' => 'Только формат +7(XXX)-XXX-XX-X'],

            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

            ['rules', 'required', 'requiredValue' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'phone' => 'Телефон',
            'imageFile' => 'Аватар',
            'rules' => 'Согласие с правилами регистрации'
        ];
    }

    public function userRegister(): object|false
    {
        if ($this->validate()) {
            $user = new User();
            $user->load($this->attributes, '');
            $user->password = Yii::$app->security->generatePasswordHash($user->password);
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->role_id = Role::getRoleId('user');

            if (!$user->save()) {
                VarDumper::dump($user->errors, 10, true); die;
            }
        }
        return $user ?? false;
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $fileName = Yii::$app->user->id
                            . '_'
                            . time()
                            . '_'
                            . Yii::$app->security->generateRandomString()
                            . '.'
                            . $this->imageFile->extension;
            $this->imageFile->saveAs('img/' . $fileName);
            $this->imageFile = null;
            $this->avatar = $fileName;
            return true;
        } else {
            return false;
        }
    }
}