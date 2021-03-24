<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<style>



    .form-control {
        width: 100%;


    }

    .help-block {
        font-size: 16px;
    }

    .body {
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url("/image/cat123.png");
    }

</style>
<body class="body">


<div class="grid-flex site-contact" style="display: flex; justify-content: center;  align-items: center;">
    <div class="grid-flex"
         style=" background: rgba(255, 255, 255, 0.9);align-content: center;border-radius: 10px;width: 50%;display: flex;padding: 20px 30px;margin-bottom: 20px;flex-direction: column;">

        <div class="grid-flex" style="text-align: center;font-size: 36px;font-family: 'Indie Flower', cursive;"> Cat lover</div>
        <div class="grid-flex" style="text-align: center;font-size: 36px;font-family: 'Indie Flower', cursive;"> Register</div>
        <div>
            <?php $form = ActiveForm::begin(); ?>


            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?php if ($model->password_hash == null) { ?>
                <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
            <?php } ?>
            


            <?= $form->field($model, 'title_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->input('email') ?>

            <?= $form->field($model, 'image')->widget(Upload::classname(), [
                'url' => ['avatar-upload'],
                'maxFileSize' => 5 * 1024 * 1024,
                'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
            ]) ?>




            <?= $form->field($model, 'address')->textarea(['rows' => '3']) ?>

            <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '999-9999999'
            ]); ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>


            <?php ActiveForm::end(); ?>
        </div>


    </div>

</div>
</body>
