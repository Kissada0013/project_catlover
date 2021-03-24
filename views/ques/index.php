<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);
?>
<div class="container1" style="margin: 0px 100px">


    <style>
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

        .ans{
            cursor:pointer;
            position:relative;
            color: black;
            background:white;
            font-size:16px;
            border-top-right-radius:10px;
            border-bottom-left-radius:10px;
            transition:all 1s;
        }





    </style>

    <div class="container1" style="margin-left: 200px ; margin-right: 200px;margin-bottom: 200px;font-size: 22px">

        <div class="container grid-flex site-contact" style="margin-top: 50px">
            <div class="grid-flex grid-flex-2">
                <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 36px">
                    คำถาม

                </div>

            </div>


        </div>

        <div style="margin-top: 20px;padding: 40px;height: 100%">
            <p>
                <?php if (Yii::$app->user->can('User')) { ?>
                    <?= Html::a('เพิ่มคำถาม', ['create'], ['class' => 'btn btn-success','style'=>'margin-bottom:20px']) ?>
                <?php } ?>
            </p>
            <?php
            foreach ($model as $data) {
                ?>


                <div style="font-size: 18px">
                    <?php
                    echo $data['text']
                    ?>
                    ?
                </div>
                <div>

                </div>


                <div class="grid-flex pt-2">


                    <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                        <div class="grid-flex grid-flex-1 grid-col">


                            <?php if (Yii::$app->user->can('Admin')) { ?>
                                <?=
                                Html::a('<button class="button-pencil ans">ตอบ</button>', ['update', 'id' => $data['id']], [
                                    'style' => [
                                        'margin' => '0px 3px',
                                        'width' => '5%',

                                    ],
                                ]);
                                ?>
                            <?php } ?>




                        </div>
                    </div>
                    <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                        <div class="  grid-flex grid-flex-1 grid-col">

                            <div style="text-align: end;font-size: 18px">
                                <?php
                                echo $data['ans']
                                ?>
                            </div>


                        </div>
                    </div>


                </div>


                <div style="font-size: 24px">
                    _____________________________________________________________________________________________
                </div>

            <?php } ?>
        </div>

    </div>



</div>
