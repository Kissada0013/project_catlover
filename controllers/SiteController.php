<?php

namespace app\controllers;

use app\helper\Helper;
use app\models\Cat;
use app\models\Count;
use app\models\Order;
use app\models\User;
use kartik\detail\DetailView;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use dosamigos\google\maps\LatLng;
use function Symfony\Component\String\s;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ('Admin'),
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
//        return Json::encode(User::findByUsername('user'));
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if (Yii::$app->request->isPost) {
            Yii::$app->request->post();
        }

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('Admin')) {
                return $this->redirect(['cat/index']);
            } else {
                return $this->redirect(['cat/index']);
            }

        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    public function actionUpdate()
    {


        $model = Yii::$app->user->identity;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('update', [
                'mode' => DetailView::MODE_VIEW,
                'model' => $model,
            ]);

        }
        return $this->render('update', [
            'mode' => DetailView::MODE_VIEW,
            'model' => $model,
        ]);


//        $model = $this->findModel($id);
//        if ($model->load(Yii::$app->request->post())) {
////            return Json::encode([$model->validate(),$model]);
//            try {
//                $model->save();
////                return Json::encode([$model->validate(),$model]);
//                return $this->render('view', [
//                    'mode' => DetailView::MODE_VIEW,
//                    'model' => $model,
//                ]);
//            } catch (\Exception $e) {
//                return Json::encode([$model->errors, $e->getMessage()]);
//            }
//
//        }
//
//
//        return $this->render('view', [
//            'mode' => DetailView::MODE_EDIT,
//            'model' => $model,
//        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();

        $markers = [];

//กำหนดพิกัดในประเทศไทยเป็นตัวอย่าง
        $min_lat = 8;
        $max_lat = 19;
        $min_long = 98;
        $max_long = 105;

        for ($i = 1; $i <= 50; $i++) {

//            $markers[] = ['place' => 'ทดสอบ '.$i, 'lat_long' => new LatLng(['lat' => rand(($min_lat)*($i/10), ($max_lat)*($i/10)), 'lng' => rand(($min_long)*($i/10), ($max_long)*($i/10))])];
            $markers[] = ['place' => 'ทดสอบ ' . $i, 'lat_long' => new LatLng(['lat' => rand(($min_lat) . "." . rand(199999, 999999), ($max_lat) . "." . rand(199999, 999999)), 'lng' => rand(($min_long) . "." . rand(19999, 99999), ($max_long) . "." . rand(19999, 99999))])];
        }
        $datacat = Count::find()->select(['count(id) as amount', 'DATE_FORMAT([[created_at]], "%d/%m/%Y") as date'])->groupBy('created_at')->asArray()->all();
        $data = Count::find()->asArray()->all();
        $cat = Cat::find()->where(['status' => '1'])->count();
        $cat_sell = Cat::find()->where(['status' => '0'])->count();
//        return Json::encode($data);
        $colamount = ArrayHelper::getColumn($datacat, 'amount');
        $coldate = ArrayHelper::getColumn($datacat, 'date');
        $sum = Cat::find()->where(['status' => '0'])->sum('price');
        $sum1 = Cat::find()->sum('price');

        $data = Order::getDateForPlotChart();
        $data = Helper::convertArrayDate($data);

        $data_price = Order::getDataForSummaryRevenue();

//        $data1 = Order::getDataForSummaryRevenue();
//        return Json::encode($markers);

        $average = $sum / $sum1;
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
//        return Json::encode($data);
        return $this->render('contact', [
            'model' => $model,
            'amount' => Json::encode($colamount),
            'date' => Json::encode($coldate),
            'cat' => $cat,
            'cat_sell' => $cat_sell,
            'sum' => $sum,
            'average' => $average,
            'data' => Json::encode($data),
            'markers' => $markers,
            'data_price' => Json::encode($data_price),
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTest()
    {
        $model = Cat::find()->asArray()->all();
        return $this->render('test', [

            'model' => $model,
        ]);
    }

    public function actionRegister()
    {

        $model = new User();
        //            return Json::encode($model);

        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->status = User::STATUS_ACTIVE;
            $model->pass = '@' . Yii::$app->security->generateRandomString(6);

            if ($model->save()) {
                $auth = \Yii::$app->authManager;
                $authorRole = $auth->getRole('User');
                $auth->assign($authorRole, $model->getId());
                return $this->redirect(['login']);
            }
            return $this->redirect(['register']);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionView()
    {

        $model = Yii::$app->user->identity;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('update', [
                'mode' => DetailView::MODE_VIEW,
                'model' => $model,
            ]);

        }
        return $this->render('update', [
            'mode' => DetailView::MODE_VIEW,
            'model' => $model,
        ]);

    }

    public function actionGraph()
    {
        $model = new ContactForm();
        $datacat = Count::find()->select(['count(id) as amount', 'DATE_FORMAT([[created_at]], "%d/%m/%Y") as date'])->groupBy('created_at')->asArray()->all();
        $data = Count::find()->asArray()->all();
        $cat = Cat::find()->where(['status' => '1'])->count();
        $cat_sell = Cat::find()->where(['status' => '0'])->count();
//        return Json::encode($data);
        $colamount = ArrayHelper::getColumn($datacat, 'amount');
        $coldate = ArrayHelper::getColumn($datacat, 'date');
        $sum = Cat::find()->where(['status' => '0'])->sum('price');
        $sum1 = Cat::find()->sum('price');

        $data = Order::getDateForPlotChart();
        $data = Helper::convertArrayDate($data);

        $data_price = Order::getDataForSummaryRevenue();

//        $data1 = Order::getDataForSummaryRevenue();
        $markers = [];

//กำหนดพิกัดในประเทศไทยเป็นตัวอย่าง
        $min_lat = 8;
        $max_lat = 19;
        $min_long = 98;
        $max_long = 105;

        for ($i = 1; $i <= 50; $i++) {

//            $markers[] = ['place' => 'ทดสอบ '.$i, 'lat_long' => new LatLng(['lat' => rand(($min_lat)*($i/10), ($max_lat)*($i/10)), 'lng' => rand(($min_long)*($i/10), ($max_long)*($i/10))])];
            $markers[] = ['place' => 'ทดสอบ ' . $i, 'lat_long' => new LatLng(['lat' => rand(($min_lat) . "." . rand(199999, 999999), ($max_lat) . "." . rand(199999, 999999)), 'lng' => rand(($min_long) . "." . rand(19999, 99999), ($max_long) . "." . rand(19999, 99999))])];
        }

        $average = $sum / $sum1;
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('graph', [
            'model' => $model,
            'amount' => Json::encode($colamount),
            'date' => Json::encode($coldate),
            'cat' => $cat,
            'cat_sell' => $cat_sell,
            'sum' => $sum,
            'average' => $average,
            'data' => Json::encode($data),
            'markers' => $markers,
            'data_price' => Json::encode($data_price),
        ]);


    }


}
