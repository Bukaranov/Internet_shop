<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 * @property int $role
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ADMIN = 1;
    const USER = 2;
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
            [['name', 'login', 'password', 'role'], 'required'],
            [['role'], 'integer'],
            [['name', 'login', 'password'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'login' => 'Login',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }

    public static function findIdentity($id)
    {
        return Users::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }


    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findByLogin($login)
    {
        return Users::find()->where(['login'=>$login])->one();
    }

    public function validatePassword($password)
    {
        if ($this->password == $password){
            return true;
        }
        else{
            return false;
        }
    }

    public function create()
    {
        return $this->save(false);
    }

    public function getIsAdmin()
    {
        return $this->role == self::ADMIN;
    }

    public function getIsUser()
    {
        return $this->role == self::USER;
    }

}
