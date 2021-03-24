<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);

?>


<style>
    h4 {
        font-size: 32px;

    }

    /*.farm {*/
    /*    font-size: 18px;*/
    /*    font-weight: 600;*/
    /*    !*color: #767676;*!*/
    /*}*/

    .award {
        border-radius: 15px;
        background: #e5e5e5;

    }

    .today {
        color: #3d495f;
        font-size: 16px;
        text-align: center;
    }

    .con {
        justify-items: end;
    }

    .detail {
        padding-top: 10px;
        justify-content: center;
    }
</style>
<div class="container1" style="margin: 0px 600px">


    <?php $form = ActiveForm::begin(); ?>


    <div class="container grid-flex site-contact" style="margin-top: 50px">
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 22px">
                โปรไฟล์

            </div>

        </div>


    </div>


    <div class="container grid-flex site-contact" style="margin-top: 50px">
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center">
                <img class="image-cat" src="<?= $model->img_path ?>">

            </div>

        </div>


    </div>

    <div style="padding: 40px;height: 520px">

        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-2">
                <div class="award1  grid-flex">

                    <div class="today" style="font-weight: 900;font-size: 18px">ชื่อผู้ใช้งาน</div>

                    <div style="padding-left: 20px">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => true])->label(false) ?>
                    </div>

                </div>


            </div>


        </div>


        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-2">
                <div class="award1  grid-flex">

                    <div class="today" style="font-weight: 900;font-size: 18px">คำนำหน้า</div>

                    <div style="padding-left: 33px;width: 18%">
                        <?= $form->field($model, 'title_name')->textInput(['maxlength' => true])->label(false) ?>
                    </div>

                </div>


            </div>


        </div>


        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 18px">ชื่อ</div>

                    <div style="padding-left: 84px">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
                    </div>


                </div>


            </div>
            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">


                    <div class="today" style="font-weight: 900;padding-left: 25px;font-size: 18px">นามสกุล</div>

                    <div style="padding-left: 20px">
                        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label(false) ?>
                    </div>


                </div>


            </div>


        </div>

        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 18px">เบอร์โทร</div>

                    <div style="padding-left: 39px">
                        <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '999-9999999'
                        ]); ?>
                    </div>


                </div>


            </div>


        </div>

        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 18px">อีเมล</div>

                    <div style="padding-left: 68px">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
                    </div>


                </div>


            </div>


        </div>

        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 18px">ที่อยู่</div>

                    <div style="padding-left: 68px">
                        <?= $form->field($model, 'address')->textarea(['rows' => '3'])->label(false) ?>
                    </div>


                </div>


            </div>


        </div>


    </div>


    <div class="form-group" style="margin-bottom: 20px;text-align: center;justify-items: center;justify-content: center">
        <?= Html::submitButton('ยืนยัน', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
