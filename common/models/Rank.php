<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rank".
 *
 * @property int $id
 * @property int $rank
 * @property int $id_keyword
 * @property int $id_user
 * @property string $date
 * @property string $time
 */
class Rank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rank', 'id_keyword', 'id_user', 'date', 'time'], 'required'],
            [['rank', 'id_keyword', 'id_user'], 'integer'],
            [['date', 'time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rank' => 'Rank',
            'id_keyword' => 'Id Keyword',
            'id_user' => 'Id User',
            'date' => 'Date',
            'time' => 'Time',
        ];
    }
}
