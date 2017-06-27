<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "domain".
 *
 * @property int $id
 * @property string $nama
 * @property int $id_user
 */
class Domain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['nama'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'id_user' => 'Id User',
        ];
    }
}
