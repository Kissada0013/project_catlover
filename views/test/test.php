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

/* @var $this yii\web\View */
///* @var $searchModel app\models\search\CatSearch */
///* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile('@web/js/main.js', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/cat.css', ['depends' => [JqueryAsset::className()]]);

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
        margin-left: 85px;
    }
</style>
<?php Pjax::begin(['id' => 'id_pjax']) ?>


<div class="test-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(
        [
            'id' => 'test-form'
        ]
    );


    ActiveForm::end(); ?>


    <?= Yii::$app->user->can('User') ?
        ListView::widget([

            'dataProvider' => $dataProvider,
            'itemView' => 'card',
            'layout' => '<div class="none-sum">{items}</div>',
        ])
        :
        GridView::widget([
//        Yii::$app->user->isGuest && Yii::$app->user->can('Admin'),
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'pass',
                'name',
                'color',
                [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::img($model->image_path, ['STYLE' => '', 'CLASS' => '']);
                    },
//                'label' => 'อุปกรณ์',
                ],
                'weight',
                [
                    'attribute' => 'price',
                    'value' => function ($model) {
                        return number_format($model->price, 2, ".", ",");
                    }],

                'type',
                [
//                'header' => '<div>brithday</div>',
                    'attribute' => 'birthday',

                    'format' => 'html',
                    'filter' => \kartik\widgets\DatePicker::widget([
                        'attribute' => 'birthday',
                        'model' => $searchModel,
                        'language' => 'th',
                        'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
                        'options' => ['placeholder' => 'ค้นหา', 'style' => 'z-index:10000'],
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'autoclose' => true,
                            'format' => 'dd/mm/yyyy',
                            'orientation' => 'bottom left'
                        ]
                    ]),
                    'value' => function ($model) {
                        return \app\helper\Helper::changeDateFormat($model->birthday);
                    }
                ],
                ['class' => 'kartik\grid\ActionColumn',
                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('Admin'),
                    'header' => "ดำเนินการ",
                ],

            ],
        ]);

    ?>






    <?php if (Yii::$app->user->identity->name == 'user' && $count != 0) { ?>
        <div>
            <button class="button" id="checkcount">
                <i class='glyphicon glyphicon-shopping-cart' style='font-size: 50px '></i>
                <div class='count-row-cart'><?= $count ?></div>
            </button>

        </div>
    <?php } ?>

    <p class="credits">
        Thanks <a href="https://twitter.com/pwign" class="credits__reference">Anh</a> for the inspiration
    </p>


</div>
<?php Pjax::end(); ?>

<?php JSRegister::begin(); ?>
<script>
    $(document).delegate('#test-form', 'submit', function (e) {
        e.preventDefault()
        let this_value = $('#catsearch-search').val();
        let url = updateQueryStringParameter(window.location.href, 'search', this_value);
        // console.log(url);
        $.pjax.reload({container: '#id_pjax', url: url, 'timeout': 5000, async: false});
    })


    var cc = '<?=  $count ?>'
    $(document).delegate('#unit_cat', 'click', function () {
        window.location.href = UrlBase + 'cat/create'
    })
    console.log(<?=  $count ?>)
    $(document).delegate('#checkcount', 'click', function () {


        // if(cc=== '0'){
        //     alert("Please select a cat")
        // }else{
        window.location.href = UrlBase + 'count/index'
        // }

    })
    $(document).delegate('.cart', 'click', function () {
        let data_id = $(this).attr('data_id')
        console.log($(this))
        $.ajax({
            url: 'cart',
            method: "POST",
            data: {
                _csrf,
                data_id,
            },
            success: function (respond) {
                if (respond.status) {
                    $.pjax.reload({
                        container: '#id_pjax',
                        'timeout': 5000,
                    }).done(function () {
                        alert('ซื้อ ' + data_id + ' แล้ว')
                    })
                } else {
                    <?php

                    ?>
                    alert('ซื้อ ' + data_id + ' ไม่ได้')
                }
            },
            error: function (respond) {
                alert('ซื้อ ' + data_id + ' ไม่ได้')
            }
        })
    })

</script>
<?php JSRegister::end(); ?>
