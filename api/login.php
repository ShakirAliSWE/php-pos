<?php
include_once "../includes/includes.php";
global $objDatabase;
$action = getValue("action");

try{

    if($action == "login"){
        $username = getValue("username");
        $password = getValue("password");
        $result = $objDatabase->dbQuery("SELECT * FROM users WHERE username = '$username' ");
        if($objDatabase->dbRowsCount($result) <= 0)
            throw new Exception("Sorry, Incorrect Username/password",403);

        $row = $objDatabase->dbFetch($result);
        if(!passwordVerify($password,$row["password"])){
            throw new Exception("Sorry, Incorrect Username/password",403);
        }

        $data = ["id" => (int) $row["id"],"redirect" => "../dashboard/"];
        $_SESSION["_u"] = base64_encode($row["id"]);
        echo response(200,"Login successfully",$data);
    }
    else if($action == "logout"){
        $data = ["redirect" => "../login/"];
        if(isset($_SESSION["_u"])){
            unset($_SESSION["_u"]);
        }

        echo response(200,"Logout successfully",$data);
    }

    else{
        throw new Exception("No action found",403);
    }
}
catch (Exception $e){
    echo response($e->getCode(),$e->getMessage());
}