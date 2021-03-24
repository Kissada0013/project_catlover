<?php


?>

<?php use richardfan\widget\JSRegister;


JSRegister::begin() ?>
<script>

    var data = '<?= $data?>'

    $(document).ready(function () {
       const dataForYear = function (data) {
           let returnDataLabel = []
           let returnDataset = []
           if (data) {
               Object.keys(data).forEach(function (item, key) {
                   returnDataLabel.push(item)
                   let cat_amount = 0

                   let order_amount = 0
                   Object.keys(data[item]).forEach(function (itemMonth, key) {
                       Object.keys(data[item][itemMonth]).forEach(function (itemDay, key) {
                           console.log(data[item][itemMonth][itemDay])
                           cat_amount += parseInt(data[item][itemMonth][itemDay].cat_amount)
                           order_amount += parseInt(data[item][itemMonth][itemDay].order_amount)
                           console.log(order_amount)
                       })
                   })
                   returnDataset.push({cat_amount, order_amount})
               })
           }
           return {label: returnDataLabel, set: returnDataset}
       }
    })


</script>

<?php JSRegister::end() ?>