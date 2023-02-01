<?php
$sActivePage = "users";
include_once "../includes/header.php";
global $objFormFields;
$m = "users";
$action = getValue("_action");
$id     = getValue("_id");

if($action == "")
    $action = "all";

$loadURL = "";
switch ($action){
    case "all":
        $loadURL = "../$m/$m-all.php";
        break;
    case "add":
        $loadURL = "../$m/$m-add.php";
        break;
    case "view":
        $loadURL = "../$m/$m-view.php?_id=$id";
        break;
    case "edit":
        $loadURL = "../$m/$m-edit.php?_id=$id";
        break;
    case "delete":
        $loadURL = "../$m/$m-delete.php?_id=$id";
        break;
    default :
        $loadURL = "../$m/$m-all.php";
}
?>

<div style="clear: both"><br/></div>
<div class="container-module"></div>
<script>
    $(document).ready(()=>{
        console.log("<?php echo $loadURL;?>");
        $(".container-module").load("<?php echo $loadURL;?>")
    });
</script>

<?php include_once "../includes/footer.php"; ?>
