<?php

use app\models\Cat;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use richardfan\widget\JSRegister;
use yii\web\JqueryAsset;
use kartik\select2\Select2;
use app\helper\Helper;
use yii\widgets\ListView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('@web/js/main.js', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/cat.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);

//$this->title = 'Cats';
//$this->params['breadcrumbs'][] = $this->title;

?>

<style>


    .button {
        right: 30px;
        position: fixed;
        bottom: 80px;
        height: 100px;
        width: 120px;
        border: none;
        background: #92e2fa4d;
        border-radius: 10%;

    }

    .buy {
        background: white;
        width: 100%;
        height: 40px;
        border: 2px solid #e7e7e7;
    }

    .buy:hover {
        background: #e7e7e7;
    }

    .glyphicon.glyphicon-shopping-cart {
        font-size: 20px;

    }


    .count-row-cart {
        position: absolute;
        background: #00ffb8;
        border-radius: 50%;
        font-size: 20px;
        bottom: 50px;
        width: 30px;
        height: 30px;
        margin-bottom: 25px;
        margin-left: 20px;
    }


    .btn-type {
        width: 90%;
        text-align: left;
        margin-bottom: 3px;
        background: white;

    }
</style>
<?php Pjax::begin(['id' => 'id_pjax']) ?>
<div class="container1" style="margin: 0px 100px">
    <div class="test-index">
        <h1><?= Html::encode($this->title) ?></h1>


        <div class="grid-flex site-contact" style="font-size: 18px">
            <div class="grid-flex grid-col justify-content-center"
                 style="height: 820px;    border-right: 1px solid;margin-top: 30px;padding-right: 20px;padding-left: 10px">
                <div class="grid-flex grid-col" style="height: 350px">
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'test-form'
                        ]
                    );
                    echo $form->field($searchModel, 'search', [
                        'addon' => [
                            'append' => [
                                'value' => ['id' => 'test-search'],
                                'content' => Html::submitButton('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-primary search', 'style' => 'margin-top : -10px;background : #fff;color : #d2d2d2;border-left : none;border-bottom: 1px solid;border-right: 1px solid;border-top: 1px solid']),
                                'asButton' => true,
                            ]
                        ]
                    ])->label('ค้นหา');
                    ActiveForm::end(); ?>




                    <button class="button-create" id="sold" style="margin-top: 20px;width: 50%">

                        <div style="margin-top: 10px">

                            <p class="button-create__text">ข้อมูลแมวที่ขายแล้ว</p>
                        </div>
                    </button>





                    <div class="grid-flex  grid-width-100 " style="font-size: 20px">

                        <h4 style="font-weight: bold">หมวดหมู่</h4>

                    </div>
                    <h4 style="margin-left: 20px;margin-bottom: 20px"><i class="fas fa-circle"
                                                                         style="font-size: 2px;padding-right: 5px"></i>พันธุ์น้องแมว
                    </h4>
                    <ul style="overflow-y: scroll;height: fit-content;font-size: 16px ">
                        <?php foreach ($type as $type): ?>
                            <div class="news-menu-item" data="' . $type->type . '" style="margin-left: 40px;">

                                <i class="far fa-circle "
                                   style="font-size: 2px"></i><?= Html::submitButton($type->type, ['class' => 'btn btn-type', 'style' => 'font-size : 16px', 'id' => 'type-search', 'data' => "$type->type"]) ?>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="grid-flex grid-col" style="height: 300px">

                    <h4 style="margin-left: 20px;margin-bottom: 20px"><i class="fas fa-circle"
                                                                         style="font-size: 2px;padding-right: 5px"></i>ฟาร์ม
                    </h4>
                    <ul style="overflow-y: scroll;height: fit-content ">
                        <?php foreach ($farm as $farm): ?>
                            <div class="news-menu-item" style="margin-left: 40px;">
                                <i class="far fa-circle "
                                   style="font-size: 2px"></i><?= Html::submitButton($farm->farm, ['class' => 'btn btn-type', 'style' => 'font-size : 16px', 'id' => 'farm-search', 'data' => "$farm->farm"]) ?>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                </div>


            </div>


            <div class="grid-flex grid-flex-3" style="background-color: white">
                <?= !Yii::$app->user->can('Admin') ?


                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => 'card',
                        'layout' => '<div class="none-sum">{items}</div>',
                    ])
                    :
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => 'card',
                        'layout' => '<div class="none-sum">{items}</div>',
                    ])
                ?>


            </div>


            <div>

                <?php if (Yii::$app->user->can('Admin')) { ?>
                    <button class="button-create unit_cat" id="unit_cat " style="margin-top: 20px">

                        <div class="button-create__content ">
                            <i class="fas fa-plus" style="color: #bebfbf;font-size: 10px;
                 margin-left: 54px;"></i>
                            <p class="button-create__text">เพิ่ม</p>
                        </div>
                    </button>

                <?php } ?>



            </div>


        </div>


    </div>
</div>


<?php Pjax::end(); ?>

<?php JSRegister::begin(); ?>
<script>

    $(document).delegate('#test-form', 'submit', function (e) {
        e.preventDefault()
        let this_value = $('#catsearch-search').val();
        // console.log(this_value)
        let url = updateQueryStringParameter(window.location.href, 'search', this_value);
        console.log(url)
        $.pjax.reload({container: '#id_pjax', url: url, 'timeout': 5000, async: false});
    })

    $(document).delegate('#type-search', 'click', function () {
        let DataMain = $(this).attr('data');

        let url = updateQueryStringParameter(window.location.href, 'search', DataMain);
        console.log(url)
        $.pjax.reload({container: '#id_pjax', url: url, 'timeout': 5000, async: false});

    })
    $(document).delegate('#farm-search', 'click', function () {
        let DataMain = $(this).attr('data');
        // console.log(DataMain);
        let url = updateQueryStringParameter(window.location.href, 'search', DataMain);
        // console.log(url)
        $.pjax.reload({container: '#id_pjax', url: url, 'timeout': 5000, async: false});

    })

    var cc = '<?=  $count ?>'
    $(document).delegate('.unit_cat', 'click', function () {
        window.location.href = UrlBase + 'cat/create'
    })

    $(document).delegate('#sold', 'click', function () {
        window.location.href = UrlBase + 'cat/sold'
    })
    console.log(<?=  $count ?>)
    $(document).delegate('#checkcount', 'click', function () {


        // if(cc=== '0'){
        //     alert("Please select a cat")
        // }else{
        window.location.href = UrlBase + 'count/index'
        // }

    })


    //$(document).delegate('.cart', 'click', function () {
    //    let data_id = $(this).attr('data_id')
    //    console.log($(this))
    //    $.ajax({
    //        url: 'cart',
    //        method: "POST",
    //        data: {
    //            _csrf,
    //            data_id,
    //        },
    //        success: function (respond) {
    //            if (respond.status) {
    //                $.pjax.reload({
    //                    container: '#id_pjax',
    //                    'timeout': 5000,
    //                }).done(function () {
    //                    alert('ซื้อ ' + data_id + ' แล้ว')
    //                })
    //            } else {
    //                <?php
    //                ?>
    //                alert('ซื้อ ' + data_id + ' ไม่ได้')
    //            }
    //        },
    //        error: function (respond) {
    //            alert('ซื้อ ' + data_id + ' ไม่ได้')
    //        }
    //    })
    //})

</script>
<?php JSRegister::end(); ?>
