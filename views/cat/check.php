<?php

use app\models\Cat;
use app\models\User;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use richardfan\widget\JSRegister;
use yii\web\JqueryAsset;
use kartik\select2\Select2;
use app\helper\Helper;
use yii\widgets\ListView;


/* @var $searchModel app\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'ข้อมูลการซื้อ';
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

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>








    <div class="container1" style="margin: 0px 100px;font-size: 22px">

        <div class="test-index">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php Pjax::begin([
                'id' => 'pjax-estab',
                'timeout' => false,
            ]); ?>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'test-form'
                ]
            );

            ActiveForm::end(); ?>


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
                        'attribute' => 'id',

                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->id);
                        },
                    ],
                    [
                        'attribute' => 'cat_id',

                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->cat_id);
                        },
                    ],
                    [
                        'attribute' => 'user_name',

                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->user_name);
                        },
                    ],
                    [
                        'attribute' => 'cat_name',

                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->cat_name);
                        },
                    ],
                    [
                        'attribute' => 'age_cat',

                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->age_cat);
                        },
                    ],
                    [
                        'attribute' => 'price',
                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->price);
                        },

                    ],

                    [
                        'attribute' => 'date',
                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return Helper::changeDateToDateThai($data->date);
                        },
                    ],
                    [
                        'attribute' => 'pickup_date',
                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {

                            return $data->pickup_date ?  Helper::changeDateToDateThai($data->pickup_date) : "-";
                        },
                    ],

                    [
                        'attribute' => 'delivery',
                        'headerOptions' => ['style' => 'text-align: center;'],
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return \app\models\Cat::getString($data->delivery);
                        },
                    ],

                    [
                        'visible' => Yii::$app->user->can('Admin'),
                        'attribute' => 'status',
                        'mergeHeader' => true,
                        'format' => 'raw',
                        'hAlign' => 'center',

                        'contentOptions' => [
                            'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                        ],
                        'options' => ['style' => 'width:14%'],

                        'value' => function ($model) {
                            if ($model->status == 2) {
                                return '<label style="color: #e4b816;
    background: #f3f9944a;
    border: 1px solid;
    width: 45%;
    padding: 0px 5px;
     border-radius: 5px;">'. \app\models\Order::typeIntToString($model->status) .' </label>
                             
                            ';
                            } else if($model->status == 1) {
                                return '<label style="    color: #b1b1b1;
    /* color: green; */
    /* color: #e4b816; */
    background: #fbfbfb;
    border: 1px solid;
    width: 45%;
    padding: 0px 5px;
    border-radius: 5px;">'. \app\models\Order::typeIntToString($model->status) .' </label>
                             
                            ';
                            }else{
                                return '<label style="color: #11a489;
    background: #11a48914;
    border: 1px solid;
    width: 45%;
    padding: 0px 5px;
    border-radius: 5px;">'. \app\models\Order::typeIntToString($model->status) .' </label>
                             
                            ';
                            }
                        },
                    ],

                    [
                        'visible' => Yii::$app->user->can('Admin'),
                        'attribute' => 'status',
                        'mergeHeader' => true,
                        'format' => 'raw',
                        'hAlign' => 'center',
                        'contentOptions' => [
                            'class' => 'kv-align-center w0 kv-align-middle w0' //align & justify center
                        ],
                        'options' => ['style' => 'width:5%'],
                        'value' => function ($model) {
                            if ($model->status == User::STATUS_NOT_ACTIVE) {
                                return ' <input id="check-status" type="checkbox" checked data-toggle="toggle" data-index="' . $model->id . '" data-status="2"/>
                             
                            ';
                            } else {
                                return '<input id="check-status" type="checkbox" data-toggle="toggle" data-index="' . $model->id . '" data-status="0" />';
                            }
                        },
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'visible' => Yii::$app->user->can('User'),

                        'header' => 'หลักฐานการโอน',
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

                                return Html::a('<button class="button-pencil pay">upload</button>', ['pay', 'id' => $model->id], [
                                    'style' => 'margin:0px 3px',
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return

                                    Yii::$app->user->can('Admin')
                                        ? Html::a('<button class="button-trash"> <i class="glyphicon glyphicon-trash"></i></button>', 'javascript:;', [
                                        'class' => 'btn-delete-best',
                                        'data-id' => $model->id,
                                        'style' => 'margin:0px 3px',
                                    ])
                                        : '';


                            }
                        ],
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

                                return Yii::$app->user->can('Admin')
                                    ?   Html::a('<button class="button-pencil pay">upload</button>', ['pay', 'id' => $model->id], [
                                        'style' => 'margin:0px 3px'])
                                    : '';
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<button class="button-trash pay"> <i class="glyphicon glyphicon-trash"></i></button>', 'javascript:;', [
                                    'class' => 'btn-delete-best',
                                    'data-id' => $model->id,
                                    'style' => 'margin:0px 3px',
                                ]);

                            }
                        ],
                    ],



                ]
            ])
            ?>
            <?php Pjax::end() ?>

        </div>
    </div>
