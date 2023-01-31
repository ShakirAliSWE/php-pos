<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;
$id       = getValue("_id");
$sell  = [];
$sellItems = [];
try{
    $result = $objDatabase->dbQuery("SELECT * FROM sells WHERE id = '$id' ");
    if($objDatabase->dbRowsCount($result)){
        $sell = $objDatabase->dbFetch($result);
    }
    else{
        throw new Exception("No sell found",403);
    }

    $result = $objDatabase->dbQuery("SELECT P.id,P.code,P.title,SI.qty,SI.sellingPrice,SI.totalPrice FROM sells_items AS SI INNER JOIN products AS P ON P.id = SI.itemId WHERE SI.sellId = '$id' ");
    while ($row = $objDatabase->dbFetch($result))
        $sellItems[] = [
            "id"     => $row["id"],
            "code"   => $row["code"],
            "title"  => $row["title"],
            "qty"          => $row["qty"],
            "sellingPrice" => number_format($row["sellingPrice"],2),
            "totalPrice"   => number_format($row["totalPrice"],2),
        ];
}
catch (Exception $e) {
    die($e->getMessage());
}


?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Sells", "url" => "../sells/"],
            ["title" => "View Sell - ".$sell["code"], "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>VIEW SELL - <?php echo $sell["code"];?></h5>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?php echo $objFormFields->labelField("Sell Date", $sell["date"]); ?>
                <?php echo $objFormFields->labelField("Total Items", $sell["totalItems"]); ?>
                <?php echo $objFormFields->labelField("Total Amount",number_format( $sell["totalAmount"],2)); ?>
                <?php echo $objFormFields->labelField("Added", $sell["addedBy"]." | ".$sell["addedAt"]); ?>
            </div>
            <?php
            $tableHead = ["Product Code","Product Title","Quantity","Selling Price","Total Price"];
            echo $objFormFields->inputTable("tableItem","Item List",$tableHead);
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(()=>{
        let sellItems = <?php echo json_encode($sellItems)?>;
        $.each(sellItems,(key,data)=>{
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
                            <td id = "td_sellingPrice_${trNo}">${data.sellingPrice}</td>
                            <td id = "td_totalPrice_${trNo}" >${data.totalPrice}</td>
                           </tr>`);

    }
</script>