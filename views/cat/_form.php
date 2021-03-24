<?php

use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use kartik\widgets\FileInput;
use trntv\filekit\widget\Upload;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;

$form = ActiveForm::begin([
    'id' => 'login-form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data']


]);
?>
<div style="margin-left: -150px;padding-right: 200px">


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'father') ?>





    <?= $form->field($model, 'video[]')->fileInput(['multiple' => true,]) ?>



    <?= $form->field($model, 'fa_image')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>

    <?= $form->field($model, 'fa_ped_image')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>

    <?= $form->field($model, 'mother') ?>

    <?= $form->field($model, 'mo_image')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>

    <?= $form->field($model, 'mo_ped_image')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>

    <?= $form->field($model, 'ped_image')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>


    <?= $form->field($model, 'farm')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\Farm::allDataFarm(), 'name', 'name'),

        'options' => ['placeholder' => 'Select a state ...'],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]);
    ?>

    <?= $form->field($model, 'age') ?>



    <?= $form->field($model, 'gender')->widget(Select2::classname(), [
        'data' => ['1' => 'ผู้', '2' => 'เมีย'],

        'options' => ['placeholder' => 'Select a state ...'],
        'hideSearch' => true,
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]); ?>

    <?= $form->field($model, 'birthday_farm')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'readonly' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($model, 'birthday')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'readonly' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'autoclose' => true
        ]
    ]); ?>



    <?= $form->field($model, 'weight') ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'pattern') ?>

    <?= $form->field($model, 'blame', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']])->textInput(['placeholder' => "ถ้ามี"]) ?>

    <?= $form->field($model, 'special', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control transparent']])->textInput(['placeholder' => "ถ้ามี"]) ?>

    <?= $form->field($model, 'vaccine') ?>

    <?= $form->field($model, 'vaccine_image')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>

    <?= $form->field($model, 'vaccine_day')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'readonly' => true,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'autoclose' => true
        ]
    ]); ?>

    <?= $form->field($model, 'veterinary') ?>

    <?= $form->field($model, 'img_file')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>


    <!--video-->
    <?= $form->field($model, 'food') ?>

    <?= $form->field($model, 'cost_price') ?>

    <?= $form->field($model, 'price') ?>



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
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            <?= Html::resetButton('ล้างฟาร์ม', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
