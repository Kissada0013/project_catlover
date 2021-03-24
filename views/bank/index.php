<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บัญชี';
?>
<div class="container1" style="margin: 0px 100px;font-size: 22px">
<div class="bank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('เพิ่มบัญชี', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'name',
                'headerOptions' => ['style' => 'text-align: center;'],
                'mergeHeader' => true,
            ],
            [
                'attribute' => 'owner',
                'headerOptions' => ['style' => 'text-align: center;'],
                'mergeHeader' => true,
            ],
            [
                'attribute' => 'account',
                'headerOptions' => ['style' => 'text-align: center;'],
                'mergeHeader' => true,
            ],
//            [
//                'attribute' => 'status',
//                'headerOptions' => ['style' => 'text-align: center;'],
//                'mergeHeader' => true,
//            ],
            [
                'attribute' => 'status',
                'mergeHeader' => true,
                'value' => function ($data) {
                    return \app\models\User::typeIntToString($data->status);
                },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
</div>
