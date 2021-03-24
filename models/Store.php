<?php

namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;

/**
 * This is the model class for table "store".
 *
 * @property string|null $name
 * @property string|null $image
 * @property string|null $image_path
 * @property string|null $owner
 * @property string|null $phone
 * @property string|null $username
 * @property string|null $password
 * @property float|null $lat
 * @property float|null $lng
 * @property string $address
 * @property int $id
 */
class Store extends \yii\db\ActiveRecord
{
    public $img_file ='';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */

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
        ];
    }

    public function rules()
    {
        return [
            [['lat', 'lng'], 'number'],
            [['address'], 'required'],
            [['name', 'owner', 'address'], 'string', 'max' => 255],
            [['image', 'image_path'], 'string', 'max' => 255],
            [['img_file','image', 'image_path'], 'safe'],
            [['phone'], 'string', 'max' => 12],
            [['username', 'password'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ชื่อร้าน',
            'image' => 'รูปภาพ',
            'image_path' => 'รูปภาพ',
            'owner' => 'ชื่อเจ้าของร้าน',
            'phone' => 'เบอร์โทรศัพท์',
            'username' => 'ชื่อผู้ใช้งาน',
            'password' => 'รหัสผ่าน',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'address' => 'ที่อยู่',
            'id' => 'ID',
        ];
    }
}
