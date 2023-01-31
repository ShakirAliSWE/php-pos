<?php
include_once "../includes/includes.php";
global $objDatabase;
$action = getValue("action");
$addedAt = timeNow();
$addedBy = 1;

try{
    if(!verifyUser()){
        throw new Exception("Login required",403);
    }

    if($action == "all"){
        $data = [];
        $result = $objDatabase->dbQuery("SELECT * FROM sells ORDER BY id DESC ");
        while($row = $objDatabase->dbFetch($result)){
            $data[] = [
                "id"            => (int) $row["id"],
                "code"          => $row["code"],
                "date"          => $row["date"],
                "totalItems"    => $row["totalItems"],
                "totalAmount"   => (double) $row["totalAmount"],
            ];
        }

        echo json_encode(["data" => $data]);
    }
    else if($action == "add"){
        $code  = systemCode("sells","code","id","S");
        $date  = getValue("date");
        $items = getValue("items");

        if(!is_array($items))
            $items = [];

        if(count($items) == 0){
            throw new Exception("No items found",403);
        }

        $itemsArray = [];
        foreach ($items AS $item){
            if(!isset($itemsArray[$item["id"]]))
                $itemsArray[$item["id"]] = 0;
            $itemsArray[$item["id"]] += $item["qty"];
        }

        $objDatabase->dbQuery("INSERT INTO sells(code,date,addedAt,addedBy) VALUES ('$code','$date','$addedAt','$addedBy')");
        $sellId  = $objDatabase->dbLastId();
        $totalItems  = 0;
        $totalAmount = 0;

        $result = $objDatabase->dbQuery("SELECT * FROM products WHERE id IN (".implode(",",array_keys($itemsArray)).")");
        while($row = $objDatabase->dbFetch($result)){
            $itemId = $row["id"];
            $qty = isset($itemsArray[$itemId])?$itemsArray[$itemId]:0;
            if(!$qty)
                continue;
            $buyingPrice   = $row["buyingPrice"];
            $sellingPrice  = $row["sellingPrice"];
            $totalPrice    = $qty*$sellingPrice;

            $totalItems++;
            $totalAmount += $totalPrice;
            $objDatabase->dbQuery("INSERT INTO sells_items(sellId,itemId,qty,buyingPrice,sellingPrice,totalPrice) VALUES ('$sellId','$itemId','$qty','$buyingPrice','$sellingPrice','$totalPrice')");
        }

        $objDatabase->dbQuery("UPDATE sells SET totalItems = '$totalItems', totalAmount = '$totalAmount' WHERE id = '$sellId' ");

        echo response(200,"Record added successfully",["id" => $sellId]);
    }
    else{
        throw new Exception("No action found",403);
    }
}
catch (Exception $e){
    echo response($e->getCode(),$e->getMessage());
}