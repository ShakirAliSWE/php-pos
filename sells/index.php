<?php
$sActivePage = "sells";
include_once "../includes/header.php";
global $objFormFields;
$m = "sells";
$action = getValue("_action");
$id     = getValue("_id");

if($action == "")
    $action = "all";

$loadURL = "";
switch ($action){
    case "all":
        $loadURL = "../$m/sells-all.php";
        break;
    case "add":
        $loadURL = "../$m/sells-add.php";
        break;
    case "view":
        $loadURL = "../$m/sells-view.php?_id=$id";
        break;
    case "edit":
        $loadURL = "../$m/sells-edit.php?_id=$id";
        break;
    case "delete":
        $loadURL = "../$m/sells-delete.php?_id=$id";
        break;
    default :
        $loadURL = "../$m/sells-all.php";
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
