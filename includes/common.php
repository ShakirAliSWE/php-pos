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
            "title" => "Settings",
            "path" => "settings",
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
    http_response_code($code);
    return json_encode(["status" => $code, "message" => $message, "data" => $dataArray]);
}