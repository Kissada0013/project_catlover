<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Vaccine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vaccine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'veterinary')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'img_file')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
