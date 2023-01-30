<?php
$sActivePage = "products";
include_once "../includes/header.php";
global $objFormFields;
$m = "products";
$action = getValue("_action");
$id     = getValue("_id");

if($action == "")
    $action = "all";

$loadURL = "";
switch ($action){
    case "all":
        $loadURL = "../$m/products-all.php";
        break;
    case "add":
        $loadURL = "../$m/products-add.php";
        break;
    case "view":
        $loadURL = "../$m/products-view.php?_id=$id";
        break;
    case "edit":
        $loadURL = "../$m/products-edit.php?_id=$id";
        break;
    case "delete":
        $loadURL = "../$m/products-delete.php?_id=$id";
        break;
    default :
        $loadURL = "../$m/products-all.php";
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
