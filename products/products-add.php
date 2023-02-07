<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;

?>

<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Products", "url" => "../products/"],
            ["title" => "Add Product", "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>ADD NEW PRODUCT</h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form onsubmit="return formOnSubmit();" >
            <div class="mb-3">
                <?php echo $objFormFields->inputText("title", "Title", "", "Enter Product Title", true) ?>
            </div>
            <div class="mb-3">
                <?php
                    $optionsUnits = [
                            ["id" => "unit", "title" => "Unit","value" => "unit"],
                            ["id" => "kg", "title" => "Kg","value" => "kg"],
                            ["id" => "liter", "title" => "Liter","value" => "liter"],
                    ];
                    echo $objFormFields->inputRadio("unit", "Unit", $optionsUnits, "unit", true)
                ?>
            </div>
            <div class="mb-3">
                <?php echo $objFormFields->inputNumber("buyingPrice", "Buying Price", "", "Enter Buying Price", true) ?>
            </div>
            <div class="mb-3">
                <?php echo $objFormFields->inputNumber("sellingPrice", "Selling Price", "", "Enter Selling Price", true) ?>
            </div>
            <div class="mb-3">
                <?php  echo $objFormFields->inputCheckBox("status", "Status",1); ?>
            </div>
            <div class="mb-3 text-end">
                <button type = "submit" class="btn btn-primary m-1" style="width: 220px;">SAVE RECORD</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function formOnSubmit(){
        let title        = $("#title").val();
        let unit         = $(`input[name="unit"]:checked`).val();
        let buyingPrice  = $("#buyingPrice").val();
        let sellingPrice = $("#sellingPrice").val();
        let status       = $("#status").is(":checked")?1:0;

        if(title === ""){
            return formFieldError("title");
        }

        if(buyingPrice === "" || buyingPrice === "0"){
            return formFieldError("buyingPrice");
        }

        if(sellingPrice === "" || sellingPrice === "0"){
            return formFieldError("sellingPrice");
        }

        let params = {
            action : "add",
            title : title,
            unit : unit,
            buyingPrice : buyingPrice,
            sellingPrice : sellingPrice,
            status : status
        };

        confirmationRequest("Do you want to add this record?",()=>{
            requestAjax("../api/products.php",params,(success)=>{
                let response = JSON.parse(success);
                toastMessage("SUCCESS",response.message,"success");
                window.location = `../products/?_action=view&_id=${response.data.id}`;
            });
        });

        return false;
    }
</script>