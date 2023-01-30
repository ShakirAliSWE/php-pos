<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;
$id       = getValue("_id");
$purchase  = [];
$purchaseItems = [];
try{
    $result = $objDatabase->dbQuery("SELECT * FROM purchases WHERE id = '$id' ");
    if($objDatabase->dbRowsCount($result)){
        $purchase = $objDatabase->dbFetch($result);
    }
    else{
        throw new Exception("No purchase found",403);
    }

    $result = $objDatabase->dbQuery("SELECT P.id,P.code,P.title,PI.qty,PI.buyingPrice,PI.totalPrice FROM purchases_items AS PI INNER JOIN products AS P ON P.id = PI.itemId WHERE PI.purchaseId = '$id' ");
    while ($row = $objDatabase->dbFetch($result))
        $purchaseItems[] = [
                "id"     => $row["id"],
                "code"   => $row["code"],
                "title"  => $row["title"],
                "qty"         => $row["qty"],
                "buyingPrice" => number_format($row["buyingPrice"],2),
                "totalPrice"  => number_format($row["totalPrice"],2),
        ];
}
catch (Exception $e) {
    die($e->getMessage());
}


?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Purchases", "url" => "../purchases/"],
            ["title" => "View Purchase - ".$purchase["code"], "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>VIEW PURCHASE - <?php echo $purchase["code"];?></h5>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?php echo $objFormFields->labelField("Purchase Date", $purchase["date"]); ?>
                <?php echo $objFormFields->labelField("Total Items", $purchase["totalItems"]); ?>
                <?php echo $objFormFields->labelField("Total Amount",number_format( $purchase["totalAmount"],2)); ?>
                <?php echo $objFormFields->labelField("Added", $purchase["addedBy"]." | ".$purchase["addedAt"]); ?>
            </div>
            <?php
            $tableHead = ["Product Code","Product Title","Quantity","Buying Price","Total Price"];
            echo $objFormFields->inputTable("tableItem","Item List",$tableHead);
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(()=>{
        let purchaseItems = <?php echo json_encode($purchaseItems)?>;
        console.log("purchaseItems",purchaseItems);
        $.each(purchaseItems,(key,data)=>{
            templateRow(data);
        });
    });


    function templateRow(data){
        let trNo = randomString();
        let $tableBody = $(".tableItem_table_body");
        $tableBody.append(`<tr id = "${trNo}" data-id = "${data.id}">
                            <td id = "td_code_${trNo}">${data.code}</td>
                            <td id = "td_title_${trNo}">${data.title}</td>
                            <td id = "td_qty_${trNo}">${data.qty}</td>
                            <td id = "td_buyingPrice_${trNo}">${data.buyingPrice}</td>
                            <td id = "td_totalPrice_${trNo}" >${data.totalPrice}</td>
                           </tr>`);

    }
</script>