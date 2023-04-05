<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $login;
    public $name;
    public $password;

    public function rules()
    {
        return [
            [['login', 'name', 'password'], 'required'],
            [['name'], 'string'],
            [['login'], 'email'],
            [['login'], 'unique', 'targetClass'=>'app\models\Users', 'targetAttribute'=>'login']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Повне ім\'я',
            'login' => 'Логін',
            'password' => 'Пароль',
        ];
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new Users();
            $user->attributes = $this->attributes;
            $user->role = 2;
            return $user->create();
        }
    }
}