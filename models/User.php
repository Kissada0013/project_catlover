<?php


namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username ชื่อผู้ใช้งาน
 * @property string $auth_key
 * @property string $password_hash รหัสผ่าน
 * @property string $password_reset_token
 * @property string $email อีมลล์
 * @property string|null $img_path
 * @property string|null $img_name
 * @property int $role สิทธิ์
 * @property int $role_description สิทธิ์
 * @property int $status สถานะ
 * @property string $created_at สร้างเมื่อ
 * @property string $updated_at แก้ไขเมื่อ
 * @property string $password
 * @property int $created_by
 * @property int $updated_by
 * @property int $person_id
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_NOT_ACTIVE = '0';
    const STATUS_ACTIVE = '1';
    const STATUS_DELETE = '2';
    const STATUS_CONFIRM = '3';

    public $image;
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'image_path',
                'nameAttribute' => 'image_name',
                'baseUrlAttribute' => 'image_url',

            ],
        ];
    }
    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return string
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [

            [['email','username','password_hash','tel','title_name','name','lastname','address'],'required','message'=>'กรุณากรอก {attribute}'],

            [['created_at'], 'safe'],
            [['image_path','image_url','image_name','image'],'safe'],
            [['username', 'name'], 'string', 'max' => 255],
            [['password_hash', 'email'], 'string'],
            [['title_name','lastname','address','tel'],'safe'],
//            [['tel']],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'lastname' => 'นามสกุล',
            'title_name' => 'คำนำหน้า',
            'username' => 'username',
            'password_hash' => 'password',
            'email' => 'email',
            'pass' => 'pass',
            'img_path' => 'รูปภาพ',
            'img_name' => 'ชื่อภาพ',
            'image' => 'รูปภาพ',
            'image_url' => 'รูปภาพ',
            'image_path' => 'รูปภาพ',
            'image_name' => 'รูปภาพ',

            'address' => 'ที่อยู่',
            'tel' => 'เบอร์โทร',
        ];
    }


    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return User the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return new static (self::findOne(['auth_key' => $token]));
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->primaryKey;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);

    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    static public function typeIntToString($type)
    {
        if ($type == 0) {
            return $type = 'ปิดการใช้งาน';
        } elseif ($type == 1) {
            return $type = 'กำลังใช้งาน';
        } elseif ($type == 2){
            return $type = '2';
        }
    }

    public static function getIdCatForSelect()
    {
        $data = self::find()->select(['id'])->asArray()->all();
        return ArrayHelper::map($data, 'id', 'id');
    }

    public static function getUserData($id)
    {

     return   User::find()->select(['user.pass', 'user.username', 'auth_assignment.item_name as role', 'user.email'])
            ->innerJoin('auth_assignment', 'user.id = auth_assignment.user_id')
            ->where(['auth_assignment.user_id'=>$id])->asArray()->one();
    }
}