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
        $result = $objDatabase->dbQuery("SELECT * FROM users ORDER BY id DESC ");
        while($row = $objDatabase->dbFetch($result)){
            $data[] = [
                "id"            => (int) $row["id"],
                "username"      => $row["username"],
                "password"      => "********",
                "status"        => $row["status"]?"Active":"Inactive",
            ];
        }

        echo json_encode(["data" => $data]);
    }
    else if($action == "add"){
        $username  = getValue("username");
        $password  = getValue("password");
        $status    = getValue("status");
        $addedAt   = timeNow();
        $addedBy   = 1;

        $passwordHash = passwordHash($password);

        $result = $objDatabase->dbQuery("SELECT * FROM users WHERE username = '$username' ");
        if($objDatabase->dbRowsCount($result))
            throw new Exception("Sorry, Mobile number already exist",403);

        $objDatabase->dbQuery("INSERT INTO users(username,password,status,addedAt,addedBy) VALUES ('$username','$passwordHash','$status','$addedAt','$addedBy')");
        $id = $objDatabase->dbLastId();
        echo response(200,"Record added successfully",["id" => $id]);
    }
    else if($action == "edit"){
        $id        = getValue("id");
        $username  = getValue("username");
        $password  = getValue("password");
        $status    = getValue("status");

        $result = $objDatabase->dbQuery("SELECT * FROM users WHERE username = '$username' AND id <> '$id' ");
        if($objDatabase->dbRowsCount($result))
            throw new Exception("Sorry, Mobile number already exist",403);

        $updateQuery = "";
        if($password <> "********"){
            $passwordHash = passwordHash($password);
            $updateQuery = ", password = '$passwordHash' ";
        }

        $objDatabase->dbQuery("UPDATE users SET username = '$username', status = '$status' $updateQuery WHERE id = '$id'  ");
        echo response(200,"Record updated successfully",["id" => $id]);
    }
    else{
        throw new Exception("No action found",403);
    }
}
catch (Exception $e){
    echo response($e->getCode(),$e->getMessage());
}