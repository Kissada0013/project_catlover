<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */


?>
<div class="container1" style="margin: 0px 100px;font-size: 16px">
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ย้อนกลับ', ['index'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'username',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->username);
                },
            ],
            [
                'attribute' => 'title_name',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->title_name);
                },
            ],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->name);
                },
            ],
            [
                'attribute' => 'lastname',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->lastname);
                },
            ],
            [
                'attribute' => 'email',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->email);
                },
            ],
            [
                'attribute' => 'img_path',
                'format' => 'html',

                'value' => function ($data) {
                    if ($data->img_path == null) {
                        return Html::img('/images/none.png', ['width' => '100%', 'height' => '120']);
                    }
                    return Html::img($data->img_path, ['width' => '150', 'height' => '120']);
                },
            ],
            [
                'attribute' => 'address',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->address);
                },
            ],
            [
                'attribute' => 'tel',
                'value' => function ($data) {
                    return \app\models\Cat::getString($data->tel);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return \app\models\User::typeIntToString($data->status);
                },
            ],
        ],
    ]) ?>

</div>
</div>