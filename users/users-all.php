<?php
include_once "../includes/includes.php";
global $objFormFields;

?>
<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([["title" => "All Users", "active" => true]])?>
    </div>
    <div>
        <a href = "../users/?_action=add" class="btn btn-primary"><i class="fa fa-plus m-1"></i>ADD NEW USER</a>
    </div>
</div>
<div class="custom-container">
    <?php
    $columnArray[] = ["id" => "id", "title" => "ID"];
    $columnArray[] = ["id" => "username", "title" => "USERNAME"];
    $columnArray[] = ["id" => "password", "title" => "PASSWORD"];
    $columnArray[] = ["id" => "status", "title" => "STATUS"];

    $operationArray[] = ["icon" => "fa fa-eye", "class" => "btn-warning","url" => "../users/?_action=view"];
    $operationArray[] = ["icon" => "fa fa-pencil-alt", "class" => "btn-primary","url" => "../users/?_action=edit"];
    echo $objFormFields->grid("users-all","id","users.php?action=all",$columnArray,$operationArray);
    ?>
</div>