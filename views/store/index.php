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
/* @var $searchModel app\models\search\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/modalcat.css', ['depends' => [JqueryAsset::className()]]);
?>
<style>
    h4 {
        font-size: 32px;

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
     table {
         border-collapse: collapse;
         width: 100%;
     }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }




</style>

<div class="container1" style="margin: 0px 200px;font-size: 22px">


    <div class="container grid-flex site-contact" style="margin-top: 50px">
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 36px">
                โปรไฟล์ร้าน

            </div>

        </div>


    </div>


    <div class="container grid-flex site-contact" style="margin-top: 50px">
        <div class="grid-flex grid-flex-2">
            <div class="grid-flex-3" style="text-align: center;align-content: center">
                <img class="image-cat" src="<?= $model->image_path ?>">

            </div>

        </div>


    </div>

    <div style="margin-top: 50px;padding: 40px;height: 400px">

        <div class="grid-flex" style="margin-top: 20px">

            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex">

                    <div class="today" style="font-weight: 900;font-size: 28px">ชื่อร้าน</div>


                    <label style="width: 52%;margin-left: 30px;font-weight: 100;font-size: 28px"> <?= $model->name ?></label>
                </div>


            </div>


            <div class="design-discussion1 grid-flex-5">
                <div class="award1  grid-flex grid-flex-3">

                    <div class="today" style="font-weight: 900;font-size: 28px;width: 100%">เบอร์โทรเจ้าของร้าน</div>



                    <label style="width: 52%;margin-left: 30px;font-weight: 100;font-size: 28px"> <?= Helper::formatPhoneThai($model->phone)  ?></label>
                </div>


            </div>


        </div>


        <div class="design-discussion1 grid-flex-5" style="margin-top: 30px">
            <div class="award1  grid-flex grid-flex-3">

                <div class="today" style="font-weight: 900;font-size: 28px">ที่อยู่</div>

                <label style="width: 27%;margin-left: 30px;font-weight: 100;font-size: 28px"> <?= $model->address ?></label>


            </div>
        </div>



        <div class="container grid-flex site-contact" style="margin-top: 50px">
            <div class="grid-flex grid-flex-2">
                <div class="grid-flex-3" style="text-align: center;align-content: center;font-size: 36px">
                    ข้อมูลการโอนเงิน

                </div>

            </div>


        </div>

        <table style="margin-bottom: 200px;margin-top: 50px">
            <tr>
                <th >ลำดับ</th>
                <th style="padding-left: 20px">ชื่อธนาคาร</th>
                <th >ชื่อเจ้าของร้าน</th>
                <th>เลขบัญชี</th>
                <th >สถานะ</th>

            </tr>

        <?php
        foreach ($bank as $data) {
            ?>
            <tr>
                <td>
                    <?php
                    echo $data['id']
                    ?>
                </td>

                <td>
                    <?php
                    echo $data['name']
                    ?>
                </td>
                <td>

                    <?php
                    echo $data['owner']
                    ?>
                </td>
                <td>
                    <?php
                    echo $data['account']
                    ?>
                </td>
                <td>
                    <?php
                    echo \app\models\User::typeIntToString($data['status'])
                    ?>
                </td>


            </tr>
        <?php } ?>
        </table>


        <?= Html::activeHiddenInput($model, 'lat') ?>
        <?= Html::activeHiddenInput($model, 'lng') ?>


        <head>
            <style>
                /* Set the size of the div element that contains the map */
                #map {
                    height: 400px; /* The height is 400 pixels */
                    width: 100%; /* The width is the width of the web page */

                }
            </style>
        </head>


    </div>

    <div id="map" style="margin-top: 200px;margin-bottom: 50px"></div>
</div>


</div>





<div class="grid-flex" style="justify-content: flex-start;padding-bottom: 50px;margin-left: 200px">
    <?php if (Yii::$app->user->can('Admin')) { ?>
    <?= Html::a('แก้ไข', ['store/update', 'id' => $model->id], ['class' => 'btn con btn-warning']); ?>
    <?php } ?>
</div>


<script>
    "use strict";

    // In the following example, markers appear when the user clicks on the map.
    // The markers are stored in an array.
    // The user can then click an option to hide, show or delete the markers.
    let map;
    let markers = [];
    var lat, lng;

    var htmllat = document.getElementById('store-lat').value;
    var htmllng = document.getElementById('store-lng').value;


    function initMap() {
        const haightAshbury = {
            lat: parseFloat(htmllat),
            lng: parseFloat(htmllng),
        };
        $(document).ready(function () {
            $('#store-lat').val(lat)
            $('#store-lng').val(lng)
        });
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: haightAshbury,
            mapTypeId: "terrain",
        }); // This event listener will call addMarker() when the map is clicked.
        addMarker(haightAshbury);
    } // Adds a marker to the map and push to the array.
    function addMarker(location) {
        clearMarkers();
        markers = [];
        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });
        markers.push(marker);
    } // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    } // Removes the markers from the map, but keeps them in the array.

    function clearMarkers() {
        setMapOnAll(null);
    } // Shows any markers currently in the array.
</script>
<!--Load the API from the specified URL
* The async attribute allows the browser to render the page while the API loads
* The key parameter will contain your own API key (which is not needed for this tutorial)
* The callback parameter executes the initMap() function
-->
<script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD34mcvNb4JwQf15HrIQkNuygTvX8zhnec&callback=initMap">

</script>

<!--key google map ogs-->
<!--AIzaSyD34mcvNb4JwQf15HrIQkNuygTvX8zhnec&callback=initMap-->