<?php JSRegister::begin(); ?>
    <script>


        $(document).delegate('#test-form', 'submit', function (e) {
            e.preventDefault()
            let this_value = $('#ordersearch-search').val();
            console.log(this_value)
            // let url = updateQueryStringParameter(window.location.href, 'ordersearch', this_value);
            let url = "http://localhost:8080/cat/check?search=" + this_value;
            console.log(url)
            $.pjax.reload({container: '#pjax-estab', url: url, 'timeout': 5000, async: false});
        })


        const showLoading = function () {
            Swal.fire({
                title: 'Now loading',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timer: 4000,
                didOpen: function () {
                    Swal.showLoading();
                }
            })
        }

        $(document).delegate('.btn-delete-best', 'click', function (e) {
            let data_id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: '/cat/delete-pay',
                        data: {
                            csrf: _csrf,
                            id: data_id,

                        },
                        complete: function () {
                            showLoading()
                            $.pjax.reload({
                                container: '#pjax-estab',
                                'timeout': 4000,
                            }).done(function () {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            })

                        }
                    })

                }
            })
        })
        $(document).delegate('.toggle', 'click', function () {
            let id = $(this).find('input:checkbox').attr('data-index')
            let status = $(this).find('input:checkbox').attr('data-status')
            if ($(this).find('input:checkbox').attr('data-status') == "1") {
                $(this).find('input:checkbox').attr('data-status', '0')
                $.ajax({
                    type: 'POST',
                    data: {
                        'id': id,
                        'status': status,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: '/cat/status',
                    dataType: 'json',
                    encode: true,
                    complete: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลเสร็จสิ้น',
                            position: 'top',
                            allowOutsideClick: false
                            // footer: '<a href>Why do I have this issue?</a>'
                        }).then(function () {
                            location.reload()
                        })
                        // $.pjax.reload({
                        //     container: '#pjax-estab',
                        //     'timeout': 4000,
                        // })
                    },
                    failure: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'มีบางอย่างผิดพลาด!',
                            // footer: '<a href>Why do I have this issue?</a>'
                        })
                    }
                });
                $(this).removeAttr('checked')
                console.log('off')
            } else {
                $(this).find('input:checkbox').attr('data-status', '1')
                $.ajax({
                    type: 'POST',
                    data: {
                        'id': id,
                        'status': status,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: '/cat/status',
                    dataType: 'json',
                    encode: true,
                    complete: function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลเสร็จสิ้น',
                            position: 'top',
                            allowOutsideClick: false
                            // footer: '<a href>Why do I have this issue?</a>'
                        }).then(function () {
                            location.reload()
                        })

                        // $.pjax.reload({
                        //     container: '#pjax-estab',
                        //     'timeout': 4000,
                        // })
                    },
                    failure: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'มีบางอย่างผิดพลาด!',
                            // footer: '<a href>Why do I have this issue?</a>'
                        })
                    }
                });
                console.log('on')
            }

        })

    </script>
<?php JSRegister::end(); ?>