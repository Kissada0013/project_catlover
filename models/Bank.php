<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $owner
 * @property string|null $account
 * @property int|null $status
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'owner'], 'string', 'max' => 100],
            [['account'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อบัญชี',
            'owner' => 'ชื่อเจ้าของบัญชี',
            'account' => 'เลชที่',
            'status' => 'สเตตัส',
        ];
    }
}
