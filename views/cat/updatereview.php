<?php

use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use kartik\widgets\FileInput;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\JsExpression;

$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);
$form = ActiveForm::begin([
    'id' => 'login-form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data']
]);
?>


    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            text-align: center;

            width: 30%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>


    <div class="container1" style="margin: 0px 200px;font-size: 22px">
        <div class="container grid-flex site-contact" style="margin-top: 50px">
            <div class="grid-flex grid-flex-2">
                <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 36px">
                    รีวิว

                </div>

            </div>


        </div>
        <div id="myModal" class="modal">
            <img class="modal-content" id="img01">

            <div id="caption"></div>
        </div>


        <div class="container" style="border: 1px solid black; width: 30%">


            <div class="container grid-flex site-contact" style="padding-top: 10px">


                <div class="grid-flex grid-flex-2" style="justify-content: center">

                    <img class="image-cat" style="width: 195px;" src="<?=  $cat_image->image_path ?>">
                </div>


            </div>


            <div class="container grid-flex site-contact" style="margin-top: 5%">


                <div class="grid-flex grid-flex-1" style="justify-content: center">

                    <table style="width: 80%">
                        <tr>
                            <th>ชื่อ</th>
                            <td><?= $model->cat_name ?></td>
                        </tr>

                        <tr>
                            <th>ราคา</th>
                            <td><?= $model->price ?></td>
                        </tr>
                        <tr>
                            <th>พันธุ์</th>
                            <td><?= $model->cat_type ?></td>
                        </tr>



                    </table>


                </div>


            </div>


            <label style="padding-left: 45px;padding-top: 24px">ข้อความรีวิว</label>

            <div style="margin-top: 20px;margin-left: 45px;width: 110%">
                <?= $form->field($model, 'review')->textarea(['rows' => '3'])->label(false) ?>

            </div>


<!--            ->label(false)-->






            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                    <?= Html::a('ย้อนกลับ', ['review' ], ['class' => 'btn con  btn-primary']); ?>
                </div>
            </div>

        </div>



    </div>


<?php ActiveForm::end(); ?>