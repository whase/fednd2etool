<?php

namespace app\models;

use app\models\Users as DbUser;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $role;
    public $authKey;
    public $accessToken;

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $dbUser = DbUser::find()
            ->where([
                "id" => $id
            ])
            ->one();
        if(!$dbUser){
            return null;
        }
        return new static($dbUser);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $dbUser = DbUser::find()
            ->where(["accesToken" => $token])
            ->one();
        if($dbUser){
            return null;
        }
        
        return new static($dbUser);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $dbUser = DbUser::find()
            ->where([
                "username" => $username
            ])
            ->one();
        if ($dbUser) {
            return null;
        }
        return new static($dbUser);
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
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($this->password) === $password;
    }
}
