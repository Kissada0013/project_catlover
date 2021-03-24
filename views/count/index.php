<?php
/* @var $this yii\web\View */

use richardfan\widget\JSRegister;
use yii\helpers\Html;

$total = 0;
?>

<table class="table table-bordered">

    <tbody>


    <th>
        Name
    </th>
    <th>
        Code
    </th>
    <th>
        Color
    </th>
    <th>
        Weight
    </th>
    <th>
        Price
    </th>
    <? $total = 0 ?>

    <?php
    foreach ($datacat as $data) {
        ?>
        <tr>
            <td>
                <?php
                echo $data['pass']
                ?>
            </td>
            <td>
                <?php
                echo $data['name']
                ?>
            </td>
            <td>
                <?php
                echo $data['color']
                ?>
            </td>
            <td>
                <?php
                echo $data['weight']
                ?>
            </td>
            <td>
                <?php
                echo number_format($data['price'], 2, ".", ",");
                $total += $data['price']
                ?>
            </td>
        </tr>
    <?php } ?>


    </tbody>
    <tfoot>
    <tr>

        <th colspan="4" style="text-align: end">total</th>
        <th><?= number_format($total, 2, ".", ","); ?></th>

    </tr>
    </tfoot>

</table>


<?php {
    $total = 0;
    echo Html::a('upload', ['upload'], ['class' => 'btn btn-success']);

} ?>


