<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;
$id       = getValue("_id");
$product  = [];
try{
    $result = $objDatabase->dbQuery("SELECT * FROM products WHERE id = '$id' ");
    if($objDatabase->dbRowsCount($result)){
        $product = $objDatabase->dbFetch($result);
    }
    else{
        throw new Exception("No item found",403);
    }
}
catch (Exception $e) {
    die($e->getMessage());
}


?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Products", "url" => "../products/"],
            ["title" => "View Product - ".$product["code"], "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>VIEW PRODUCT - <?php echo $product["code"];?></h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo $objFormFields->labelField("Title", $product["title"]); ?>
            <?php echo $objFormFields->labelField("Unit", $product["unit"]); ?>
            <?php echo $objFormFields->labelField("Buying Price", $product["buyingPrice"]); ?>
            <?php echo $objFormFields->labelField("Selling Price", $product["sellingPrice"]); ?>
            <?php echo $objFormFields->labelField("Status", $product["status"]?"Active":"Inactive"); ?>
            <?php echo $objFormFields->labelField("Added", $product["addedBy"]." | ".$product["addedAt"]); ?>
            <?php echo $objFormFields->labelField("Updated", $product["updatedBy"]." | ".$product["updatedAt"]); ?>
        </div>
    </div>
</div>
<script>
</script>