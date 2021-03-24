<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "farm".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $owner
 * @property string|null $tel
 * @property string|null $email
 * @property string|null $address
 */
class Farm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'farm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'owner', 'address'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 50],
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
            'owner' => 'ชื่อเจ้าของฟาร์ม',
            'tel' => 'เบอร์โทร',
            'email' => 'อีเมล',
            'address' => 'ที่อยู่',
        ];
    }
    public static function allDataFarm()
    {
        $dataWork = Farm::find()->all();
        return $dataWork;
    }
}
