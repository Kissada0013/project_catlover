<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ques".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $text
 * @property string|null $ans
 */
class Ques extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ques';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['text', 'ans'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'ans' => 'Ans',
        ];
    }
}
