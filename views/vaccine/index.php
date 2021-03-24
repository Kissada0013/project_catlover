<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\VaccineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vaccines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vaccine-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vaccine', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name',


            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img($model->image_path, ['STYLE' => '', 'CLASS' => '']);
                },
            ],
            'created_at',
            'veterinary',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
