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


echo $objFormFields->breadCrumb([
    ["title" => "All Products", "url" => "../products/"],
    ["title" => "Delete Product - ".$product["code"], "active" => true]
]);

?>

<div class="custom-container">
    <div class="text-center mb-2">
        <h5 class="mb-4">DELETE PRODUCT - <?php echo $product["code"];?></h5>
        <div class="mb-2"><i class="fa fa-trash fa-9x text-danger"></i></div>
        <div class= "">
            <a href = "../products/" class="btn btn-info" style="width: 160px;">No</a>
            <a onclick="deleteRecord();" class="btn btn-danger" style="width: 160px;">YES DELETE</a>
        </div>
    </div>
</div>
<script>
    function deleteRecord(){
        let id = "<?php echo $id;?>";

        let params = {
            action : "delete",
            id : id,
        };

        confirmationRequest("Do you want to delete this record?",()=>{
            requestAjax("../api/products.php",params,(success)=>{
                let response = JSON.parse(success);
                toastMessage("SUCCESS",response.message,"success");
                window.location = `../products/`;
            });
        });
    }
</script>