<?php

namespace app\controllers;

use app\helper\Helper;
use app\models\Cat;
use app\models\Order;
use app\models\search\CatSearch;
use Yii;
use app\models\Test;
use app\models\search\TestSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
//        $data = Order::getDataForSummaryRevenue();
////        $count = count($datax['2020']);
////        return Json::encode($data);
//        return $this->render('view', [
//            'data' => $data,
//        ]);


        $data = Order::getDateForPlotChart();
        $data = Helper::convertArrayDate($data);

        return $this->render('view', [
            'data' => Json::encode($data),
        ]);
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionShowData($id){
        $data = new Test();
        $data->id= $id;
        return Json::encode($data->getDetailNonStatic());
    }


    public function actionTest(){
//        $data = Order::getDateForPlotChart();
//        $data = Helper::convertArrayDate($data);
////        return Json::encode($data);
//        $data = Order::getDataForSummaryRevenue();
////        $cat = Cat::find()->asArray()->all();
//        $cat = Cat::find()->select('id')->all();
////        return Json::encode($cat);
////        return Json::encode($data);
//        return $this->render('test', [
//            'data' => Json::encode($data),
//            'cat' => Json::encode($cat),
//
//        ]);





        $searchModel = new CatSearch();

//        $iduser = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return Json::encode($dataProvider);



        $cat = Cat::find()->asArray()->all();
        $count = 0;

        $session = new Session();
        if($session['cart']){
            $count = count($session['cart']);
        }

        return $this->render('test', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'count' => $count,

        ]);



    }

    public function actionCard(){
        $searchModel = new CatSearch();

        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);



        return $this->render('card', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,


        ]);



    }



}

