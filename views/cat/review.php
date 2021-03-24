<?php

use app\models\User;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);
?>


<style>
    .pay {
        border: 2px solid gray;
        color: gray;
        background-color: white;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 20px;
        font-weight: bold;
    }


    h4 {
        font-size: 32px;
        font-weight: 600;
    }

    .farm {
        font-size: 18px;
        font-weight: 600;
        /*color: #767676;*/
    }

    .award {
        border-radius: 15px;
        background: #e5e5e5;

    }

    .today {
        color: #3d495f;
        font-size: 16px;
        text-align: center;
    }

    .con {
        justify-items: end;
    }

    .detail {
        padding-top: 10px;
        justify-content: center;
    }

    .ans {
        cursor: pointer;
        position: relative;
        color: black;
        background: white;
        font-size: 16px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        transition: all 1s;
    }


</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="container1" style="margin: 0px 100px;font-size: 22px">
    <div class="container grid-flex site-contact" style="margin-top: 50px">
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 36px">
                รีวิวน้องแมว

            </div>

        </div>


    </div>

    <div class="test-index">


        <?=
        GridView::widget([
            'tableOptions' => [
                " border" => "none",
                'width' => '80%',
                'margin' => "20px",
                'cellspacing' => '0'
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
//                [
//                    'attribute' => 'img_path',
//                    'headerOptions' => ['style' => 'text-align: center;'],
//                    'format' => 'html',
//                    'mergeHeader' => true,
//                    'value' => function ($data) {
//                        if ($data->img_path == null) {
//                            return Html::img('/images/none.png', ['width' => '100%', 'height' => '120']);
//                        }
//                        return Html::img($data->img_path, ['width' => '150', 'height' => '120']);
//                    },
//                    'options' => ['style' => 'width:10%'],
//
//                ],

                [
                    'attribute' => 'cat_name',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'cat_type',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'user_name',

                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'review',

                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                    'value' => function ($data) {
                        return \app\models\Cat::getString($data->review);
                    },
                ],


                [
                    'attribute' => 'status_review',

                    'hAlign' => 'center',
                    'mergeHeader' => true,
                    'contentOptions' => [
                        'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                    ],
                    'options' => ['style' => 'width:10%'],
                    'value' => function ($model) {
                        return \app\models\User::typeIntToString($model->status_review);
                    }
                ],


                [
                    'class' => 'kartik\grid\ActionColumn',
                    'visible' => Yii::$app->user->can('User'),
                    'header' => 'ดำเนินการ',
                    'headerOptions' => ['style' => 'text-align: center;width:90px;min-width:150px;color:#337ab7'],
                    'template' => '<div class="btn-group btn-group-sm text-center" style="text-align: center; justify-content: center" role="group">{view} {update} {delete}</div>',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Yii::$app->user->can('Admin')
                                ? Html::a('<button class="button-eye-open"> <i class="glyphicon glyphicon-eye-open"></i></button>', ['neat', 'id' => $model->id], [
                                    'style' => 'margin:0px 3px'])
                                : '';
                        },

                        'update' => function ($url, $model, $key) {

                            return Html::a('<button class="button-pencil pay">Review</button>', ['updatereview', 'id' => $model->id], [
                                'style' => 'margin:0px 3px',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Yii::$app->user->can('Admin')
                                ? Html::a('<button class="button-trash"> <i class="glyphicon glyphicon-trash"></i></button>', 'javascript:;', [
                                    'class' => 'btn-delete-best',
                                    'data-id' => $model->id,
                                    'style' => 'margin:0px 3px',
                                ])
                                : '';
                        }
                    ],
                ],


            ]
        ])
        ?>


    </div>
</div>

