<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;
$date = date("Y-m-d");
?>

<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Purchases", "url" => "../purchases/"],
            ["title" => "Add Purchase", "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>ADD NEW PURCHASE</h5>
    </div>
    <div class="row">
        <form onsubmit="return formOnSubmit();" >
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="mb-3">
                    <?php echo $objFormFields->inputDate("date", "Purchase Date", $date, "YYYY-mm-dd", true) ?>
                </div>
                <div class="mb-3">
                    <?php echo $objFormFields->inputAutoComplete("searchItem", "Search Items") ?>
                </div>
            </div>
            <div class="mb-3">
                <?php
                    $tableHead = ["Product Code","Product Title","Quantity","Buying Price","Total Price","Action"];
                    echo $objFormFields->inputTable("tableItem","Item List",$tableHead);
                ?>
            </div>
            <div class="col-md-6">
                <div class="mb-3 text-end">
                    <button type = "submit" class="btn btn-primary m-1" style="width: 220px;">SAVE RECORD</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        let $searchItem = $("#searchItem");
        $searchItem.autocomplete({
            source: "../api/products.php?action=search",
            minLength: 2,
            select: function( event, ui) {
                templateRow(ui.item.data);
                $searchItem.val("");
                return false;
            }
        });
    });

    function templateRow(data){
        let trNo = randomString();
        let $tableBody = $(".tableItem_table_body");
        $tableBody.append(`<tr id = "${trNo}" data-id = "${data.id}">
                            <td id = "td_code_${trNo}">${data.code}</td>
                            <td id = "td_title_${trNo}">${data.title}</td>
                            <td id = "td_qty_${trNo}"><input type = "number" data-price = "${data.buyingPrice}" data-id = "${trNo}" id = "qty_${trNo}" class = "form-control-sm" onkeyup="calTotalPrice(this)"/></td>
                            <td id = "td_buyingPrice_${trNo}">${data.buyingPrice}</td>
                            <td id = "td_totalPrice_${trNo}" >${100}</td>
                            <td id = "td_action_${trNo}" ><a onclick = "deleteRow(this)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></a></td>
                           </tr>`);

    }

    function calTotalPrice(fieldObject){
        let id = $(fieldObject).attr("data-id");
        let qty = $(fieldObject).val();
        let buyingPrice = $(fieldObject).attr("data-price");
        $(`#td_totalPrice_${id}`).html(qty*buyingPrice);
    }

    function deleteRow(fieldObject){
        $(fieldObject).closest("tr").remove();
    }

    function formOnSubmit(){
        let date    = $("#date").val();
        let items = [];
        $(".tableItem_table_body").find("tr").each((key,rowObject) => {
            let trNo = $(rowObject).attr("id");
            let id   = $(rowObject).attr("data-id");
            let qty  = $(`#qty_${trNo}`).val();
            if(qty > 0){
                items.push({id : id, qty : qty})
            }
        });

        if(date === ""){
            return formFieldError("data");
        }

        if(items.length === 0){
            toastMessage("Sorry!","No item selected","warning");
            return formFieldError("searchItem");
        }

        let params = {
            action : "add",
            date : date,
            items : items,
        };

        confirmationRequest("Do you want to add this record?",()=>{
            requestAjax("../api/purchases.php",params,(success)=>{
                let response = JSON.parse(success);
                toastMessage("SUCCESS",response.message,"success");
                window.location = `../purchases/?_action=view&_id=${response.data.id}`;
            });
        });

        return false;
    }

</script>