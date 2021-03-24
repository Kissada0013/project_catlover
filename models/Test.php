<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $date
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'date' => 'Date',
        ];
    }

    public static function getDetail($id)
    {
        $model = self::find()
            ->select(['name'])
            ->where(['id' => $id])
            ->asArray()->all();
        return $model;
    }

    public function getDetailNonStatic()
    {
        $model = self::find()
            ->select(['name'])
            ->where(['id' => $this->id])
            ->one();
        return $model;
    }
}
