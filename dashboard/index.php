<?php
$sActivePage = "dashboard";
include_once "../includes/header.php";
global $objFormFields;
$mArray = [
    ["title" => "Products", "link" => "../products/", "icon" => "fa fa-shopping-cart"],
    ["title" => "Purchase", "link" => "../purchases/", "icon" => "fa fa-cubes"],
    ["title" => "Sells", "link" => "../sells/", "icon" => "fa fa-outdent"],
    ["title" => "Reports", "link" => "../reports/", "icon" => "fa fa-file"],
];
?>

<div style="clear: both"><br/></div>
<div class="d-flex justify-content-center gap-2 flex-wrap">
    <?php
        foreach ($mArray AS $m){
            echo ' <a href="'.$m["link"].'" class="custom-container text-center text-decoration-none" style="width: 280px;">
                    <i class="fa-4x '.$m["icon"].' mb-2"></i>
                    <h5>'.$m["title"].'</h5>
                   </a>';
        }
    ?>

</div>

<?php include_once "../includes/footer.php"; ?>
