<?php


namespace app\controllers;


use app\helper\Helper;
use app\models\Cat;
use app\models\Count;
use app\models\Farm;
use app\models\Order;
use app\models\OrderDetail;
use app\models\search\CatSearch;
use app\models\search\OrderSearch;
use app\models\User;
use app\models\Vaccine;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\detail\DetailView;
use yii\web\Response;
use yii\web\Session;
use yii\web\UploadedFile;

class CatController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CatSearch();
//        $dataProvider = $searchModel->searchSell(\Yii::$app->request->queryParams);-----แมวที่ขายแล้ว
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
//        return Json::encode($dataProvider);

//        return Json::encode($dataProvider);

        $type = Cat::find()->select('type')->distinct()->all();
        $farm = Cat::find()->select('farm')->distinct()->all();
//        return Json::encode($farm);
        $count = 0;
        $session = new Session();
        if ($session['cart']) {
            $count = count($session['cart']);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => $type,
            'count' => $count,
            'farm' => $farm,
        ]);
    }


    public function actionSold()
    {
        $searchModel = new CatSearch();
        $dataProvider = $searchModel->searchSell(\Yii::$app->request->queryParams);
//        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
//        return Json::encode($dataProvider);

//        return Json::encode($dataProvider);

        $type = Cat::find()->select('type')->distinct()->all();
        $farm = Cat::find()->select('farm')->distinct()->all();
//        return Json::encode($farm);
        $count = 0;
        $session = new Session();
        if ($session['cart']) {
            $count = count($session['cart']);
        }
        return $this->render('sold', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => $type,
            'count' => $count,
            'farm' => $farm,
        ]);
    }


    public function actionCreate()
    {
        $length = 6;
        $chars = array_merge(range(0, 9));
        shuffle($chars);


        $password = implode(array_slice($chars, 0, $length));
        $model = new Cat();

        $model->pass = '#' . $password;
//        return Json::encode(\Yii::$app->request->post());
        if ($model->load(\Yii::$app->request->post())) {


            $model->video = UploadedFile::getInstances($model, 'video'); //upload หลายไฟล์ getInstances (เติม s)
            $model->video = '/uploads/files/' . $model->uploadFiles();
            if ($model->fa_image != null) {
                $model->fa_image_path = $model->fa_image['base_url'] . '/' . $model->fa_image['path'];
                $model->fa_image = $model->fa_image['name'];
//
            }
            if ($model->fa_ped_image != null) {
                $model->fa_ped_image_path = $model->fa_ped_image['base_url'] . '/' . $model->fa_ped_image['path'];
                $model->fa_ped_image = $model->fa_ped_image['name'];
            }
            if ($model->mo_image != null) {
                $model->mo_image_path = $model->mo_image['base_url'] . '/' . $model->mo_image['path'];
                $model->mo_image = $model->mo_image['name'];
            }
            if ($model->mo_ped_image != null) {
                $model->mo_ped_image_path = $model->mo_ped_image['base_url'] . '/' . $model->mo_ped_image['path'];
                $model->mo_ped_image = $model->mo_ped_image['name'];
            }
            if ($model->ped_image != null) {
                $model->ped_image_path = $model->ped_image['base_url'] . '/' . $model->ped_image['path'];
                $model->ped_image = $model->ped_image['name'];
            }
            if ($model->vaccine_image != null) {
                $model->vaccine_image_path = $model->vaccine_image['base_url'] . '/' . $model->vaccine_image['path'];
                $model->vaccine_image = $model->vaccine_image['name'];
            }
            if ($model->img_file != null) {
                $model->image_path = $model->img_file['base_url'] . '/' . $model->img_file['path'];
                $model->image = $model->img_file['name'];
            }


//            $model->status = User::STATUS_ACTIVE;


//            return Json::encode($model);
            if ($model->save()) {
                return $this->redirect('index');
            }
        }
        return $this->render('_form', [
            'model' => $model
        ]);
    }


    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('view', [
                'mode' => DetailView::MODE_VIEW,
                'model' => $model,
            ]);
        }
        return $this->render('view', [
            'mode' => DetailView::MODE_VIEW,
            'model' => $model,
        ]);
    }

    public function actionSell($id)
    {
        $model = $this->findModel($id);
        $idmodel = $model->find();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('sell', [
                'mode' => DetailView::MODE_VIEW,
                'model' => $model,
            ]);
        }
        return $this->render('sell', [
            'mode' => DetailView::MODE_VIEW,
            'model' => $model,
        ]);
