<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'cat_id',
        'age_cat',
        'price',
        'user_id',
        'created_at',
        'pickup_date',
        'status',
        [
            'attribute' => 'img_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->img_path);
            },
        ],


    ],
]) ?>


