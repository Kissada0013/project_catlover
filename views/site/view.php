<?php

use kartik\detail\DetailView;
use yii\web\JqueryAsset;


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

<div class="container1" style="margin: 0px 200px">


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

    <div style="margin-top: 50px;padding: 40px;height: 400px">

        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex">

                    <div class="today" style="font-weight: 900;font-size: 18px">ชื่อร้าน</div>




                    <label style="width: 52%;margin-left: 30px;font-weight: 100;font-size: 16px"> <?= $model->name ?></label>
                </div>


            </div>

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 18px">ชื่อ</div>



                    <label style="width: 52%;margin-left: 30px;font-weight: 100;font-size: 16px"> <?= $model->name ?></label>
                </div>


            </div>

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 18px;width: 100%">นามสกุล</div>



                    <label style="width: 52%;margin-left: 30px;font-weight: 100;font-size: 16px"> <?= $model->lastname ?></label>
                </div>


            </div>


        </div>


        <div class="design-discussion1 grid-flex-5" style="margin-top: 30px">
            <div class="award1  grid-flex grid-flex-3">

                <div class="today" style="font-weight: 900;font-size: 18px">อีเมล</div>

                <label style="width: 27%;margin-left: 30px;font-weight: 100;font-size: 16px"> <?= $model->email ?></label>


            </div>
        </div>
    </div>

</div>


