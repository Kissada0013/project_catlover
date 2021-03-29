<?php

use app\models\User;
use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\FramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ฟาร์ม';
?>
<div class="container1" style="margin: 0px 100px;font-size: 22px">
    <div class="farm-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?php if (Yii::$app->user->can('Admin')) { ?>
                <?= Html::a('เพิ่มฟาร์ม', ['create'], ['class' => 'btn btn-success']) ?>
            <?php } ?>
        </p>




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
                    'attribute' => 'name',
                    'headerOptions' => ['style' => 'text-align: center;'],

                ],
                [
                    'attribute' => 'owner',
                    'headerOptions' => ['style' => 'text-align: center;'],

                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'tel',
                    'headerOptions' => ['style' => 'text-align: center;'],

                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'email',
                    'headerOptions' => ['style' => 'text-align: center;'],

                    'mergeHeader' => true,
                ],
                [
                    'attribute' => 'address',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'mergeHeader' => true,
                ],

                [
                    'class' => 'kartik\grid\ActionColumn',
                    'visible' => Yii::$app->user->can('Admin'),
                    'header' => 'ดำเนินการ',
                    'headerOptions' => ['style' => 'text-align: center;width:90px;min-width:150px;color:#337ab7'],

                ],


            ]
        ])
        ?>






    </div>
</div>