<?php

use yii\helpers\Html;

?>

<style>
    .none-sum>div{
        width: 25%;
    }
    /*.box-up{*/
    /*    width: 211px;*/
    /*}*/
    .btn-primary{
        margin-bottom: -10px;
        /*margin-top: 10px;*/
        color: #fff;
        background-color: #a3c9a8;
        width: 93%;
        /*padding-bottom: -7px;*/
        border-color: #787878;
    }
    .btn-primary:hover{
        background: #90c799;
    }
    .list-view{
        width: 1170px;
    }



</style>

<div class="page-wrapper" >
    <div class="page-inner" style="margin-top: 10px">
            <div class="el-wrapper" style="margin-right:  10px;margin-left: 50px" >
                <div class="box-up" style="height: 380px; border: 1px solid">
                    <img class="image-cat" style="width: 100%"  src="<?= $model->image_path?>">










                    <div class="img-info">
                        <div class="info-inner" >
                            <span class="p-name" style="font-size: 20px;padding-left: 15px;font-weight: 700; text-align: left"  ><?= $model->name ?></span>
                            <source src="<?= $model->video ?>" type="video/mp4">
                            <span class="p-company"  style="font-size: 16px;padding-left: 15px; text-align: left"><?= $model->type ?></span>
                            <span class="p-company"  style="font-size: 16px;padding-left: 15px; text-align: left"><?=
                                 number_format($model->price);
                                 ?></span>






                            <?php if (!Yii::$app->user->can('Admin')) { ?>
                                <?= Html::a('ซื้อ', ['sell', 'id' => $model->id], ['class'=>'btn btn-primary']) ?>
                            <?php } ?>



                            <?php if (Yii::$app->user->can('Admin')) { ?>

                                <?= Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['sell', 'id' => $model->id], ['class'=>'btn btn-success','']) ?>
                                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class'=>'btn btn-warning']) ?>
                                <?= Html::a('<i class="  glyphicon glyphicon-trash"></i>', ['delete', 'id' => $model->id], ['class'=>'btn btn-danger']) ?>
                            <?php } ?>

                        </div>

                    </div>

                </div>



            </div>
    </div>
</div>

