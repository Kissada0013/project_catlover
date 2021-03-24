<?php

namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "Order".
 *
 * @property int $id
 * @property int|null $cat_id
 * @property string|null $age_cat
 * @property float|null $price
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string|null $pickup_date
 * @property int|null $status
 * @property string|null $img_path
 * @property string|null $img_name
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $image;
    public $search;

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'image_path',
                'nameAttribute' => 'image_name',
                'baseUrlAttribute' => 'image_url',

            ],
        ];
    }

    public static function tableName()
    {
        return 'Order';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['pickup_date'],'required','message'=>'กรุณากรอก {attribute}'],
            [['cat_id', 'user_id', 'status'], 'integer'],
            [['price'], 'number'],
            [['pickup_date'], 'safe'],
            [['image_path', 'image_url', 'image_name', 'image'], 'safe'],
            [['age_cat', 'user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'รหัสน้องแมว',
            'age_cat' => 'อายุน้องแมว',
            'price' => 'ราคา',
            'user_id' => 'User ID',
            'user_name' => 'ชื่อผู้ใช้งาน',
            'date' => 'วันที่ซื้อน้องแมว',
            'pickup_date' => 'วันที่จะมารับน้องแมว',
            'delivery' => 'การจัดส่ง',
            'img_path' => 'รูปภาพ',
            'img_name' => 'ชื่อภาพ',
            'image' => 'รูปภาพ',
            'image_url' => 'รูปภาพ',
            'image_path' => 'รูปภาพ',
            'image_name' => 'รูปภาพ',
            'status' => 'สเตตัส',
            'review' => 'รายละเอียดรีวิว',
            'cat_name' => 'ชื่อน้องแมว',
            'cat_type' => 'พันธุ์',
            'status_review' => 'สถานะการรีวิว'

        ];
    }

    static public function typeIntToString($data)
    {
        if ($data == 0) {
            return $data = 'ชำระเรียบร้อย';
        } elseif ($data == 1) {
            return $data = 'ยังไม่ชำระ';
        } elseif ($data == 2) {
            return $data = 'รอตรวจสอบ';
        }

    }
    static public function typeIntToDelivery($data)
    {
        if ($data == 0) {
            return $data = 'จัดส่งเรียบร้อย';
        } else {
            return $data = 'ยังไม่จัดส่ง';
        }

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

    public static function getDateForPlotChart()
    {
        $data = Order::find()
            ->select(['DATE_FORMAT({{order.date}},"%Y") as year', 'DATE_FORMAT({{order.date}},"%c") as month', 'order.date as date',
                'DATE_FORMAT({{order.date}},"%e") as day', 'count(distinct order.id) as order_amount', 'count(order_detail.id) as cat_amount', 'order.cat_id as cat_id'])
            ->innerJoin('order_detail', 'order.id = order_detail.order_id')
            ->groupBy(['order.date'])
            ->asArray()->all();
        return $data;
    }

    public static function getDataForSummaryRevenue()
    {
        $datay = Order::find()
            ->select(['join_year.yearlyPrice as yearlyPrice', 'join_year.costYearlyPrice as costYearlyPrice',
                'DATE_FORMAT({{order.date}}, "%Y") as year', 'DATE_FORMAT({{order.date}}, "%m") as month', 'DATE_FORMAT({{order.date}}, "%d") as day'])
            ->innerJoin('order_detail', 'order.id = order_detail.order_id')
            ->innerJoin('cat', 'order_detail.cat_id = cat.id')
            ->innerJoin('(
              select `order`.`id` as id ,SUM(`cat`.`price`) as yearlyPrice,SUM(`cat`.`cost_price`) as costYearlyPrice, DATE_FORMAT(`order`.`date`, "%Y") as year  from `cat` 
                inner join `order_detail` on `order_detail`.`cat_id` = `cat`.`id` 
                inner join `order` on `order`.`id` = `order_detail`.`order_id`
                group by `year`
            ) join_year', 'join_year.id = order.id')
            ->groupBy(['year'])
            ->orderBy('year')
            ->asArray()->all();

        $datam = Order::find()
            ->select(['join_month.monthlyPrice as monthlyPrice', 'join_month.costMonthlyPrice as costMonthlyPrice',
                'DATE_FORMAT({{order.date}}, "%Y") as year', 'DATE_FORMAT({{order.date}}, "%m") as month', 'DATE_FORMAT({{order.date}}, "%d") as day'])
            ->innerJoin('order_detail', 'order.id = order_detail.order_id')
            ->innerJoin('cat', 'order_detail.cat_id = cat.id')
            ->innerJoin('(
                select `order`.`id` as id ,SUM(`cat`.`price`) as monthlyPrice,SUM(`cat`.`cost_price`) as costMonthlyPrice, DATE_FORMAT(`order`.`date`, "%M") as month  from `cat` 
                inner join `order_detail` on `order_detail`.`cat_id` = `cat`.`id` 
                inner join `order` on `order`.`id` = `order_detail`.`order_id`
                group by `month`
            ) join_month', 'join_month.id = order.id')
            ->groupBy(['month'])
            ->orderBy('year, month')
            ->asArray()->all();

        $datad = Order::find()
            ->select(['join_day.dailyPrice as dailyPrice', 'join_day.costDailyPrice as costDailyPrice',
                'DATE_FORMAT({{order.date}}, "%Y") as year', 'DATE_FORMAT({{order.date}}, "%m") as month', 'DATE_FORMAT({{order.date}}, "%d") as day'])
            ->innerJoin('order_detail', 'order.id = order_detail.order_id')
            ->innerJoin('cat', 'order_detail.cat_id = cat.id')
            ->innerJoin('(
                select `order`.`id` as id, `order`.`date` ,SUM(`cat`.`price`) as dailyPrice, SUM(`cat`.`cost_price`) as costDailyPrice, DATE_FORMAT(`order`.`date`, "%d") as day  from `cat` 
                inner join `order_detail` on `order_detail`.`cat_id` = `cat`.`id` 
                inner join `order` on `order`.`id` = `order_detail`.`order_id`
                group by `order`.`date`
            ) join_day', 'join_day.id = order.id')
            ->orderBy('year, month, day')
            ->groupBy(['order.date'])
            ->asArray()->all();
        return ['yearly' => $datay, 'monthly' => $datam, 'daily' => $datad];
    }
}
