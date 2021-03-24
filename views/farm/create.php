<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Farm */

$this->title = 'เพิ่มฟาร์ม';
?>
<div class="container1" style="margin: 0px 100px;font-size: 22px">
<div class="farm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>