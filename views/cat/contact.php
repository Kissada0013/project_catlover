<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\web\JqueryAsset;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use edofre\markerclusterer\Map;
use edofre\markerclusterer\Marker;


$this->registerCssFile('@web/css/grid.css', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile('@web/css/dmy.css', ['depends' => [JqueryAsset::className()]]);
?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <div class="grid-flex site-contact">
        <div class="grid-flex grid-flex-4" style="">

            <div class="grid-flex grid-col grid-flex-2">
                <div class="p-3">

                    <div class="grid-flex">
                        <div class="ying-yang"></div>
                        <div class="grid-flex grid-flex-1 pl-2">
                            <div class="grid-flex grid-flex-1 grid-justify-end grid-align-center">
                                <div class="over-item over-active  grid-flex  mr-2" data-index="0">
                                    Overview

                                </div>

                                <div class="over-item  grid-flex mr-2" data-index="1">
                                    Reports
                                </div>


                            </div>


                        </div>
                        <div class="search grid-flex grid-flex-1 ">

                            <input class="search-input grid-flex  grid-flex-1 grid-justify-end grid-align-center"
                                   placeholder="Search Rooms">

                            <i class="fas fa-search"></i>
                        </div>
                    </div>

                    <div class="switch-tab-x">
                        <div class="switch-tab-view grid-flex">
                            <div class="switch-tab-content grid-flex grid-col">


                                <div class="grid-flex  pt-5">
                                    <div class="Main grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end">
                                        Main Dashboard
                                    </div>
                                    <div class="grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end grid-justify-end">
                                        <div class="manage grid-flex  grid-align-end grid-justify-end " id="mana">
                                            Manage<i class="fas fa-angle-down "></i>

                                            <div class="menu grid-flex grid-col grid-align-center ">
                                                <div class="menu-item pt-1 grid-height-100 grid-width-100">
                                                    Add<i class="far fa-plus-square"></i>
                                                </div>
                                                <div class="menu-item pt-1 grid-height-100 grid-width-100">
                                                    Edit<i class="far fa-edit"></i>
                                                </div>
                                                <div class="menu-item pt-1 grid-height-100 grid-width-100">
                                                    Delete<i class="far fa-trash-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" grid-flex pt-2">
                                    <div class="booking tab-1 first-tab grid-flex  " data_index1="0">
                                        Today
                                    </div>
                                    <div class="booking  grid-flex ml-5" data_index1="1">
                                        Daily

                                    </div>
                                    <div class="booking  grid-flex ml-5" data_index1="2">
                                        Monthly

                                    </div>
                                    <div class="booking  grid-flex ml-5" data_index1="3">
                                        Yearly
                                    </div>
                                </div>
                                <!----------------------------------------->
                                <div class="switch-tab-x_2">
                                    <div class="switch-tab-view_2 grid-flex">

                                        <div class="switch-tab-content_2 grid-flex  grid-col">
                                            <!---------------------------graph-------------------------------------------->
                                            <div class="grid-flex mt-2 grid-flex grid-flex-1 ">


                                                <div class="graph grid-flex grid-flex-3 grid-col">
                                                    <canvas id="bar-chart-grouped" width="500" height="240"></canvas>


                                                    <div class="grid-flex pt-2" style="width:1200px;">


                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col" style="background: #ececec">

                                                                <div class="today">ราคาทุน</div>
                                                                <div class="grid-flex">
                                                                    <div class="cost_cat_today ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col" style="background: #ececec">

                                                                <div class="today">ราคาขาย</div>
                                                                <div class="grid-flex">
                                                                    <div class="price_cat_today ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col" style="background: #ececec">

                                                                <div class="today">Cat</div>


                                                                <div class="grid-flex">
                                                                    <div class="datacat_amount_today ml-2 mr-2"></div>
                                                                    <i class="fas fa-cat"></i>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col" style="background: #ececec">

                                                                <div class="today">กำไรรวม</div>


                                                                <div class="grid-flex">
                                                                    <div class="datacat_persent_today ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>


                                            </div>
                                            <!---------------------------graph-------------------------------------------->
                                        </div>

                                        <div class="switch-tab-content_2 grid-flex  grid-col">
                                            <!---------------------------graph-------------------------------------------->
                                            <div class="grid-flex mt-2 grid-flex grid-flex-1 ">


                                                <div class="graph grid-flex grid-flex-3 grid-col">
                                                    <canvas id="bar-chart-grouped2" width="500" height="250"></canvas>


                                                    <div class="label-graph1 grid-flex" style="background: white"></div>

                                                    <div class="grid-flex pt-2">


                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">ราคาทุนรวม</div>

                                                                <div class="grid-flex">
                                                                    <div class="cost_cat_day ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">ราคาขายรวม</div>

                                                                <div class="grid-flex">
                                                                    <div class="price_cat_day ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">Cat</div>
                                                                <div class="grid-flex">
                                                                    <div class="datacat_amount_day ml-2 mr-2"></div>
                                                                    <i class="fas fa-cat"></i>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">กำไรรวม</div>

                                                                <div class="grid-flex">
                                                                    <div class="datacat_persent_day ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                            <!---------------------------graph-------------------------------------------->
                                        </div>

                                        <div class="switch-tab-content_2 grid-flex  grid-col">

                                            <!---------------------------graph-------------------------------------------->
                                            <div class="grid-flex mt-2 grid-flex grid-flex-1 ">


                                                <div class="graph grid-flex grid-flex-3 grid-col">
                                                    <canvas id="bar-chart-grouped3" width="500" height="250"></canvas>


                                                    <div class="label-graph1 grid-flex" style="background: white"></div>


                                                    <div class="grid-flex pt-2">


                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">ราคาทุน</div>


                                                                <div class="grid-flex">
                                                                    <div class="cost_cat_month ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">ราคาขาย</div>


                                                                <div class="grid-flex">
                                                                    <div class="price_cat_month ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">Cat</div>

                                                                <div class="grid-flex">
                                                                    <div class="datacat_amount_month ml-2 mr-2"></div>
                                                                    <i class="fas fa-cat"></i>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">
                                                                <div class="today">กำไรรวม</div>


                                                                <div class="grid-flex">
                                                                    <div class="datacat_persent_month ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                            <!---------------------------graph-------------------------------------------->
                                        </div>

                                        <div class="switch-tab-content_2 grid-flex  grid-col">
                                            <!---------------------------graph-------------------------------------------->
                                            <div class="grid-flex mt-2 grid-flex grid-flex-1 ">


                                                <div class="graph grid-flex grid-flex-3 grid-col">
                                                    <canvas id="bar-chart-grouped4" width="500" height="250"></canvas>
                                                    <div class="label-graph1 grid-flex" style="background: white"></div>

                                                    <div class="grid-flex pt-2">


                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">ราคาทุน</div>

                                                                <div class="grid-flex">

                                                                    <div class="cost_cat_year  ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">ราคาขาย</div>

                                                                <div class="grid-flex">
                                                                    <div class="price_cat_year ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">

                                                                <div class="today">Cat</div>
                                                                <div class="grid-flex">
                                                                    <div class="datacat_amount_year ml-2 mr-2"></div>
                                                                    <i class="fas fa-cat"></i>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                            <div class="award  grid-flex grid-flex-1 grid-col">
                                                                <div class="today">กำไรรวม</div>
                                                                <div class="grid-flex">
                                                                    <div class="datacat_persent_year ml-2 mr-2"></div>
                                                                    <i class="fas fa-money-bill-wave"></i>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                            <!---------------------------graph-------------------------------------------->
                                        </div>


                                    </div>

                                </div>
                                <!--  ---------------------------------------->
                            </div>


                            <div class="switch-tab-content grid-flex grid-col">
                                <div class="grid-flex  pt-5">
                                    <div class="Main grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end">
                                        Main Dashboardji
                                    </div>
                                    <div class="grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end grid-justify-end">
                                        <div class="manage1 grid-flex  grid-align-end grid-justify-end " id="mana1">
                                            Manage<i class="fas fa-angle-down "></i>

                                            <div class="menu grid-flex grid-col grid-align-center ">
                                                <div class="menu-item pt-1 grid-height-100 grid-width-100">
                                                    Add<i class="far fa-plus-square"></i>
                                                </div>
                                                <div class="menu-item pt-1 grid-height-100 grid-width-100">
                                                    Edit<i class="far fa-edit"></i>
                                                </div>
                                                <div class="menu-item pt-1 grid-height-100 grid-width-100">
                                                    Delete<i class="far fa-trash-alt"></i>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class=" grid-flex pt-2">
                                    <div class="booking_2 tab-01 frist-tab-01 grid-flex" data_index2="0">
                                        Booking
                                    </div>
                                    <div class="booking_2  grid-flex ml-5" data_index2="1">
                                        Amenities
                                    </div>
                                    <div class="booking_2 grid-flex ml-5" data_index2="2">
                                        Customization
                                    </div>
                                    <div class="booking_2 grid-flex ml-5" data_index2="3">
                                        Locality
                                    </div>
                                </div>


                                <div class="switch-tab-x_3">
                                    <div class="switch-tab-view_3 grid-flex">

                                        <!--                                        <div class="switch-tab-content_3 grid-flex grid-col mt-2">-->
                                        <!--                                            --><?php
                                        //                                            $map = new Map([
                                        //                                                'center' => new LatLng(['lat' => 15, 'lng' => 100]),
                                        //                                                'zoom' => 15,
                                        //                                                'width' => '100%',
                                        //                                                'height' => '600',
                                        //                                                'containerOptions' => [
                                        //                                                    'id' => 'map-canvas',
                                        //                                                ]
                                        //                                            ]);
                                        //                                            foreach ($markers as $key => $val) {
                                        //                                                $marker = new Marker([
                                        //                                                    'position' => $val['lat_long'],
                                        //                                                    'title' => $val['place'],
                                        //                                                    'clickable' => true,
                                        //                                                    'icon' => '../image/mark.png',
                                        //                                                ]);
                                        //
                                        //                                                $marker->attachInfoWindow(new InfoWindow(['content' => "
                                        //                                                    <h4><strong>{$val['place']}</strong></h4>
                                        //
                                        //                                                    <table class='table table-bordered'>
                                        //                                                        <tr>
                                        //                                                            <td>Latitude/Longitude</td>
                                        //                                                            <td>{$val['lat_long']}</td>
                                        //                                                        </tr>
                                        //                                                    </table>
                                        //
                                        //                                                    "]));
                                        //                                                $map->addOverlay($marker);
                                        //                                            }
                                        //                                            $map->center = $map->getMarkersCenterCoordinates();//กำหนดให้แผนที่อยู่ตรงกลางใน Marker
                                        //                                            $map->zoom = $map->getMarkersFittingZoom() - 1;
                                        //
                                        //                                            ?>
                                        <!---->
                                        <!--                                            <div class="row">-->
                                        <!--                                                <div class="col-sm-12 text-center">-->
                                        <!--                                                    --><?//= $map->display(); ?>
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                        </div>-->

                                        <div class="switch-tab-content_3 grid-flex grid-col mt-2">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d370653.6673711348!2d102.84454146968265!3d16.35840709057156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122602b91988e2f%3A0x93f0805cf799cc6!2z4LmA4LiX4Lio4Lia4Liy4Lil4LiZ4LiE4Lij4LiC4Lit4LiZ4LmB4LiB4LmI4LiZIOC4reC4s-C5gOC4oOC4reC5gOC4oeC4t-C4reC4h-C4guC4reC4meC5geC4geC5iOC4mSDguILguK3guJnguYHguIHguYjguJkgNDAwMDA!5e0!3m2!1sth!2sth!4v1598240755663!5m2!1sth!2sth"
                                                    width="600" height="450" frameborder="0" style="border:0;"
                                                    allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>


                                        <div class="switch-tab-content_3 grid-flex grid-col">
                                            <div class="grid-flex grid-flex-5 pt-2">


                                                <div class="grid-flex grid-flex-4 grid-col ">

                                                    <div class="grid-flex  mb-1">
                                                        <div class="b-w grid-flex grid-col grid-flex-2 mr-1 p-1 "
                                                             style="background: white">
                                                            <div class="today grid-flex">
                                                                Today's Earning
                                                            </div>
                                                            <div class="price grid-flex">
                                                                $2890
                                                            </div>
                                                            <div class="img1 grid-flex">
                                                                <img class="img1" style="width: 100%;height: 100%"
                                                                     src="../image/Annotation.png"
                                                                     alt="fdsf dsa">
                                                            </div>
                                                        </div>
                                                        <div class="demo grid-flex grid-flex-2 grid-col  p-1 grid-justify-center grid-align-center"
                                                             style="background: orange">
                                                            <div class="demographics grid-flex">
                                                                Demographics
                                                            </div>
                                                            <div class="D_price grid-flex">
                                                                20
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="sell grid-flex grid-width-100 grid-height-100"
                                                         style="background: #006666">

                                                        <div class="of grid-flex- grid-col ">
                                                            <div class="sell1 grid-flex mt-3 grid-justify-center grid-align-center">
                                                                20% OFF
                                                            </div>
                                                            <div class="sell2 grid-flex grid-flex-1 grid-justify-center grid-align-center">
                                                                On your first booking
                                                            </div>
                                                            <div class="sell3 grid-flex grid-flex-1 grid-justify-center grid-align-center">
                                                                NEWBIE20
                                                            </div>
                                                            <div class="sell4 grid-flex grid-flex-1 grid-justify-center grid-align-center">
                                                                COPY CODE
                                                            </div>


                                                        </div>

                                                        <div class="img1 grid-flex grid-width-100 grid-height-100">
                                                            <img class="img2" style="width: 100%;height: 100%"
                                                                 src="../image/Annotation1.png"
                                                                 alt="fdsf dsa">

                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="img2 grid-flex grid-flex-3 grid-height-100 grid-width-100 ml-1 mr-1">
                                                    <img class="img1" style="width: 100% ; height: 283px "
                                                         src="../image/tal.png"
                                                         alt="fdsf dsa">

                                                    <div class="grid-flex-radio-white grid-flex grid-align-center grid-justify-center"
                                                         style="height: 40px ; width: 40px">
                                                        <i class="fas fa-arrow-up p-1"
                                                           style="transform: rotate(41deg)"></i>
                                                    </div>
                                                </div>

                                                <div class="img3 grid-flex grid-flex-2 grid-height-100 grid-width-100 grid-col ">
                                                    <div class="img3-1 grid-flex grid-flex-2 grid-height-100 grid-width-100 grid-col "
                                                         style="background-color: white">
                                                        <div class="label-1 grid-flex grid-height-100 grid-width-100 grid-col p-1">
                                                            <div class="grid-flex grid-col">
                                                                <div class="today grid-flex">
                                                                    Today's Earning
                                                                </div>
                                                                <div class="price grid-flex">
                                                                    $2890
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="label-2 grid-flex grid-height-100 grid-width-100 grid-col ml-1"
                                                             style="width: 118px">

                                                            <div class="label-2-1 grid-flex grid-col  grid-width-100  ml-1 p-1 mr-1">
                                                                <div class="grid-flex">
                                                                    Today's Bookings
                                                                </div>
                                                                <div class="label-2-1-24 grid-flex">
                                                                    24
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="label-3 grid-flex grid-height-100 grid-width-100 grid-col">
                                                            <div class="grid-flex grid-col p-1">
                                                                <div class="total grid-flex ">
                                                                    Total Balance
                                                                </div>
                                                                <div class="grid-flex">
                                                                    $2M
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="design grid-flex-2 grid-col mt-1"
                                                         style="background-color: #006666">
                                                        <div class="grid-flex grid-height-100 grid-width-100 grid-col m-1 mt-2">
                                                            <div class="design-1 grid-flex  ">
                                                                Design Meetings
                                                            </div>
                                                            <div class="design-2 grid-flex ">
                                                                11 Min Left
                                                            </div>
                                                            <div class="design-3 grid-flex">
                                                            </div>


                                                            <div class="design-4 grid-flex">
                                                                <div class="grid-flex grid-flex-1">
                                                                    <div class="design-4-1 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                </div>
                                                                <div class="grid-flex grid-flex-1">
                                                                    <div class="design-4-2 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                        08
                                                                    </div>
                                                                </div>
                                                                <div class="grid-flex grid-flex-1 mr-2">
                                                                    <div class="design-4-3 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                        <i class="fas fa-arrow-up grid-justify-center p-1"
                                                                           style="transform: rotate(41deg)"></i>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                            <div class="grid-flex  pt-5">
                                                <div class="book grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end">
                                                    Action Bookings
                                                </div>
                                                <div class="check grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end grid-justify-end">
                                                    Check All <i class="fas fa-angle-right"></i>
                                                </div>
                                            </div>

                                            <div class="grid-flex pt-2">
                                                <div class="action-books grid-flex grid-flex-1 mr-1"
                                                     style="background-color: white">

                                                    <div class="award  grid-flex grid-flex-1 grid-col">
                                                        <div class=" grid-flex grid-flex-1 grid-justify-end grid-align-center">
                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                Award Ceremony
                                                            </div>
                                                            <div class="check-box-1 grid-flex  grid-justify-end grid-align-center">
                                                                <div class="check-box-2 grid-flex  grid-justify-end grid-align-center"></div>
                                                            </div>

                                                        </div>

                                                        <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center">
                                                            12:30 - 15:45
                                                        </div>

                                                        <div class="teamview grid-flex">
                                                            <div class="team grid-flex">
                                                                Team
                                                            </div>
                                                            <div class="meeting grid-flex">
                                                                Meeting
                                                            </div>
                                                        </div>


                                                        <div class="books-design grid-flex grid-flex-1 grid-justify-end grid-align-center">

                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                <div class="books-design-1 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-2 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-3 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    +9
                                                                </div>
                                                            </div>


                                                            <div class="grid-flex  grid-justify-end grid-align-center">
                                                                <div class="books-design-4 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    <i class="fas fa-pen" style="color: #2b6699"></i>
                                                                </div>
                                                                <div class="books-design-5 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    <i class="fas fa-arrow-up p-1"
                                                                       style="transform: rotate(41deg)"></i>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>

                                                </div>


                                                <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                    <div class="award  grid-flex grid-flex-1 grid-col">
                                                        <div class=" grid-flex grid-flex-1 grid-justify-end grid-align-center">
                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                Design Discussion
                                                            </div>
                                                            <div class="check-box-1 grid-flex  grid-justify-end grid-align-center">
                                                                <div class="check-box-2 grid-flex  grid-justify-end grid-align-center">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center">
                                                            16.30 - 20.00
                                                        </div>

                                                        <div class="teamview grid-flex">
                                                            <div class="team grid-flex">
                                                                Team
                                                            </div>
                                                            <div class="meeting grid-flex">
                                                                Meetiong
                                                            </div>
                                                        </div>


                                                        <div class="books-design grid-flex grid-flex-1 grid-justify-end grid-align-center">

                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                <div class="books-design-1 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-2 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-3 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    +2
                                                                </div>
                                                            </div>


                                                            <div class="grid-flex  grid-justify-end grid-align-center">
                                                                <div class="books-design-4 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    <i class="fas fa-pen" style="color: #2b6699"></i>
                                                                </div>
                                                                <div class="books-design-5 grid-flex grid-height-100 grid-width-100 grid-justify-start">
                                                                    <i class="fas fa-arrow-up p-1"
                                                                       style="transform: rotate(41deg)"></i>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="switch-tab-content_3 grid-flex grid-col">
                                            <div class="grid-flex grid-flex-5 pt-2">


                                                <div class="grid-flex grid-flex-4 grid-col ">

                                                    <div class="grid-flex  mb-1">
                                                        <div class="b-w grid-flex grid-col grid-flex-2 mr-1 p-1 "
                                                             style="background: white">
                                                            <div class="today grid-flex">
                                                                Today's Earning
                                                            </div>
                                                            <div class="price grid-flex">
                                                                $2890
                                                            </div>
                                                            <div class="img1 grid-flex">
                                                                <img class="img1" style="width: 100%;height: 100%"
                                                                     src="../image/Annotation.png"
                                                                     alt="fdsf dsa">
                                                            </div>
                                                        </div>
                                                        <div class="demo grid-flex grid-flex-2 grid-col  p-1 grid-justify-center grid-align-center"
                                                             style="background: orange">
                                                            <div class="demographics grid-flex">
                                                                Demographics
                                                            </div>
                                                            <div class="D_price grid-flex">
                                                                20
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="sell grid-flex grid-width-100 grid-height-100"
                                                         style="background: #006666">

                                                        <div class="of grid-flex- grid-col ">
                                                            <div class="sell1 grid-flex mt-3 grid-justify-center grid-align-center">
                                                                20% OFF
                                                            </div>
                                                            <div class="sell2 grid-flex grid-flex-1 grid-justify-center grid-align-center">
                                                                On your first booking
                                                            </div>
                                                            <div class="sell3 grid-flex grid-flex-1 grid-justify-center grid-align-center">
                                                                NEWBIE20
                                                            </div>
                                                            <div class="sell4 grid-flex grid-flex-1 grid-justify-center grid-align-center">
                                                                COPY CODE
                                                            </div>


                                                        </div>

                                                        <div class="img1 grid-flex grid-width-100 grid-height-100">
                                                            <img class="img2" style="width: 100%;height: 100%"
                                                                 src="../image/Annotation1.png"
                                                                 alt="fdsf dsa">

                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="img2 grid-flex grid-flex-3 grid-height-100 grid-width-100 ml-1 mr-1">
                                                    <img class="img1" style="width: 100% ; height: 283px "
                                                         src="../image/tal.png"
                                                         alt="fdsf dsa">

                                                    <div class="grid-flex-radio-white grid-flex grid-align-center grid-justify-center"
                                                         style="height: 40px ; width: 40px">
                                                        <i class="fas fa-arrow-up p-1"
                                                           style="transform: rotate(41deg)"></i>
                                                    </div>
                                                </div>

                                                <div class="img3 grid-flex grid-flex-2 grid-height-100 grid-width-100 grid-col ">
                                                    <div class="img3-1 grid-flex grid-flex-2 grid-height-100 grid-width-100 grid-col "
                                                         style="background-color: white">
                                                        <div class="label-1 grid-flex grid-height-100 grid-width-100 grid-col p-1">
                                                            <div class="grid-flex grid-col">
                                                                <div class="today grid-flex">
                                                                    Today's Earning
                                                                </div>
                                                                <div class="price grid-flex">
                                                                    $2890
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="label-2 grid-flex grid-height-100 grid-width-100 grid-col ml-1"
                                                             style="width: 118px">

                                                            <div class="label-2-1 grid-flex grid-col  grid-width-100  ml-1 p-1 mr-1">
                                                                <div class="grid-flex">
                                                                    Today's Bookings
                                                                </div>
                                                                <div class="label-2-1-24 grid-flex">
                                                                    24
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="label-3 grid-flex grid-height-100 grid-width-100 grid-col">
                                                            <div class="grid-flex grid-col p-1">
                                                                <div class="total grid-flex ">
                                                                    Total Balance
                                                                </div>
                                                                <div class="grid-flex">
                                                                    $2M
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="design grid-flex-2 grid-col mt-1"
                                                         style="background-color: #006666">
                                                        <div class="grid-flex grid-height-100 grid-width-100 grid-col m-1 mt-2">
                                                            <div class="design-1 grid-flex  ">
                                                                Design Meetings
                                                            </div>
                                                            <div class="design-2 grid-flex ">
                                                                11 Min Left
                                                            </div>
                                                            <div class="design-3 grid-flex">
                                                            </div>


                                                            <div class="design-4 grid-flex">
                                                                <div class="grid-flex grid-flex-1">
                                                                    <div class="design-4-1 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                </div>
                                                                <div class="grid-flex grid-flex-1">
                                                                    <div class="design-4-2 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                        08
                                                                    </div>
                                                                </div>
                                                                <div class="grid-flex grid-flex-1 mr-2">
                                                                    <div class="design-4-3 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                        <i class="fas fa-arrow-up grid-justify-center p-1"
                                                                           style="transform: rotate(41deg)"></i>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                            <div class="grid-flex  pt-5">
                                                <div class="book grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end">
                                                    Action Bookings
                                                </div>
                                                <div class="check grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end grid-justify-end">
                                                    Check All <i class="fas fa-angle-right"></i>
                                                </div>
                                            </div>

                                            <div class="grid-flex pt-2">
                                                <div class="action-books grid-flex grid-flex-1 mr-1"
                                                     style="background-color: white">

                                                    <div class="award  grid-flex grid-flex-1 grid-col">
                                                        <div class=" grid-flex grid-flex-1 grid-justify-end grid-align-center">
                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                Award Ceremony
                                                            </div>
                                                            <div class="check-box-1 grid-flex  grid-justify-end grid-align-center">
                                                                <div class="check-box-2 grid-flex  grid-justify-end grid-align-center"></div>
                                                            </div>

                                                        </div>

                                                        <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center">
                                                            12:30 - 15:45
                                                        </div>

                                                        <div class="teamview grid-flex">
                                                            <div class="team grid-flex">
                                                                Team
                                                            </div>
                                                            <div class="meeting grid-flex">
                                                                Meetiong
                                                            </div>
                                                        </div>


                                                        <div class="books-design grid-flex grid-flex-1 grid-justify-end grid-align-center">

                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                <div class="books-design-1 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-2 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-3 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    +9
                                                                </div>
                                                            </div>


                                                            <div class="grid-flex  grid-justify-end grid-align-center">
                                                                <div class="books-design-4 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    <i class="fas fa-pen" style="color: #2b6699"></i>
                                                                </div>
                                                                <div class="books-design-5 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    <i class="fas fa-arrow-up p-1"
                                                                       style="transform: rotate(41deg)"></i>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>

                                                </div>


                                                <div class="design-discussion grid-flex grid-flex-1 grid-height-100 grid-width-100 ml-1">
                                                    <div class="award  grid-flex grid-flex-1 grid-col">
                                                        <div class=" grid-flex grid-flex-1 grid-justify-end grid-align-center">
                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                Design Discussion
                                                            </div>
                                                            <div class="check-box-1 grid-flex  grid-justify-end grid-align-center">
                                                                <div class="check-box-2 grid-flex  grid-justify-end grid-align-center">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center">
                                                            16.30 - 20.00
                                                        </div>

                                                        <div class="teamview grid-flex">
                                                            <div class="team grid-flex">
                                                                Team
                                                            </div>
                                                            <div class="meeting grid-flex">
                                                                Meetiong
                                                            </div>
                                                        </div>


                                                        <div class="books-design grid-flex grid-flex-1 grid-justify-end grid-align-center">

                                                            <div class="grid-flex grid-flex-1 grid-justify-start grid-align-center grid-height-100 grid-width-100">
                                                                <div class="books-design-1 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-2 grid-flex grid-height-100 grid-width-100 grid-justify-start"></div>
                                                                <div class="books-design-3 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    +2
                                                                </div>
                                                            </div>


                                                            <div class="grid-flex  grid-justify-end grid-align-center">
                                                                <div class="books-design-4 grid-flex grid-height-100 grid-width-100 grid-justify-center grid-align-center">
                                                                    <i class="fas fa-pen" style="color: #2b6699"></i>
                                                                </div>
                                                                <div class="books-design-5 grid-flex grid-height-100 grid-width-100 grid-justify-start">
                                                                    <i class="fas fa-arrow-up p-1"
                                                                       style="transform: rotate(41deg)"></i>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="grid-flex grid-flex-2 grid-height-100 grid-width-100" style="background-color: white">
            <div class="grid-flex m-2 grid-col grid-height-100 grid-width-100">
                <div class="grid-flex grid-height-100 grid-width-100">
                    <div class="grid-flex grid-flex-1 ">
                        <i class="letter far fa-envelope grid-height-100 grid-width-100 grid-justify-start grid-align-start">
                            <div class="message_letter grid-flex grid-height-100 grid-width-100 grid-justify-start grid-align-start"></div>
                        </i>


                        <i class="bell far fa-bell grid-flex grid-height-100 grid-width-100 grid-justify-start grid-align-start">
                            <div class="message_bell grid-flex grid-height-100 grid-width-100 grid-justify-start grid-align-start"></div>
                        </i>

                    </div>
                    <div class="last grid-flex grid-flex-2">
                        <div class="grid-flex grid-col">
                            <div class="name_last grid-flex grid-height-100 grid-width-100 grid-justify-end">
                                Kissada Laha
                            </div>
                            <div class="status_last grid-flex grid-height-100 grid-width-100 grid-justify-end">
                                Super Admin
                            </div>
                        </div>

                        <i class="far fa-user-circle"></i>

                    </div>
                </div>
                <div class="grid-flex grid-flex-1 grid-height-100 grid-width-100">
                    <!--                calenadr-->
                    <div class="calendar-x grid-flex grid-col grid-flex-1">
                        <div class="main-header mt-3 grid-flex grid-justify-between mr-2 ml-2 grid-align-end">
                            <div class="header-text grid-flex grid-flex-1">
                                <div class="calendar-x-date"></div>
                                <div class="calendar-x-day"></div>
                            </div>
                            <div class="grid-flex">
                                <div class="calendar-x-btn previous-btn"><i class="fas fa-chevron-left"></i></div>
                                <div class="calendar-x-btn next-btn"><i class="fas fa-chevron-right"></i></div>
                            </div>
                        </div>
                        <div class="calendar-x-content grid-flex grid-col"></div>
                        <div class="calendar-x-period grid-flex grid-col grid-flex-1 pt-3 pb-1 ml-2"></div>
                    </div>
                </div>

            </div>

        </div>
    </div>
<?php JSRegister::begin() ?>
    <script>
        var cm = 0;
        var cm1 = 0;
        // $(document).delegate('.manage', 'click', function () {
        //
        //     $(this).toggleClass('manage_open');
        //     cm +=1;
        // });

        var ckeck = 0;
        window.addEventListener('click', function (e) {

            if (document.getElementById('mana').contains(e.target)) {
                console.log("dwd")
                $('.manage').toggleClass('manage_open');
                // $('.manage').css('display','none');
                ckeck += 1;
            } else {
                if (ckeck % 2 == 1) {
                    $('.manage').toggleClass('manage_open');
                    // $('.manage').css('display','flex');
                    ckeck = 0;
                }
                console.log("ddd")

            }
        })
        var ckeck1 = 0;
        window.addEventListener('click', function (e) {

            if (document.getElementById('mana1').contains(e.target)) {
                console.log("dwd")
                $('.manage1').toggleClass('manage_open');
                // $('.manage').css('display','none');
                ckeck1 += 1;
            } else {
                if (ckeck1 % 2 == 1) {
                    $('.manage1').toggleClass('manage_open');
                    // $('.manage').css('display','flex');
                    ckeck1 = 0;
                }
                console.log("ddd")

            }
        })


        $(document).delegate('.check-box-1', 'click', function () {
            $(this).toggleClass('checked');
        });


        const tabSwicth = function (index = '0') {
            let widthX = $('.switch-tab-x').innerWidth()
            let heightX = $('.switch-tab-view').innerHeight()
            $('.switch-tab-x').css('height', heightX + 'px')
            $('.switch-tab-content').css('width', widthX + 'px')
        }
        const tabSwicth_2 = function (index = '0') {
            let widthX = $('.switch-tab-x_2').innerWidth()
            let heightX = $('.switch-tab-view_2').innerHeight()
            $('.switch-tab-x_2').css('height', heightX + 'px')
            $('.switch-tab-content_2').css('width', widthX + 'px')
        }
        const tabSwicth_3 = function (index = '0') {
            let widthX = $('.switch-tab-x_3').innerWidth()
            let heightX = $('.switch-tab-view_3').innerHeight()
            $('.switch-tab-x_3').css('height', heightX + 'px')
            $('.switch-tab-content_3').css('width', widthX + 'px')
        }


        const handleOnSwicthTab = function (index = '0') {
            let widthX = $('.switch-tab-x').innerWidth()
            $('.switch-tab-view').css('left', '-' + (index * widthX) + 'px')
        }
        const handleOnSwicthTab_2 = function (index = '0') {
            let widthX = $('.switch-tab-x_2').innerWidth()
            $('.switch-tab-view_2').css('left', '-' + (index * widthX) + 'px')
        }
        const handleOnSwicthTab_3 = function (index = '0') {
            let widthX = $('.switch-tab-x_3').innerWidth()
            $('.switch-tab-view_3').css('left', '-' + (index * widthX) + 'px')
        }


        $(document).ready(function () {
            tabSwicth();
            tabSwicth_2();
            tabSwicth_3();
        })




        $(document).delegate('.over-item', 'click', function () {
            let data_index = $(this).attr('data-index');
            $('.over-item').removeClass('over-active');
            $(this).addClass('over-active');
            if(data_index=="1"){
                $('.booking').removeClass('tab-1');
                $('.first-tab').addClass('tab-1');
                $('.switch-tab-view_2').css('left','0');

                if(cm%2==1){

                    cm = 0;
                    $('.manage').toggleClass('manage_open');
                }
            }
            if(data_index=="0"){
                $('.booking_2').removeClass('tab-01');
                $('.frist-tab-01').addClass('tab-01');
                $('.switch-tab-view_3').css('left','0');
                if(cm1%2==1){
                    cm1 = 0;
                    $('.manage1').toggleClass('manage_open');
                }
            }



            handleOnSwicthTab(data_index);

        })
        $(document).delegate('.booking', 'click', function () {

            let data_index1 = $(this).attr('data_index1');
            $('.booking').removeClass('tab-1');
            $(this).addClass('tab-1');
            console.log($('.booking'))
            handleOnSwicthTab_2(data_index1);

        })
        $(document).delegate('.booking_2', 'click', function () {
            let data_index2 = $(this).attr('data_index2');
            $('.booking_2').removeClass('tab-01');
            $(this).addClass('tab-01');
            handleOnSwicthTab_3(data_index2);
        })


        //ปฏิทิน


        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const dayNames = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        const dayNameShort = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        const mainTime = ["8:00", "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30"];
        var dateMain = new Date()
        var dateNowMain = dateMain.getDate()

        const renderCalendarX = function (date = new Date()) {
            let dateCarX = date

            $('.calendar-x-date').html(`${dateCarX.getFullYear()} ${monthNames[dateCarX.getMonth()]}, ${dateCarX.getDate()}`)
            $('.calendar-x-day').html(`${dayNames[dateCarX.getDay() - 1]}`)

            let _this = $('.calendar-x-content')
            _this.empty()

            let dayRow = $('<div/>').attr({
                "class": "header-calendar-x-row grid-flex grid-justify-center grid-align-center grid-width-100 pt-1"
            })

            dayNameShort.forEach(function (item, key) {
                dayRow.append(`<div class="header-calendar-x grid-flex grid-align-center grid-justify-center">${item}</div>`)
            })

            _this.append(dayRow)


            let dateRow = $('<div/>').attr({
                "class": "header-calendar-x-date grid-flex grid-align-center grid-width-100 grid-wrap"
            })
            var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
            var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0)
            let startDate = firstDay.getDay()
            var lastDayAgo = parseInt(new Date(date.getFullYear(), date.getMonth(), 0).getDate())
            if (startDate > 1) {
                for (let j = startDate - 1; j >= 0; j--) {
                    dateRow.append(`<div class="body-calendar-date grid-flex grid-align-center grid-justify-center"><div class="date-x-last">${lastDayAgo - j}</div></div>`)
                }
            }

            for (let i = 1; i <= lastDay.getDate(); i++) {
                if (new Date().setHours(0, 0, 0, 0) == new Date(dateMain.getFullYear(), dateMain.getMonth(), i).setHours(0, 0, 0, 0)) {
                    dateRow.append(`<div class="body-calendar-date grid-flex grid-align-center grid-justify-center"><div class="now-date">${i}</div></div>`)
                } else if (i == dateNowMain) {
                    dateRow.append(`<div class="body-calendar-date grid-flex grid-align-center grid-justify-center"><div class="date-now-x">${i}</div></div>`)
                } else {
                    dateRow.append(`<div class="body-calendar-date grid-flex grid-align-center grid-justify-center"><div class="date-x">${i}</div></div>`)
                }
            }

            if (lastDay.getDay() < 6) {
                let nextDate = 7 - lastDay.getDay()
                for (let k = 1; k < nextDate; k++) {
                    dateRow.append(`<div class="body-calendar-date grid-flex grid-align-center grid-justify-center"><div class="date-x-last">${k}</div></div>`)
                }
            }

            _this.append(dateRow)
            let _thisX = $('.calendar-x-period')
            _thisX.empty()
            mainTime.forEach(function (item, key) {
                _thisX.append(`<div class="body-period grid-flex grid-align-end grid-flex-1"><div class="period-time">${item}</div><div class="period-activity ml-2 bb-1"></div></div>`)
            })

        }


        $(document).delegate('.previous-btn', 'click', function () {
            dateMain = new Date(dateMain.getFullYear(), dateMain.getMonth() - 1, dateNowMain)
            renderCalendarX(dateMain)
        })
        $(document).delegate('.next-btn', 'click', function () {
            dateMain = new Date(dateMain.getFullYear(), dateMain.getMonth() + 1, dateNowMain)
            renderCalendarX(dateMain)
        })


        $(document).ready(function () {
            let dateCarX = new Date()
            renderCalendarX(dateCarX)
        })


        var data = '<?= $data?>'
        var s = JSON.parse(data)
        var data_price = '<?= $data_price?>'
        var s1 = JSON.parse(data_price)


        var _date = new Date()
        var _month = _date.getMonth() + 1
        var _year = _date.getFullYear()
        var _day = _date.getDate()

        const monthNames1 = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


        const dataForYear = function (data) {
            let returnDataLabel = []
            let datacat_amount_year = 0
            let data_cat = []
            let data_order = []
            let dataorder = 0
            if (data) {
                Object.keys(data).forEach(function (item, key) {
                    returnDataLabel.push(item)
                    let cat_amount_year = 0
                    let order_amount_year = 0
                    Object.keys(data[item]).forEach(function (itemMonth, key) {
                        Object.keys(data[item][itemMonth]).forEach(function (itemDay, key) {

                            cat_amount_year += parseInt(data[item][itemMonth][itemDay].cat_amount)
                            order_amount_year += parseInt(data[item][itemMonth][itemDay].order_amount)
                            dataorder += parseInt(data[item][itemMonth][itemDay].order_amount)
                        })

                    })
                    datacat_amount_year += cat_amount_year
                    data_cat.push((cat_amount_year) ? cat_amount_year : 0)
                    data_order.push((order_amount_year) ? order_amount_year : 0)
                })
            }
            return {
                label: returnDataLabel,

                data_cat: data_cat,

                data_order: data_order,

                cat_year: datacat_amount_year,

                order: dataorder
            }
        }
        const datapriceForYear = function (data_prcie) {
            let price_year = 0;
            let cost_year = 0;
            let price_month = 0;
            let cost_month = 0;
            if (data_prcie) {
                Object.keys(data_prcie).forEach(function (item) {
                    Object.keys(data_prcie[item]).forEach(function (itemMonth) {
                        price_year += parseInt((data_prcie[item][itemMonth]['yearlyPrice']) ? data_prcie[item][itemMonth]['yearlyPrice'] : 0)
                        cost_year += parseInt((data_prcie[item][itemMonth]['costYearlyPrice']) ? data_prcie[item][itemMonth]['costYearlyPrice'] : 0)
                        if (data_prcie[item][itemMonth]['year'] == _year) {

                            price_month += parseInt((data_prcie[item][itemMonth]['monthlyPrice']) ? data_prcie[item][itemMonth]['monthlyPrice'] : 0)
                        }
                        if (data_prcie[item][itemMonth]['year'] == _year) {

                            cost_month += parseInt((data_prcie[item][itemMonth]['costMonthlyPrice']) ? data_prcie[item][itemMonth]['costMonthlyPrice'] : 0)
                        }

                    })
                })


            }
            return {
                price_year: price_year,
                cost_year: cost_year,
                price_month: price_month,
                cost_month: cost_month
            }
        }


        const dataForMonth = function (data) {

            let returnDataset = []

            let datacat_amount_month = 0

            let datacat = []
            let data_order = []

            let dataorder = 0


            if (data) {

                Object.keys(data[_year]).forEach(function (itemMonth, key) {
                    returnDataset.push(itemMonth)
                    let cat_amount_month = 0
                    let order_amount_month = 0
                    Object.keys(data[_year][itemMonth]).forEach(function (itemDay, key) {


                        cat_amount_month += parseInt(data[_year][itemMonth][itemDay].cat_amount)

                        dataorder += parseInt(data[_year][itemMonth][itemDay].order_amount)

                        order_amount_month += parseInt(data[_year][itemMonth][itemDay].order_amount)
                        // order_amount_month += parseInt(data[_year][itemMonth][itemDay].order_amount)


                    })
                    datacat_amount_month += cat_amount_month
                    datacat.push((cat_amount_month) ? cat_amount_month : 0)
                    data_order.push((order_amount_month) ? order_amount_month : 0)
                })
            }
            return {

                set: returnDataset,
                cat_month: datacat_amount_month,
                order: dataorder,
                data_cat: datacat,
                data_order: data_order

            }
        }

        const datapriceForDay = function (data_price) {
            let price_day = 0;
            let cost_day = 0;
            let price_today = 0;
            let cost_today = 0;
            if (data_price) {

                Object.keys(data_price['daily']).forEach(function (item) {
                    if (data_price['daily'][item]['year'] == _year && data_price['daily'][item]['month'] == _month){
                        price_day += parseInt((data_price['daily'][item]['dailyPrice']) ? data_price['daily'][item]['dailyPrice'] : 0)
                    }

                    if (data_price['daily'][item]['year'] == _year && data_price['daily'][item]['month'] == _month){
                        cost_day += parseInt((data_price['daily'][item]['costDailyPrice']) ? data_price['daily'][item]['costDailyPrice'] : 0)
                    }


                    if (data_price['daily'][item]['day'] == _day) {
                        price_today += parseInt((data_price['daily'][item]['dailyPrice']) ? data_price['daily'][item]['dailyPrice'] : 0)
                    }
                    if (data_price['daily'][item]['day'] == _day) {
                        cost_today += parseInt((data_price['daily'][item]['costDailyPrice']) ? data_price['daily'][item]['costDailyPrice'] : 0)
                    }


                })


            }
            return {
                price_day: price_day,
                price_today: price_today,
                cost_day: cost_day,
                cost_today : cost_today
            }
        }


        const dataForDay = function (data) {

            let returnDataday = []
            let datacat_amount_day = 0
            let dataorder_amount_day = []
            let dataorder = 0
            let data_cat = []

            if (data) {


                Object.keys(data[_year][_month]).forEach(function (itemDay, key) {
                    returnDataday.push(data[_year][_month][itemDay].date)
                    let cat_amount_day = 0
                    let order_amount_day = 0


                    datacat_amount_day += parseInt(data[_year][_month][itemDay].cat_amount)
                    dataorder += parseInt(data[_year][_month][itemDay].order_amount)


                    cat_amount_day += parseInt(data[_year][_month][itemDay].cat_amount)
                    order_amount_day += parseInt(data[_year][_month][itemDay].order_amount)
                    data_cat.push((cat_amount_day) ? cat_amount_day : 0)
                    dataorder_amount_day.push((order_amount_day) ? order_amount_day : 0)


                })

            }

            return {
                day: returnDataday,
                cat: datacat_amount_day,
                order: dataorder,
                data_cat: data_cat,
                data_order: dataorder_amount_day,


            }
        }
        const dataFortoDay = function (data) {

            let returnDatatoday = []
            let datacat_amount_today = []
            let dataorder_amount_today = []
            let datacat1_amount_today = 0
            let dataorder = 0
            let cat_amount_today = 0
            let order_amount_today = 0
            if (data[_year][_month][_day] !== undefined) {
                returnDatatoday.push(data[_year][_month][_day].date)


                cat_amount_today += parseInt((data[_year][_month][_day]) ? data[_year][_month][_day].cat_amount : 0)
                order_amount_today += parseInt((data[_year][_month][_day]) ? data[_year][_month][_day].order_amount : 0)

                dataorder += parseInt((data[_year][_month][_day]) ? data[_year][_month][_day].order_amount : 0)


                datacat1_amount_today += cat_amount_today

                datacat_amount_today.push((cat_amount_today) ? cat_amount_today : 0)
                dataorder_amount_today.push((order_amount_today) ? order_amount_today : 0)

            }

            return {
                day: returnDatatoday,
                data_cat: datacat_amount_today,
                cat: datacat1_amount_today,
                order: dataorder,
                data_order: dataorder_amount_today

            }

        }


        let cat_year = dataForYear(s)
        let cat_month = dataForMonth(s)
        let cat_day = dataForDay(s)
        let cat_today = dataFortoDay(s)


        let cat_price_year = datapriceForYear(s1)
        let cat_price_day = datapriceForDay(s1)


        const persent = function (data,data1) { // ฟังก์ชั่น 30 Percent
            let per = data - data1;
            return {
                per: per
            }
        }


        let p_today = persent(cat_price_day.price_today,cat_price_day.cost_today)
        let p_day = persent(cat_price_day.price_day,cat_price_day.cost_day)
        let p_month = persent(cat_price_year.price_month,cat_price_year.cost_month)
        let p_year = persent(cat_price_year.price_year,cat_price_year.cost_year)


        $('.price_cat_today').html(cat_price_day.price_today.toLocaleString())
        $('.cost_cat_today').html(cat_price_day.cost_today.toLocaleString())
        $('.datacat_amount_today').html(cat_today.cat)
        $('.datacat_persent_today').html(p_today.per.toLocaleString())


        $('.price_cat_day').html(cat_price_day.price_day.toLocaleString())
        $('.cost_cat_day').html(cat_price_day.cost_day.toLocaleString())
        $('.datacat_amount_day').html(cat_day.cat)
        $('.datacat_persent_day').html(p_day.per.toLocaleString())


        $('.price_cat_month').html(cat_price_year.price_month.toLocaleString())
        $('.cost_cat_month').html(cat_price_year.cost_month.toLocaleString())
        $('.datacat_amount_month').html(cat_month.cat_month)
        $('.datacat_persent_month').html(p_month.per.toLocaleString())

        $('.price_cat_year').html(cat_price_year.price_year.toLocaleString())
        $('.cost_cat_year').html(cat_price_year.cost_year.toLocaleString())
        $('.datacat_amount_year').html(cat_year.cat_year)
        $('.datacat_persent_year').html(p_year.per.toLocaleString())

        //    graph---------------------------------------------------------------------


        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: [cat_today.day],
                datasets: [
                    {
                        label: "Cat",
                        backgroundColor: "#2db2c4",
                        data: [cat_today.data_cat]
                    }, {
                        label: "Order",
                        backgroundColor: "#e56925",
                        data: [cat_today.data_order]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            labelString: "amount",
                            display: true,
                        },
                        ticks: {

                            beginAtZero: true,
                            stepSize: 1

                        }

                    }],
                    xAxes: [{
                        scaleLabel: {
                            labelString: "Today",
                            display: true,
                        },


                    }]

                }


            }

        });

        //---------------------------------------------------------------------------------

        new Chart(document.getElementById("bar-chart-grouped2"), {
            type: 'bar',
            data: {
                labels: cat_day.day,
                datasets: [
                    {
                        label: "Cat",
                        backgroundColor: "#2db2c4",
                        data: cat_day.data_cat
                    }, {
                        label: "Order",
                        backgroundColor: "#e56925",
                        data: cat_day.data_order
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            labelString: "amount",
                            display: true,
                        },
                        ticks: {

                            beginAtZero: true,
                            stepSize: 1

                        }

                    }],
                    xAxes: [{
                        scaleLabel: {
                            labelString: "Date",
                            display: true,
                        },


                    }]

                }


            }

        });
        //    graph---------------------------------------------------------------------
        new Chart(document.getElementById("bar-chart-grouped3"), {
            type: 'bar',
            data: {
                labels: cat_month.set,
                datasets: [
                    {
                        label: "Cat",
                        backgroundColor: "#2db2c4",
                        data: cat_month.data_cat
                    }, {
                        label: "Order",
                        backgroundColor: "#e56925",
                        data: cat_month.data_order
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            labelString: "amount",
                            display: true,
                        },
                        ticks: {

                            beginAtZero: true,
                            stepSize: 1

                        }

                    }],
                    xAxes: [{
                        scaleLabel: {
                            labelString: "Month",
                            display: true,
                        },
                    }]

                }


            }

        });


        //---------------------------------------------------------------------------------

        new Chart(document.getElementById("bar-chart-grouped4"), {
            type: 'bar',
            data: {
                labels: cat_year.label,
                datasets: [
                    {
                        label: "Cat",
                        backgroundColor: "#2db2c4",
                        data: cat_year.data_cat
                    }, {
                        label: "Order",
                        backgroundColor: "#e56925",
                        data: cat_year.data_order
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            labelString: "amount",
                            display: true,
                        },
                        ticks: {

                            beginAtZero: true,
                            stepSize: 1

                        }

                    }],
                    xAxes: [{
                        scaleLabel: {
                            labelString: "Year",
                            display: true,
                        },


                    }]

                }


            }

        });


    </script>


<?php JSRegister::end();
