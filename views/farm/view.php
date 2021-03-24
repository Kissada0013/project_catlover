<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Farm */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="container1" style="margin: 0px 100px;font-size: 22px">
<div class="farm-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('ย้อนกลับ', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->name);
                },
            ],
            [
                'attribute' => 'owner',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->owner);
                },
            ],
            [
                'attribute' => 'tel',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->tel);
                },
            ],
            [
                'attribute' => 'email',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->email);
                },
            ],
            [
                'attribute' => 'address',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->address);
                },
            ],

        ],
    ]) ?>

</div>
</div>