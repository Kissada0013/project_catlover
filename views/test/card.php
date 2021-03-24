<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('@web/css/card.css', ['depends' => [JqueryAsset::className()]]);

?>
    <div class="flex">
        <div class="cardcat">

        </div>
    </div>