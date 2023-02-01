<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;
$id       = getValue("_id");
$user  = [];
try{
    $result = $objDatabase->dbQuery("SELECT * FROM users WHERE id = '$id' ");
    if($objDatabase->dbRowsCount($result)){
        $user = $objDatabase->dbFetch($result);
    }
    else{
        throw new Exception("No user found",403);
    }

}
catch (Exception $e) {
    die($e->getMessage());
}


?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Users", "url" => "../users/"],
            ["title" => "View User - ".$user["username"], "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>VIEW USER - <?php echo $user["username"];?></h5>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?php echo $objFormFields->labelField("Username", $user["username"]); ?>
                <?php echo $objFormFields->labelField("Password","********"); ?>
                <?php echo $objFormFields->labelField("Status",$user["status"]?"Active":"Inactive"); ?>
                <?php echo $objFormFields->labelField("Added", $user["addedBy"]." | ".$user["addedAt"]); ?>
            </div>
        </div>
    </div>
</div>