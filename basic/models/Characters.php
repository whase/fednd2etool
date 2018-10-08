<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characters".
 *
 * @property int $id
 * @property string $name
 * @property int $level
 * @property int $stars
 * @property int $emblempoints
 * @property int $favorite
 * @property string $tag
 * @property int $user
 *
 * @property CharacterStats[] $characterStats
 * @property Users $user0
 */
class Characters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'level', 'stars', 'emblempoints', 'favorite', 'tag', 'user'], 'required'],
            [['level', 'stars', 'emblempoints', 'favorite', 'user'], 'integer'],
            [['name', 'tag'], 'string', 'max' => 48],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user' => 'id']],
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
            'level' => 'Level',
            'stars' => 'Stars',
            'emblempoints' => 'Emblempoints',
            'favorite' => 'Favorite',
            'tag' => 'Tag',
            'user' => 'User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterStats()
    {
        return $this->hasMany(CharacterStats::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'user']);
    }
}
