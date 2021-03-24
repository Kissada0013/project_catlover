<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<style>
    .item1 {
        height: 450px;
        width: 20%;
        display: flex;
        justify-content: center;
        font-size: 24px;
        align-items: center;
        /*margin: 40px 10px;*/
        border-radius: 10px;
        margin-top: 50px;




        border: 5px solid transparent;
        background-origin: border-box;
        background-clip: padding-box, border-box;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        border: double 4px transparent;
    }
    .form-control{
        width: 300%;
        margin-left: -75px;

    }
    .help-block{
        font-size: 16px;
    }
    .body{
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url("/image/cat123.png");
    }

</style>
<body class="body">
<div class="grid-flex site-contact" style="display: flex; justify-content: center;  align-items: center;">
    <div class="grid-flex item1" style=" background: rgba(255, 255, 255, 0.8);align-content: center;">

        <div class="grid-flex" style="text-align: center;margin-top: -65px;font-size: 36px;font-family: 'Indie Flower', cursive;"> Cat lover</div>
        <div class="grid-flex" style="text-align: center;font-size: 36px;font-family: 'Indie Flower', cursive;"> Login</div>
        <div class="grid-flex grid-flex-1 justify-content-center" style="padding-top: 30px">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
            ]); ?>

            <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => "username"]) ?>


            <?= $form->field($model, 'password')->label(false)->passwordInput(['placeholder' => "password"]) ?>


            <div class="form-group" style="padding-top: 20px">
                <div class="grid-flex-1" style="margin-left: 25px;padding-right: 10px">
                    <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::a('สมัครสมาชิก', ['users/create'], ['class' => 'btn btn-success']) ?>
                </div>

            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>
</body>