//        return Json::encode($model);
    }

    public function actionConfirm($id)
    {
        $data = $this->findModel($id);
        $order = new Order();
        $order->cat_id = $data['id'];
        $order->cat_name = $data['name'];
        $order->cat_type = $data['type'];
        $order->age_cat = $data['age'];
        $order->price = $data['price'];



        if (Yii::$app->user->identity == null) {
//           return redirect('site/login');
            return $this->redirect(['site/login']);
        } else {
            $order->user_id = Yii::$app->user->identity->id;

            $order->user_name = Yii::$app->user->identity->name;
            $order->status = User::STATUS_ACTIVE;
            $order->date = date('Y-m-d');
            $order->status_delivery = User::STATUS_ACTIVE;
            $data->status = User::STATUS_NOT_ACTIVE;

            $data->save(false);
            $order->save(false);
//            return $data->save();
//            if ($order->save()) {
//                return Json::encode($order);
                $order_detail = new OrderDetail();

                $order_detail->created_at = date('Y-m-d H:I');
                $order_detail->cat_id = $data['id'];;
                $order_detail->order_id = $order->id;
                $order_detail->save(false);


//            }
            return $this->redirect('index');
        }


    }

    public function actionCheck()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('check', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDeli()
    {
//        return "deadas";
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('deli', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    protected function findModel1($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionPay($id)
    {
        $model = $this->findModel1($id);

        $model->img_name = "";
//        return Json::encode(Yii::$app->request->post('Order')['delivery']);
        if ($model->load(Yii::$app->request->post())) {

            if (Yii::$app->request->post('Order')['img_name'] != null) {
                $model->img_path = Yii::$app->request->post('Order')['img_name']['base_url'] . '/' . Yii::$app->request->post('Order')['img_name']['path'];
                $model->img_name = Yii::$app->request->post('Order')['img_name']['name'];
                $model->status = User::STATUS_DELETE;
                $model->delivery = Yii::$app->request->post('Order')['delivery'];
            }
            if ($model->save()) {
                return $this->redirect('check');
            }
        }
        $model_cat = Cat::getDetailNonStatic1($model->cat_id);

        return $this->render('pay', [
            'model' => $model,
            'model_cat' => $model_cat,
        ]);
    }

    public function actionNeat($id)
    {
        $model = $this->findModel1($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('neat', [
                'mode' => DetailView::MODE_VIEW,
                'model' => $model,
            ]);
        }
        return $this->render('neat', [
            'mode' => DetailView::MODE_VIEW,
            'model' => $model,
        ]);
    }

    public function actionDeletePay()
    {
        $id = Yii::$app->request->post('id');
        $model = Order::findOne($id);
        if (Yii::$app->request->isPost) {
            $model->status = "4";
            $model->update();
            Yii::$app->session->setFlash('success', 'User deleted successfully');
        } else {
            return $this->redirect(['cat/pay']);
        }
    }


    public function actionCart()
    {
        $id = Yii::$app->request->post('data_id');
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($id) {
            $session = new Session;
            $session->open();
            $temp = [];
            $cart = $session['cart'];
            if ($cart) {
                $temp = $cart;
                $index = array_search($id, $temp);
                if (!is_numeric($index)) {
                    array_push($temp, $id);
                    $session['cart'] = $temp;
                }
            } else {
                array_push($temp, $id);
                $session['cart'] = $temp;
            }
            $session->close();

            return ['status' => true, 'session' => Yii::$app->session];
        }


        return ['status' => false];
    }

    public function actionUpload($id)
    {

        $count = new Count();
        $count->user_id = Yii::$app->user->identity->id;
        $count->cat_id = $id;
        $count->save();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAjax()
    {
//        return "fwjio";
        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post('data_id');
            $model = $this->findModel($id);
            if ($model) {
                $model->delete();
                return Json::encode(['status' => true]);
            } else {
                return Json::encode(['status' => false]);
            }
        } else {
            return Json::encode(['status' => false]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Cat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $s = $model->video;
//        return Json::encode($s);

//        return Json::encode($model);
        $model->fa_image = "";
        $model->fa_ped_image = "";
        $model->mo_image = "";
        $model->mo_ped_image = "";
        $model->ped_image = "";
        $model->vaccine_image = "";
//        $model->video = "";



        if ($model->load(Yii::$app->request->post())) {

//            return Json::encode($model);
//            try {
//
//            }catch (Exception $e){
//
//            }


            $model->video = UploadedFile::getInstances($model, 'video'); //upload หลายไฟล์ getInstances (เติม s)
            if($model->video != null){
                $model->video = '/uploads/files/' . $model->uploadFiles();
            }else{
                $model->video = $s;
            }
//           return Json::encode($model->video);

//            $model->video = '/uploads/files/' . $model->uploadFiles();

            if ($model->fa_image != null) {
                $model->fa_image_path = $model->fa_image['base_url'] . '/' . $model->fa_image['path'];
                $model->fa_image = $model->fa_image['name'];
            }
            if ($model->fa_ped_image != null) {
                $model->fa_ped_image_path = $model->fa_ped_image['base_url'] . '/' . $model->fa_ped_image['path'];
                $model->fa_ped_image = $model->fa_ped_image['name'];
            }
            if ($model->mo_image != null) {
                $model->mo_image_path = $model->mo_image['base_url'] . '/' . $model->mo_image['path'];
                $model->mo_image = $model->mo_image['name'];
            }
            if ($model->mo_ped_image != null) {
                $model->mo_ped_image_path = $model->mo_ped_image['base_url'] . '/' . $model->mo_ped_image['path'];
                $model->mo_ped_image = $model->mo_ped_image['name'];
            }
            if ($model->ped_image != null) {
                $model->ped_image_path = $model->ped_image['base_url'] . '/' . $model->ped_image['path'];
                $model->ped_image = $model->ped_image['name'];
            }
            if ($model->vaccine_image != null) {
                $model->vaccine_image_path = $model->vaccine_image['base_url'] . '/' . $model->vaccine_image['path'];
                $model->vaccine_image = $model->vaccine_image['name'];
            }
            if ($model->img_file != null) {
                $model->image_path = $model->img_file['base_url'] . '/' . $model->img_file['path'];
                $model->image = $model->img_file['name'];
            }
//            return Json::encode($model);
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCard()
    {
        $searchModel = new CatSearch();
        $iduser = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
//        return Json::encode($dataProvider->createCommand()->rawSql);
        $count = 0;
        $session = new Session();
        if ($session['cart']) {
            $count = count($session['cart']);
        }
        return $this->render('card', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count,


        ]);
    }


    public function actionContact()
    {
        $cat = Cat::find()->where(['status' => '1'])->count();
        $cat_sell = Cat::find()->where(['status' => '0'])->count();
        $sum = Cat::find()->where(['status' => '0'])->sum('price');
        $sum1 = Cat::find()->sum('price');


        $data = Order::getDateForPlotChart();
        $data = Helper::convertArrayDate($data);
        $data_price = Order::getDataForSummaryRevenue();
//        return Json::encode($data_price);
//        $data1 = Order::getDataForSummaryRevenue();


        $average = $sum / $sum1;
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return Json::encode($data);
        return $this->render('contact', [
//            'model' => $model,
//            'amount' => Json::encode($colamount),
//            'date' => Json::encode($coldate),
            'cat' => $cat,
            'cat_sell' => $cat_sell,
            'sum' => $sum,
            'average' => $average,
            'data' => Json::encode($data),
//            'markers' => $markers,
            'data_price' => Json::encode($data_price),
        ]);
    }



    public function actionSale()
    {


        $cat = Cat::find()->where(['status' => '1'])->count();
        $cat_sell = Cat::find()->where(['status' => '0'])->count();
        $sum = Cat::find()->where(['status' => '0'])->sum('price');
        $sum1 = Cat::find()->sum('price');


        $data = Order::getDateForPlotChart();
        $data = Helper::convertArrayDate($data);
        $data_price = Order::getDataForSummaryRevenue();



        $average = $sum / $sum1;





        $currentDateTime = date('Y-m-d');
        $new_queue_start = date('Y-m-d H:i:s', strtotime($currentDateTime));

        $converse_queue_start = strtotime($new_queue_start); // เพื่อจะได้นำไป + - เวลาได้
        $queue_notification = date('Y-m-d H:i:s', strtotime('-30 days', $converse_queue_start));

        $uncat = Cat::getDateFarm($queue_notification);
//        $cc = $uncat->asarray()->all;
//        return Json::encode($uncat);
//


        return $this->render('sale', [
            'cat' => $cat,
            'cat_sell' => $cat_sell,
            'sum' => $sum,
            'average' => $average,
            'data' => Json::encode($data),
//            'markers' => $markers,
            'data_price' => Json::encode($data_price),
            'uncat' => $uncat,
        ]);
    }




    /* Switch status */
    public function actionStatus()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel1($id);
        $status = Yii::$app->request->post('status');
        $model->status = $status;
        return ($model->save());
    }
    public function actionDelivery()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel1($id);
        $status = Yii::$app->request->post('status');
        $model->status_delivery = $status;
        return ($model->save());
    }

    public function actionReview()
    {
        $searchModel = new OrderSearch();
        $model = Order::find()->asArray()->all();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('review', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,

        ]);

    }

    public function actionUpdatereview($id)
    {
        $model = $this->findModel1($id);
        $searchModel = new OrderSearch();


        $cat_image = $this->findModel($model->cat_id);

        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
//        return Json::encode(Yii::$app->request->post('Order')['review']);
        if ($model->load(Yii::$app->request->post())) {
            $model->review = Yii::$app->request->post('Order')['review'];
            $model->status_review = User::STATUS_ACTIVE;
            $model->save(false);
            return $this->render('review', [
                'mode' => DetailView::MODE_VIEW,
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,

            ]);
        }
        return $this->render('updatereview', [
            'mode' => DetailView::MODE_VIEW,
            'model' => $model,
            'cat_image' => $cat_image,
        ]);

    }

    protected function findModel2($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVaccine($id)
    {
        $datacat = Vaccine::find()->where(['cat_id' => $id])->asArray()->all();
//        return Json::encode($datacat);

        return $this->render('vaccine', [
            'datacat' => $datacat,
            'id' => $id,

        ]);

    }


}
