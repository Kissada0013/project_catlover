<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="store-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '999-9999999'
    ]); ?>


    <?= Html::activeHiddenInput($model, 'lat') ?>

    <?= Html::activeHiddenInput($model, 'lng') ?>



    <?=  $form->field($model, 'img_file')->widget(Upload::classname(), [
        'url' => ['avatar-upload'],
        'maxFileSize' => 5 * 1024 * 1024,
        'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    ]) ?>



    <?= $form->field($model, 'address')->textarea(['rows' => '3']) ?>





    <head>
        <style>
            /* Set the size of the div element that contains the map */
            #map {
                height: 400px; /* The height is 400 pixels */
                width: 100%; /* The width is the width of the web page */
            }
        </style>
    </head>

    <div id="map" style="margin: 15px 0;"></div>



    <script>
        "use strict";



        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        let map;
        let markers = [];
        var lat, lng;
        var lat1, lng1;

        var htmllat = document.getElementById('store--lat').value;
        var htmllng = document.getElementById('store--lng').value;

        function initMap() {
            const haightAshbury = {
                lat: (parseFloat(htmllat)) ? parseFloat(htmllat) : 14.353933892289021,
                lng: (parseFloat(htmllng)) ? parseFloat(htmllng) : 100.53888112381652,
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

            map.addListener("click", (event) => {
                addMarker(event.latLng);
                $('#store-lat').val(event.latLng.lat())
                $('#store-lng').val(event.latLng.lng())
                console.log(event.latLng.lat())
                console.log(event.latLng.lng())

            }); // Adds a marker at the center of the map.

            addMarker(haightAshbury);
        } // Adds a marker to the map and push to the array.

        function addMarker(location) {

            lat = location.lat
            lng = location.lng;
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

        function showMarkers() {

            setMapOnAll(map);
            $.ajax({
                type: "POST",
                data: {
                    lat: lat,
                    lng: lng,
                },

            });
        }

        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD34mcvNb4JwQf15HrIQkNuygTvX8zhnec&callback=initMap">
    </script>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
