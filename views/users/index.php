<?php

use app\models\User;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ลูกค้า';
?>
<div class="container1" style="margin: 0px 100px;font-size: 16px">
    <div class="user-index">

        <h1><?= Html::encode($this->title) ?></h1>


        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'username',
                    'headerOptions' => ['style' => 'text-align: center;'],

                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'title_name',

                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->title_name);
                    },
                ],
                [
                    'attribute' => 'name',
                    'contentOptions' => [
                        'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                    ],
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->name);
                    },

                ],
                [
                    'attribute' => 'lastname',
                    'contentOptions' => [
                        'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                    ],
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->lastname);
                    },

                ],
                [
                    'attribute' => 'email',
                    'contentOptions' => [
                        'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                    ],
                    'mergeHeader' => true,
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->email);
                    },
                ],
                [
                    'attribute' => 'img_path',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'format' => 'html',
                    'mergeHeader' => true,
                    'value' => function ($data) {
                        if ($data->img_path == null) {
                            return Html::img('/images/none.png', ['width' => '100%', 'height' => '120']);
                        }
                        return Html::img($data->img_path, ['width' => '150', 'height' => '120']);
                    },
                    'options' => ['style' => 'width:10%'],

                ],
                [
                    'attribute' => 'address',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->address);
                    },
                ],
                [
                    'attribute' => 'tel',
                    'headerOptions' => ['style' => 'text-align: center;width : 8%'],
                    'mergeHeader' => true,
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->tel);
                    },
                ],
                [
                    'attribute' => 'status',
                    'hAlign' => 'center',
                    'mergeHeader' => true,
                    'contentOptions' => [
                        'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                    ],
                    'options' => ['style' => 'width:10%'],
                    'value' => function ($model) {
                        return User::typeIntToString($model->status);
                    }
                ],


                //'pass',

                ['class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['style' => 'text-align: center;width:90px;min-width:50px'],
                    'contentOptions' => [
                        'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                    ],
                ],
            ],
        ]); ?>


    </div>
</div>