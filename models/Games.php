<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property integer $api_game_id
 * @property string $game_date
 * @property string $created_at
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s');
                }
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['api_game_id'], 'required'],
            [['api_game_id'], 'integer'],
            [['game_date', 'created_at'], 'safe'],
            [['api_game_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'api_game_id' => 'Api Game ID',
            'game_date' => 'Game Date',
            'created_at' => 'Created At',
        ];
    }
}
