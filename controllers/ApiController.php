<?php


namespace app\controllers;
use app\models\Cat;
use app\models\LoginForm;
use app\models\search\CatSearch;
use app\models\User;
use Yii;
use yii\base\Response;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post'],
                ],
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', 'GET'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Content-Type' => 'application/json;charset=UTF-8'
                ],

            ],
        ];
    }

    public function actionCollection()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        try {
            $cat = Cat::find()->asArray()->all();
            return $cat;
        } catch (Exception $exception) {
        }

    }

    public function actionLogin()
    {


        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

//        return Yii::$app->request->post();

        if (\Yii::$app->request->isGet) {
            \Yii::$app->response->statusCode = 401;
            return ['success' => false, 'errorMassage' => 'Not...'];
        }

        $raw_data = Json::decode(\Yii::$app->request->getRawBody());

        if ($raw_data) {


            $model = new LoginForm();
            $model->username = $raw_data['username'];
            $model->password = $raw_data['password'];
            if ($model->login()) {
                return ['success' => true, 'data' => User::getUserData(Yii::$app->user->id), 'token' => \Yii::$app->user->identity->getAuthKey()];
            } else {
                Yii::$app->response->statusCode = 401;
                return ['success' => false, 'errorMassage' => 'Not...'];
            }
        } else {
            Yii::$app->response->statusCode = 401;
            return ['success' => false, 'errorMassage' => 'empty data'];
        }
    }

    public function actionDatacat()
    {
        $cat = Cat::find()->asArray()->all();
//        $cat = Cat::find()->select('id')->all();
        return Json::encode($cat);
    }

    public function actionCreate()
    {

        $model = new Cat();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $length = 6;
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));
        $raw_data = \Yii::$app->request->post();

        if ($raw_data) {
            $usercat = [];
            foreach ($raw_data as $key => $data) {
                $usercat['Cat'][$key] = $data;
            }
            $usercat['Cat']['status'] = 1;
//            $model->pass = '#' . $password;
            $usercat['Cat']['pass'] = '#' . $password;
//            return $usercat;
            $model->load($usercat);
            $file = $_FILES['image_path'];




            $model->image_path = '/uploads/1/' . $file['name'];


            if (move_uploaded_file($file['tmp_name'], '../web/uploads/1/' . $file['name'])) {
                $model->save();
                return $model;
            } else {
                return $model->errors;
            }
        }
    }
}