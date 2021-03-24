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
    <style>
      .manage:hover{
          background-color: #eaeaea;
          width: 25px;
          height: 25px;
          padding-right: 9px;
          padding-bottom: 4px;
          /*color: white;*/
          border-radius: 50%;
      }
        .manage{
            /*background-color: #eaeaea;*/
      width: 25px;
            height: 25px;
            padding-right: 9px;
            padding-bottom: 4px;
            /*color: white;*/
            border-radius: 50%;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <div class="body grid-flex site-contact">
        <div class="grid-flex grid-flex-4" style="background-color: #0c5460">

            <div class="grid-flex grid-col grid-flex-2">
                <div class="p-3">

                    <div class="grid-flex">
                        <div class="ying-yang"></div>

                    </div>

                    <div class="switch-tab-x">
                        <div class="switch-tab-view grid-flex">
                            <div class="switch-tab-content grid-flex grid-col">


                                <div class="grid-flex  pt-5">
                                    <div class="Main grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end">
                                        Main Dashboard
                                    </div>
                                    <div class="grid-flex grid-flex-1 grid-height-100 grid-width-100   grid-align-end grid-justify-end">
                                        <div class="manage grid-flex  grid-align-end grid-justify-end mr-5" id="mana">
                                            <i class="fas fa-ellipsis-v"></i>

                                            <div class="menu grid-flex grid-col grid-align-center ">
                                                <div class="add menu-item pt-1 grid-height-100 grid-width-100" id="add">
                                                    Day
                                                </div>
                                                <div class="edit menu-item pt-1 grid-height-100 grid-width-100"
                                                     id="edit">
                                                    Month
                                                </div>
                                                <div class="delete menu-item pt-1 grid-height-100 grid-width-100"
                                                     id="delete">
                                                    Year
                                                </div>
                                            </div>
                                        </div>
                                        <div class="display grid-flex" id="display">click me</div>
                                        <div class="display1 grid-flex" style="display: none" id="display">display
                                        </div>
                                    </div>
                                </div>


                                <!----------------------------------------->
                                <div class="switch-tab-x_2">
                                    <div class="switch-tab-view_2 grid-flex">

                                        <div class="switch-tab-content_2 content-grap grid-flex  grid-col">
                                            <!---------------------------graph-------------------------------------------->
                                            <div class="grid-flex mt-2 grid-flex grid-flex-1 ">


                                                <div class="graph grid-flex grid-flex-3 grid-col">
                                                    <canvas id="bar-chart-grouped" width="800" height="500"></canvas>
                                                </div>


                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!--  ---------------------------------------->
                            </div>


                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
<?php JSRegister::begin() ?>
    <script>
        var cm = 0;
        var cm1 = 0;

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
            if (data_index == "1") {
                $('.booking').removeClass('tab-1');
                $('.first-tab').addClass('tab-1');
                $('.switch-tab-view_2').css('left', '0');

                if (cm % 2 == 1) {
                    cm = 0;
                    $('.manage').toggleClass('manage_open');
                }
            }
            if (data_index == "0") {
                $('.booking_2').removeClass('tab-01');
                $('.frist-tab-01').addClass('tab-01');
                $('.switch-tab-view_3').css('left', '0');
                if (cm1 % 2 == 1) {
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
                day: returnDataLabel,

                data_cat: data_cat,

                data_order: data_order,

                cat_year: datacat_amount_year,

                order: dataorder
            }
        }
        const datapriceForYear = function (data_prcie) {
            let price_year = 0;
            let price_month = 0;
            if (data_prcie) {
                Object.keys(data_prcie).forEach(function (item) {
                    Object.keys(data_prcie[item]).forEach(function (itemMonth) {
                        price_year += parseInt((data_prcie[item][itemMonth]['yearlyPrice']) ? data_prcie[item][itemMonth]['yearlyPrice'] : 0)
                        if (data_prcie[item][itemMonth]['year'] == _year) {

                            price_month += parseInt((data_prcie[item][itemMonth]['monthlyPrice']) ? data_prcie[item][itemMonth]['monthlyPrice'] : 0)
                        }

                    })
                })


            }
            return {
                price_year: price_year,
                price_month: price_month
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

                day: returnDataset,
                cat_month: datacat_amount_month,
                order: dataorder,
                data_cat: datacat,
                data_order: data_order

            }
        }

        const datapriceForDay = function (data_price) {
            let price_day = 0;
            let price_today = 0;
            if (data_price) {

                Object.keys(data_price['daily']).forEach(function (item) {
                    if (data_price['daily'][item]['year'] == _year && data_price['daily'][item]['month'] == _month)


                        price_day += parseInt((data_price['daily'][item]['dailyPrice']) ? data_price['daily'][item]['dailyPrice'] : 0)

                    if (data_price['daily'][item]['day'] == _day) {
                        price_today += parseInt((data_price['daily'][item]['dailyPrice']) ? data_price['daily'][item]['dailyPrice'] : 0)
                    }
                })


            }
            return {
                price_day: price_day,
                price_today: price_today
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


        const persent = function (data) { // ฟังก์ชั่น 30 Percent
            let per = data * 30 / 100;
            return {
                per: per
            }
        }

        let p_today = persent(cat_price_day.price_today)
        let p_day = persent(cat_price_day.price_day)
        let p_month = persent(cat_price_year.price_month)
        let p_year = persent(cat_price_year.price_year)

        var invo = {
            type: 'bar',
            data: {
                labels: [cat_today.day],
                datasets: [
                    {
                        label: "Cat",
                        backgroundColor: "#00DBDE",

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
                            labelString: "Day",
                            display: true,
                        },


                    }]

                }


            }

        }

        var www = new Chart(document.getElementById("bar-chart-grouped"), invo);


        $(document).delegate('.menu-item', 'click', function () {

            var a = cat_today.data_cat;
            var b = cat_day.data_cat;
            var c = cat_month.data_cat;
            var d = "day";


            if ($(this).attr('id') == 'add') {
                console.log($(this).attr('id'))
                a = cat_day.data_cat;
                b = cat_day.data_order;
                c = cat_day.day
                d = "day"

            }
            if ($(this).attr('id') == 'edit') {
                console.log($(this).attr('id'))
                a = cat_month.data_cat;
                b = cat_month.data_order;
                c = cat_month.day
                d = "Month"
            }
            if ($(this).attr('id') == 'delete') {
                console.log($(this).attr('id'))
                a = cat_year.data_cat;
                b = cat_year.data_order;
                c = cat_year.day
                d = "Year"
            }
            invo.data = {
                ...invo.data,
                labels: c,
                datasets: [
                    {
                        ...invo.data.datasets[0],
                        data: a,

                    },
                    {
                        ...invo.data.datasets[1],
                        data: b
                    }
                ],

            }
            invo.options = {
                ...invo.options,
                scales:
                    {

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
                                labelString: d,
                                display: true,
                            },


                        }]
                    },


            }


            www.data = invo.data
            www.options = invo.options
            www.update();


        })



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
        window.addEventListener('click', function (e) {


            if (document.getElementById('display').contains(e.target)) {
                $('.display').css('display', 'none');
                $('.display1').css('display', 'flex');

            } else {


                $('.display').css('display', 'flex');
                $('.display1').css('display', 'none');

            }
        })


    </script>


<?php JSRegister::end();


