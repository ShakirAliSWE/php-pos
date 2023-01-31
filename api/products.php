<?php
include_once "../includes/includes.php";
global $objDatabase;
$action = getValue("action");

try{
    if(!verifyUser()){
        throw new Exception("Login required",403);
    }

    if($action == "all"){
        $data = [];
        $result = $objDatabase->dbQuery("SELECT * FROM products ORDER BY id DESC ");
        while($row = $objDatabase->dbFetch($result)){
            $data[] = [
                "id"            => (int) $row["id"],
                "code"          => $row["code"],
                "title"         => $row["title"],
                "unit"          => $row["unit"],
                "buyingPrice"   => (double) $row["buyingPrice"],
                "sellingPrice"  => (double) $row["sellingPrice"],
                "status"        => $row["status"]?"Active":"Inactive"
            ];
        }

        echo json_encode(["data" => $data]);
    }
    else if($action == "add"){
        $code  = systemCode("products","code","id","P");
        $title = getValue("title");
        $unit  = getValue("unit");
        $buyingPrice = getValue("buyingPrice");
        $sellingPrice = getValue("sellingPrice");
        $status = getValue("status");
        $addedAt = timeNow();
        $addedBy = 1;

        $objDatabase->dbQuery("INSERT INTO products(code,title,unit,buyingPrice,sellingPrice,status,addedAt,addedBy) VALUES ('$code','$title','$unit','$buyingPrice','$sellingPrice','$status','$addedAt','$addedBy')");
        $id = $objDatabase->dbLastId();
        echo response(200,"Record added successfully",["id" => $id]);
    }
    else if($action == "edit"){
        $id = getValue("id");
        $title = getValue("title");
        $unit  = getValue("unit");
        $buyingPrice = getValue("buyingPrice");
        $sellingPrice = getValue("sellingPrice");
        $status = getValue("status");
        $updatedAt = timeNow();
        $updatedBy = 1;

        $result = $objDatabase->dbQuery("SELECT * FROM products WHERE id = '$id' ");
        if(!$objDatabase->dbRowsCount($result)){
            throw new Exception("No item found",403);
        }

        $objDatabase->dbQuery("UPDATE products SET 
                                                title = '$title',
                                                unit = '$unit',
                                                buyingPrice = '$buyingPrice',
                                                sellingPrice = '$sellingPrice',
                                                status = '$status',
                                                updatedAt = '$updatedAt',
                                                updatedBy = '$updatedBy'
                                          WHERE id = '$id' ");
        echo response(200,"Record updated successfully",["id" => $id]);
    }
    else if($action == "search"){
        $term = getValue("term");
        $return = [];
        $result = $objDatabase->dbQuery("SELECT * FROM products WHERE title LIKE '%$term%' ");
        while($row = $objDatabase->dbFetch($result)){
            $return[] = ["id" => (int) $row["id"],"label" => $row["title"],"value" => $row["title"],"data" => $row];
        }

        echo json_encode($return);

    }
    else{
        throw new Exception("No action found",403);
    }
}
catch (Exception $e){
    echo response($e->getCode(),$e->getMessage());
}