<?php

function menus()
{
    return [
        [
            "title" => "Products",
            "path" => "products",
        ],
        [
            "title" => "Purchases",
            "path" => "purchases",
        ],
        [
            "title" => "Sells",
            "path" => "sells",
        ],
        [
            "title" => "Reports",
            "path" => "reports",
        ],
        [
            "title" => "Users",
            "path" => "users",
        ],
    ];
}

function getActiveMenu($menuPath = "")
{
    $aArrayReturn = [
        "title" => COMPANY_NAME,
        "path" => $menuPath,
    ];

    if ($menuPath == "")
        return $aArrayReturn;

    $aArrayFilter = array_filter(menus(), function ($menu) use ($menuPath) {
        return $menu["path"] === $menuPath;
    });

    $aArrayFilter = array_values($aArrayFilter);
    return count($aArrayFilter) ? $aArrayFilter[0] : $aArrayReturn;
}

function setGlobalError()
{
    return [
        "1001" => [
            "title" => "SUCCESS",
            "message" => "Request generated successfully",
            "type" => "success"
        ],
        "1002" => [
            "title" => "SUCCESS",
            "message" => "Payment proceed successfully",
            "type" => "success"
        ],
        "1003" => [
            "title" => "WARNING",
            "message" => "Payment already proceed, No pending payment found",
            "type" => "warning"
        ],
        "1004" => [
            "title" => "ERROR",
            "message" => "Sorry, No Record found against tracking number",
            "type" => "error"
        ],
    ];
}

function getGlobalError($errorCode = ""){
    if ($errorCode == "")
        return [];
    $errorCode = base64_decode($errorCode);
    $globalError = setGlobalError();
    return isset($globalError[$errorCode]) ? $globalError[$errorCode] : [];
}

function changeArrayDropDown($aArray = []){
    $return = [];
    foreach ($aArray as $value) {
        $return[] = ["id" => $value, "title" => $value];
    }

    return $return;
}

function getValue($name, $type = "")
{
    switch ($type) {
        case "POST":
            return isset($_POST[$name]) ? $_POST[$name] : "";
        case "GET":
            return isset($_GET[$name]) ? $_GET[$name] : "";
        default :
            return isset($_REQUEST[$name]) ? $_REQUEST[$name] : "";
    }
}


function timeNow(){
    return date("Y-m-d H:i:s");
}

function systemCode($table,$column,$sortBy,$prefix = ""){
    global $objDatabase;
    try {

        $result = $objDatabase->dbQuery("SELECT $column FROM $table ORDER BY $sortBy DESC LIMIT 1");
        if($objDatabase->dbRowsCount($result)){
            $row = $objDatabase->dbFetch($result);
            $index = (int) str_replace($prefix,"",$row[$column]);
            $index++;
            return $prefix."".$index;
        }
        else{
            return $prefix."1";
        }
    } catch (Exception $e) {
        return "";
    }

}

function response($code, $message, $dataArray = []){
    if($code == 0)
        $code = 403;
    http_response_code($code);
    return json_encode(["status" => $code, "message" => $message, "data" => $dataArray]);
}

function passwordHash($password){
    return password_hash($password,PASSWORD_BCRYPT);
}

function passwordVerify($password,$hash){
    return password_verify($password,$hash);
}

function verifyUser(){
    return isset($_SESSION["_u"])?$_SESSION["_u"]:null;
}

function redirect($url){
    header("Location: $url");
    exit();
}

function addInventory($itemId = 0,$qty = 0){
    global $objDatabase;
    $timeNow = timeNow();
    try{
        if($itemId == 0){
            throw new Exception("Sorry, No item found",503);
        }

        $result = $objDatabase->dbQuery("SELECT id FROM inventory WHERE itemId = '$itemId'");
        if($objDatabase->dbRowsCount($result)){
            $rowArray = $objDatabase->dbFetch($result);
            $id = $rowArray["id"];
            $objDatabase->dbQuery("UPDATE inventory SET qty = qty + $qty, updatedAt = '$timeNow' WHERE id = '$id' ");
        }
        else{
            $objDatabase->dbQuery("INSERT INTO inventory(itemId,qty,addedAt) VALUES ('$itemId','$qty','$timeNow')");
        }
    }
    catch (Exception $e){
        throw new Exception($e->getMessage(),$e->getCode());
    }
}

function subtractInventory($itemId = 0,$qty = 0){
    global $objDatabase;
    $timeNow = timeNow();
    try{
        if($itemId == 0){
            throw new Exception("Sorry, No item found",503);
        }

        $result = $objDatabase->dbQuery("SELECT id,qty FROM inventory WHERE itemId = '$itemId'");
        if($objDatabase->dbRowsCount($result)){
            $rowArray = $objDatabase->dbFetch($result);
            $id        = $rowArray["id"];
            $systemQty = $rowArray["qty"];
            if($systemQty < $qty)
                throw new Exception("Sorry, Inventory not available",503);

            $objDatabase->dbQuery("UPDATE inventory SET qty = qty - $qty, updatedAt = '$timeNow' WHERE id = '$id' ");
        }
        else{
            throw new Exception("Sorry, No item found",503);
        }
    }
    catch (Exception $e){
        throw new Exception($e->getMessage(),$e->getCode());
    }
}


