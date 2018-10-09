<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $password
 * @property string $role
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Characters[] $characters
 */
class Users extends \yii\db\ActiveRecord
{
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
            [['username', 'password', 'role'], 'required'],
            [['username', 'password'], 'string', 'max' => 64],
            [['role'], 'string', 'max' => 11],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role',
            'authKey' => 'AuthKey',
            'accessToken' => 'AccessToken',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Characters::className(), ['user' => 'id']);
    }
}
