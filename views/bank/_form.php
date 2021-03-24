<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '999-9-99999-9'
    ]); ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => ['1' => 'ใช้งาน', '2' => 'ไม่ได้ใช้งาน'],
        'options' => ['placeholder' => 'Select a state ...'],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
