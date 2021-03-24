<?php

namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "vaccine".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property string|null $image_path
 * @property string|null $vaccine_day
 * @property string|null $veterinary
 */
class Vaccine extends \yii\db\ActiveRecord
{
    public $img_file ='';
    public function behaviors()
    {
        return [
            'img_file' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'img_file',
//                'pathAttribute' => 'image_path',
//                'nameAttribute' => 'image',
//                'baseUrlAttribute' => 'img_url',

            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vaccine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vaccine_day'], 'safe'],
            [['name', 'veterinary'], 'string', 'max' => 100],
            [['image', 'image_path'], 'string', 'max' => 200],
            [['image_path','image','img_url','img_file'], 'safe'],

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
            'image' => 'รูปภาพ',
            'image_path' => 'รูปภาพ',
            'vaccine_day' => 'วันที่ฉีด',
            'veterinary' => 'สัตวแพทย์',
        ];
    }
}
