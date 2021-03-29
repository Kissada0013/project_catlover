<?php

use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use kartik\widgets\FileInput;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\DetailView;
use yii\web\JsExpression;


$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);
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


    <div class="container1" style="margin: 0px 200px">
<!--    <div id="myModal" class="modal">-->
<!--        <span class="close">&times;</span>-->
<!--        <img class="modal-content" id="img01">-->
<!---->
<!--        <div id="caption"></div>-->
<!--    </div>-->


    <div class="" style="border: 1px solid black; width: 30%;margin-left: 36%">

        <div class=" grid-flex site-contact" style="padding-top: 10px">

            <div class="grid-flex grid-flex-2" style="justify-content: center">

                <img class="image-cat" style="width: 195px;" src="<?= $model_cat->image_path ?>">
            </div>


        </div>

        <div class=" grid-flex site-contact" style="margin-top: 5%">


            <div class="grid-flex grid-flex-1" style="justify-content: center">

                <table style="width: 80%">
                    <tr>
                        <th>ชื่อ</th>
                        <td><?= $model_cat->name ?></td>
                    </tr>

                    <tr>
                        <th>ราคา</th>
                        <td><?= $model_cat->price ?></td>
                    </tr>
                    <tr>
                        <th>พันธุ์</th>
                        <td><?= $model_cat->type ?></td>
                    </tr>

                    <tr>
                        <th>วันเกิด</th>
                        <td><?= $model_cat->birthday ?></td>
                    </tr>


                </table>
            </div>


        </div>


        <div class=" grid-flex site-contact" style="margin-top: 5%">


            <div class="grid-flex grid-flex-2" style="justify-content: center">


                <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form-horizontal',
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
                    'options' => ['enctype' => 'multipart/form-data'],

                ]);
                ?>


                <div>
                    <label>อัพโหลดรูปภาพใบเสร็จการชำระเงิน</label><?= $form->field($model, 'img_name')->widget(Upload::classname(), [
                        'url' => ['avatar-upload'],
                        'class' => 'ima',
                        'maxFileSize' => 5 * 1024 * 1024,
                        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                    ])->label("") ?>

                </div>



                <div style="margin-left: 75px">
                    <label>ข้อมูลการจัดส่ง</label>
                    <div>
                    <?= $form->field($model, 'delivery')->textarea(['rows' => '3'])->label(false) ?>
                    </div>


                </div>
                <div>
                    <div>
                        <?= $form->field($model, 'pickup_date')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => 'Enter birth date ...'],
                            'readonly' => true,
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd HH:ii:ss',
                                'autoclose' => true
                            ]
                        ]); ?>
                    </div>


                </div>
                <!--                pickup_date-->



                <div class="form-group">
                    <div class="col-sm-offset-3" style="margin-left: 31%">
                        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
                        <?php

                        echo Html::a('ย้อนกลับ', ['check'], [
                                'class' => 'btn btn-danger con',
                                'style' => [
                                    'margin-left' => '10px',

                                ]
                            ]
                        );
                        ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
    <?php
    //$form = ActiveForm::begin([
    //    'id' => 'login-form-horizontal',
    //    'type' => ActiveForm::TYPE_HORIZONTAL,
    //    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
    //    'options'=>['enctype' => 'multipart/form-data']
    //]);
    //?>
    <!---->
    <!--   -->
<?php //ActiveForm::end(); ?>