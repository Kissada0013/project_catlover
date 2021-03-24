<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ques */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ques-form">

    <?php $form = ActiveForm::begin(); ?>



    <?php if ($model->text == null) { ?>
        <?= $form->field($model, 'text')->textarea(['rows' => '3','style' =>  'font-size : 26px'])->label('ข้อความ') ?>
    <?php } ?>

    <?php if ($model->text != null) { ?>
        <?= $form->field($model, 'text')->textarea(['rows' => '3','style' =>  'font-size : 26px'])->label('ข้อความ')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    <?php } ?>

    <?=
     (Yii::$app->user->can('Admin')) ?  $form->field($model, 'ans')->textarea(['rows' => '3','style' => 'font-size : 16px']):""
    ?>



    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
