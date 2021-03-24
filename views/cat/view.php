<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'type',
        'father',
        [
            'attribute' => 'fa_image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->fa_image_path);
            },
        ],
        [
            'attribute' => 'fa_ped_image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->fa_ped_image_path);
            },
        ],
        'mother',
        [
            'attribute' => 'mo_image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->mo_image_path);
            },
        ],
        [
            'attribute' => 'mo_ped_image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->mo_ped_image_path);
            },
        ],
        [
            'attribute' => 'ped_image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->ped_image_path);
            },
        ],
        'farm',
        'age',
        'gender',
        'birthday_farm',
        'birthday',
        'weight',
        'color',
        'pattern',
        'blame',
        'special',
        'vaccine',
        [
            'attribute' => 'vaccine_image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->vaccine_image_path);
            },
        ],
        'vaccine_day',
        'veterinary',
        [
            'attribute' => 'image_path',
            'format' => 'html',
            'value' => function ($data) {
                return Html::img($data->image_path);
            },
        ],
        'food',
        'cost_price',
        'price',

    ],
]) ?>


