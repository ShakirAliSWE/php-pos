<?php
$sActivePage = "purchases";
include_once "../includes/header.php";
global $objFormFields;
$m = "purchases";
$action = getValue("_action");
$id     = getValue("_id");

if($action == "")
    $action = "all";

$loadURL = "";
switch ($action){
    case "all":
        $loadURL = "../$m/purchases-all.php";
        break;
    case "add":
        $loadURL = "../$m/purchases-add.php";
        break;
    case "view":
        $loadURL = "../$m/purchases-view.php?_id=$id";
        break;
    case "edit":
        $loadURL = "../$m/purchases-edit.php?_id=$id";
        break;
    case "delete":
        $loadURL = "../$m/purchases-delete.php?_id=$id";
        break;
    default :
        $loadURL = "../$m/purchases-all.php";
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
