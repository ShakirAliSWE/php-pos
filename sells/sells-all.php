<?php
include_once "../includes/includes.php";
global $objFormFields;

?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([["title" => "All Sells", "active" => true]])?>
    </div>
    <div>
        <a href = "../sells/?_action=add" class="btn btn-primary"><i class="fa fa-plus m-1"></i>ADD NEW SELL</a>
    </div>
</div>
<div class="custom-container">
    <?php
    $columnArray[] = ["id" => "id", "title" => "ID"];
    $columnArray[] = ["id" => "code", "title" => "CODE"];
    $columnArray[] = ["id" => "date", "title" => "DATE"];
    $columnArray[] = ["id" => "totalItems", "title" => "TOTAL ITEMS"];
    $columnArray[] = ["id" => "totalAmount", "title" => "TOTAL AMOUNT"];

    $operationArray[] = ["icon" => "fa fa-eye", "class" => "btn-warning","url" => "../sells/?_action=view"];
    echo $objFormFields->grid("sell-all","id","sells.php?action=all",$columnArray,$operationArray);
    ?>
</div>
