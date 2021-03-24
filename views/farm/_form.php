<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Farm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="farm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '999-9999999'
    ]); ?>

    <?= $form->field($model, 'email')->input('email') ?>

    <?= $form->field($model, 'address')->textarea(['rows' => '3']) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
