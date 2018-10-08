<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character_stats".
 *
 * @property int $character_id
 * @property string $stat_name
 * @property int $color
 * @property int $amount
 *
 * @property Characters $character
 * @property Stats $statName
 */
class CharacterStats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'character_stats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['character_id', 'stat_name', 'color', 'amount'], 'required'],
            [['character_id', 'color', 'amount'], 'integer'],
            [['stat_name'], 'string', 'max' => 16],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characters::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['stat_name'], 'exist', 'skipOnError' => true, 'targetClass' => Stats::className(), 'targetAttribute' => ['stat_name' => 'name']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'character_id' => 'Character ID',
            'stat_name' => 'Stat Name',
            'color' => 'Color',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Characters::className(), ['id' => 'character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatName()
    {
        return $this->hasOne(Stats::className(), ['name' => 'stat_name']);
    }
}
