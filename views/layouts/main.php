<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

$this->registerCssFile('@web/css/loading.css', ['depends' => [JqueryAsset::className()]]);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
JSRegister::begin();
?>
<script>
    var _csrf = "<?= Yii::$app->request->csrfToken; ?>";
    var UrlBase = "<?=Url::home()?>";
</script>
<?php
JSRegister::end();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <!--  Bootstrap 4 toggle -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    if (Yii::$app->requestedRoute == 'site/login') {


    } else {
        NavBar::begin([
            'brandLabel' => 'Cat Lover',
            'brandUrl' => '/cat/index',
            'options' => [
                'class' => 'navbar',
            ],


        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [

                ['label' => 'ข้อมูลการซื้อ', 'url' => ['/cat/check'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'ข้อมูลการจัดส่ง', 'url' => ['/cat/deli'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('Admin')],
                ['label' => 'ฟาร์ม', 'url' => ['/farm/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'สอบถาม', 'class' => 'btn', 'url' => ['/ques/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'รีวิว', 'url' => ['/cat/review'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'ยอดขาย', 'url' => ['/cat/sale'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('Admin')],
                ['label' => 'โปรไฟล์', 'url' => ['/site/update'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('User')],
                ['label' => 'ข้อมูลร้าน', 'url' => ['/store/index'], 'visible' => !Yii::$app->user->isGuest],
                ['label' => 'ข้อมูลบัญชี', 'url' => ['/bank/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('Admin')],
                ['label' => 'ข้อมูลลูกค้า', 'url' => ['/users/index'], 'visible' => !Yii::$app->user->isGuest && Yii::$app->user->can('Admin')],


                Yii::$app->user->isGuest ? (
                ['label' => 'เข้าสู่ระบบ', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'ออกจากระบบ (' . Yii::$app->user->identity->name . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
    }

    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer" style="background: #61c7c1a8">

</footer>


<div class="back-image">
    <div class="image1">
        <img class="img1" src="../image/cat1.png" alt="fdsf dsa">
    </div>
    <div class="image2">
        <img class="img2" src="../image/2.png" alt="fdsf dsa">
        <img class="img2" src="../image/2.png" alt="fdsf dsa">
        <img class="img2" src="../image/2.png" alt="fdsf dsa">
        <img class="img2" src="../image/2.png" alt="fdsf dsa">
    </div>
</div>


<?php $this->endBody() ?>
</body>


<?php JSRegister::begin(); ?>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            // $(".back-image").fadeOut(5000);
            $(".back-image").fadeOut("slow");

        }, 500)
    });
</script>
<?php JSRegister::end(); ?>


</html>
<?php $this->endPage() ?>
