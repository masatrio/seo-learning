<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "katakunci".
 *
 * @property int $id
 * @property string $nama
 */
class Katakunci extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'katakunci';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 30],
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
        ];
    }
	public function save($runValidation = true, $attributeNames = null)
	{
		if ($this->getIsNewRecord()) {
			return $this->insert($runValidation, $attributeNames);
		} 
		else {
        return $this->update($runValidation, $attributeNames) !== false;
		}
	}
}
