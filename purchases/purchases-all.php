<?php
include_once "../includes/includes.php";
global $objFormFields;

?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([["title" => "All Purchases", "active" => true]])?>
    </div>
    <div>
        <a href = "../purchases/?_action=add" class="btn btn-primary"><i class="fa fa-plus m-1"></i>ADD NEW PURCHASE</a>
    </div>
</div>
<div class="custom-container">
    <?php
    $columnArray[] = ["id" => "id", "title" => "ID"];
    $columnArray[] = ["id" => "code", "title" => "CODE"];
    $columnArray[] = ["id" => "date", "title" => "DATE"];
    $columnArray[] = ["id" => "totalItems", "title" => "TOTAL ITEMS"];
    $columnArray[] = ["id" => "totalAmount", "title" => "TOTAL AMOUNT"];

    $operationArray[] = ["icon" => "fa fa-eye", "class" => "btn-warning","url" => "../purchases/?_action=view"];
    echo $objFormFields->grid("purchase-all","id","purchases.php?action=all",$columnArray,$operationArray);
    ?>
</div>