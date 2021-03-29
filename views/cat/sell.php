<?php

use yii\web\JqueryAsset;
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);
?>
<style>
    h4 {
        font-size: 32px;
        font-weight: 600;
    }

    .farm {
        font-size: 18px;
        font-weight: 600;
        color: #ad0000;
    }

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
<div class="container1" style="margin: 0px 200px;font-size: 22px">
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">

        <div id="caption"></div>
    </div>


    <div class=" grid-flex site-contact" >


        <div class="grid-flex grid-flex-2" style="justify-content: center" >

            <img class="image-cat" style="width: 50%;" src="<?= $model->image_path ?>">
        </div>
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center">
                <h4><?= $model->name ?></h4>

                <h4>ราคา <?= $model->price ?> บาท</h4>


                <div class="farm">
                    <div>
                        พันธุ์ <?= $model->type ?>
                    </div>
                    <div>
                        ฟาร์ม <?= $model->farm ?>
                    </div>
                    <div>
                        อายุ <?= $model->age ?>
                    </div>
                    <div>
                        เพศ <?= \app\models\Cat::genderToString($model->gender)  ?>
                    </div>


                    <div>
                        วันที่ซื้อจากฟาร์ม <?= \app\helper\Helper::changeDateToDateThai($model->birthday_farm) ?>
                    </div>
                    วันเกิด <?= \app\helper\Helper::changeDateToDateThai($model->birthday) ?>


                </div>

            </div>

        </div>


    </div>

    <div class="grid-flex site-contact">


        <div class="grid-flex grid-flex-2" style="justify-content: center;padding-top: 50px">
            <div class="grid-flex-3" style="text-align: center">
                <h4>รายละเอียดวัคซีน</h4>

                <div class="farm">
                    <div>
                        ชื่อ <?= $model->vaccine ?>
                    </div>
                    <div>
                        วันที่ฉีด <?= \app\helper\Helper::changeDateToDateThai($model->vaccine_day) ?>

                    </div>
                    <div>
                        ชื่อสัตวแพทย์ <?= $model->veterinary ?>
                    </div>


                </div>


                <div class="grid-flex" style="justify-content: flex-end;padding-top: 150px">
                    <?= Html::a('ข้อมูลวัคซีนพิ่มเติม', ['vaccine', 'id' => $model->id], ['class' => 'btn con btn-info']); ?>
                </div>


            </div>


        </div>
        <div class="grid-flex grid-flex-2" style="justify-content: center">
            <img class="image-cat" style="width: 50%;" src="<?= $model->vaccine_image_path ?>">

        </div>


    </div>

    <div class="grid-flex pt-2">


        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class=" grid-flex grid-flex-1 grid-col">

                <div class="grid-flex detail">
                    <video style="    width: 200px;padding-top: -75px;margin-top: -14px;height: 138px;" controls>
                        <source src="<?= $model->video ?>" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>

                </div>

                <div class="today">วิดัโอ</div>


            </div>
        </div>

        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class=" grid-flex grid-flex-1 grid-col">

                <div class="grid-flex detail">
                    <img class="image-cat" id="myImg" style="width: 50%;" src="<?= $model->ped_image_path ?>">

                </div>
                <div class="today">ใบเพ็ด</div>

            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="grid-flex grid-flex-1 grid-col">


                <div class="grid-flex detail">
                    <img class="image-cat" id="myImg2" style="width: 50%;" src="<?= $model->fa_image_path ?>">

                </div>

                <div class="today">รูปพ่อแมว</div>
            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class=" grid-flex grid-flex-1 grid-col">

                <div class="grid-flex detail">
                    <img class="image-cat" id="myImg3" style="width: 50%;" src="<?= $model->fa_ped_image_path ?>">

                </div>

                <div class="today">ใบเพ็ดพ่อแมว</div>


            </div>
        </div>


        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="grid-flex grid-flex-1 grid-col">

                <div class="grid-flex detail">
                    <img class="image-cat" id="myImg4" style="width: 50%;" src="<?= $model->mo_image_path ?>">

                </div>

                <div class="today">รูปแม่แมว</div>

            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="grid-flex grid-flex-1 grid-col">

                <div class="grid-flex detail">
                    <img class="image-cat" id="myImg5" style="width: 50%;" src="<?= $model->mo_ped_image_path ?>">

                </div>

                <div class="today">ใบเพ็ดแม่แมว</div>

            </div>
        </div>


    </div>
    <div class="grid-flex pt-2">


        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="award  grid-flex grid-flex-1 grid-col">

                <div class="today" style="font-weight: 900">น้ำหนัก</div>

                <div class="grid-flex detail">
                    <?= $model->weight ?>

                </div>


            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="award  grid-flex grid-flex-1 grid-col">

                <div class="today" style="font-weight: 900">สี</div>

                <div class="grid-flex detail">
                    <?= $model->color ?>
                </div>


            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="award  grid-flex grid-flex-1 grid-col">

                <div class="today" style="font-weight: 900"> ลาย</div>
                <div class="grid-flex detail">
                    <?= \app\models\Cat::getString($model->pattern) ?>
                </div>


            </div>
        </div>

        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="award  grid-flex grid-flex-1 grid-col">

                <div class="today" style="font-weight: 900">ตำหนิ</div>

                <div class="grid-flex detail">
                    <?= \app\models\Cat::getString($model->blame) ?>
                </div>

            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="award  grid-flex grid-flex-1 grid-col">

                <div class="today" style="font-weight: 900">ลักษณะพิเศษ</div>

                <div class="grid-flex detail">
                    <?= \app\models\Cat::getString($model->special) ?>
                </div>

            </div>
        </div>
        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
            <div class="award  grid-flex grid-flex-1 grid-col">

                <div class="today" style="font-weight: 900">อาหารที่กินปัจจุบัน</div>

                <div class="grid-flex detail">
                    <?= \app\models\Cat::getString($model->food) ?>
                </div>

            </div>
        </div>


    </div>


    <div style="margin: 50px 0px">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

            ],


        ]);

         if (!Yii::$app->user->can('Admin') && $model->status == 1) { ?>
        <?=  Html::a('สั่งซื้อ', ['confirm', 'id' => $model->id], ['class' => 'btn con btn-success', 'style' => [
                'width' => '100px',
                 'font-size' => '18px',
             ]]); ?>
        <?php }

         if($model->status == 1) {

             echo Html::a('ย้อนกลับ', ['index'], [
                     'class' => 'btn btn-danger con',
                     'style' => [
                         'margin-left' => '10px',
                         'width' => '100px',
                         'font-size' => '18px',
                     ]
                 ]
             );
         }

        ?>
    </div>


</div>


<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var img2 = document.getElementById("myImg2");
    var modalImg2 = document.getElementById("img02");
    var img3 = document.getElementById("myImg3");
    var modalImg3 = document.getElementById("img03");
    var img4 = document.getElementById("myImg4");
    var modalImg4 = document.getElementById("img04");
    var img5 = document.getElementById("myImg5");
    var modalImg5 = document.getElementById("img05");
    var captionText = document.getElementById("caption");

    img.onclick = function () {
        console.log(img)
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
    img2.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
    img3.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
    img4.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }
    img5.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
</script>

