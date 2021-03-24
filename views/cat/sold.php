<?php

use app\models\Cat;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use richardfan\widget\JSRegister;
use yii\web\JqueryAsset;
use kartik\select2\Select2;
use app\helper\Helper;
use yii\widgets\ListView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('@web/js/main.js', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/cat.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);

//$this->title = 'Cats';
//$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .button {
        right: 30px;
        position: fixed;
        bottom: 80px;
        height: 100px;
        width: 120px;
        border: none;
        background: #92e2fa4d;
        border-radius: 10%;

    }

    .buy {
        background: white;
        width: 100%;
        height: 40px;
        border: 2px solid #e7e7e7;
    }

    .buy:hover {
        background: #e7e7e7;
    }

    .glyphicon.glyphicon-shopping-cart {
        font-size: 20px;

    }


    .count-row-cart {
        position: absolute;
        background: #00ffb8;
        border-radius: 50%;
        font-size: 20px;
        bottom: 50px;
        width: 30px;
        height: 30px;
        margin-bottom: 25px;
        margin-left: 20px;
    }


    .btn-type {
        width: 90%;
        text-align: left;
        margin-bottom: 3px;
        background: white;

    }
</style>


<div class="container1" style="margin-left: 200px ; margin-right: 200px;margin-bottom: 200px;font-size: 22px">

    <div class="container grid-flex site-contact" style="margin-top: 50px">
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 36px">
                น้องแมวที่ขายแล้ว

            </div>

        </div>


    </div>
    <p style="margin-top: 20px;margin-left: 64px">
        <?= Html::a('ย้อนกลับ', ['cat/index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <div class="grid-flex grid-flex-3" style="background-color: white">

    <?=   ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => 'card1',
                'layout' => '<div class="none-sum">{items}</div>',
            ])

     ?>

    </div>


</div>
