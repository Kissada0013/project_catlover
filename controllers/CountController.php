<?php

namespace app\controllers;

use app\models\Cat;
use app\models\Count;
use app\models\Order;
use app\models\OrderDetail;
use Cassandra\Date;
use Yii;
use yii\db\Exception;
use yii\db\Transaction;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\Session;

class CountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session = new Session;

        if ($session['cart']) {

            $datacat = Cat::find()->where(['id' => $session['cart']])->asArray()->all();

            return $this->render('index', [
                'datacat' => $datacat,
            ]);
        }
//        return Json::encode($count);
        return $this->render('index');
    }

    public function actionUpload()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $session = new Session();
        $count1 = count($session['cart']);
//        return Json::encode(Yii::$app->user->identity->id);
        $order = new Order();
        $order->user_id = Yii::$app->user->identity->id;

        $order->date = date('Y-m-d');
        $flag = true;
        if ($session['cart']) {
            try {
                if ($order->save()) {
                    foreach ($session['cart'] as $item) {
                        $order_detail = new OrderDetail();
                        $order_detail->created_at = date('Y-m-d');
                        $order_detail->cat_id = $item;
                        $order_detail->order_id = $order->id;
                        if (!$order_detail->save()) {
                            $flag = false;
                            break;
                        }
                    }
                } else {
                    $flag = false;
                }
            } catch (Exception $e) {
                $flag = false;
            }
            if ($flag) {
                Cat::updateAll(['status' => 0], ['id' => $session['cart']]);
                $session->destroy();
                $transaction->commit();
                return $this->redirect(["cat/index"]);
            } else {
                $transaction->rollBack();
                return $this->redirect("index");
            }
        } else {
            return $this->redirect("index");
        }


//           $order->save();
//        $count->save();

//        return $this->redirect(Yii::$app->request->referrer);
//        $this->redirect(['cat/index']);
    }

}
