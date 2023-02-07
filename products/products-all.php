<?php
include_once "../includes/includes.php";
global $objFormFields;

?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([["title" => "All Products", "active" => true]])?>
    </div>
    <div>
        <a href = "../products/?_action=add" class="btn btn-primary"><i class="fa fa-plus m-1"></i>ADD NEW PRODUCT</a>
    </div>
</div>
<div class="custom-container">
    <?php
        $columnArray[] = ["id" => "id", "title" => "ID"];
        $columnArray[] = ["id" => "code", "title" => "CODE"];
        $columnArray[] = ["id" => "title", "title" => "TITLE"];
        $columnArray[] = ["id" => "unit", "title" => "UNIT"];
        $columnArray[] = ["id" => "buyingPrice", "title" => "BUYING PRICE"];
        $columnArray[] = ["id" => "sellingPrice", "title" => "SELLING PRICE"];
        $columnArray[] = ["id" => "status", "title" => "ACTIVE"];

        $operationArray[] = ["icon" => "fa fa-eye", "class" => "btn-warning","url" => "../products/?_action=view"];
        $operationArray[] = ["icon" => "fa fa-pencil-alt", "class" => "btn-primary","url" => "../products/?_action=edit"];
        echo $objFormFields->grid("product-all","id","products.php?action=all",$columnArray,$operationArray);
    ?>
</div>