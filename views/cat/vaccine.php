<?php
/* @var $this yii\web\View */

use richardfan\widget\JSRegister;
use yii\helpers\Html;


?>

<div class="container1" style="margin: 0px 200px;font-size: 22px">

    <div style="font-size: 36px">วัคซีน</div>

    <?php
    echo Html::a('ย้อนกลับ', ['sell', 'id' => $id], ['class' => 'btn con  btn-warning']);

    ?>

<table class="table table-bordered" style="font-size: 16px;margin-top: 10px">

    <tbody>


    <th>
        รูปภาพ
    </th>
    <th>
        วัคซีน
    </th>
    <th>
        วันที่ฉีดวัคซีน
    </th>
    <th>
        สัตวแพทย์
    </th>


    <?php
    foreach ($datacat as $data) {
        ?>
        <tr>
            <td>
                <img src="<?php echo $data['image_path']; ?>" />
            </td>
            <td>
                <?php
                echo $data['name']
                ?>
            </td>
            <td>

                <?php
                echo $data['created_at']
                ?>
            </td>
            <td>
                <?php
                echo $data['veterinary']
                ?>
            </td>




        </tr>
    <?php } ?>


    </tbody>


</table>

    <?php if (Yii::$app->user->can('Admin')) { ?>
        <?php
            echo Html::a('เพิ่มข้อมูล', ['vaccine/create', 'id' => $id], ['class' => 'btn con btn-success']);

         ?>
    <?php } ?>



</div>

