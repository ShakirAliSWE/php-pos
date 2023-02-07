<?php
include_once __DIR__ . "/includes.php";
$globalErrorArray = getGlobalError(getValue("_e", "GET"));
if(!verifyUser()){
    redirect("../login/");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo COMPANY_NAME; ?></title>
    <meta name="description" content="<?php echo COMPANY_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo COMPANY_KEYWORDS; ?>">
    <meta name="author" content="<?php echo COMPANY_AUTHOR; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP --->
    <link href="../assets/plugins/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/plugins/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.3.js"></script>

    <link href="../assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="../assets/plugins/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet">
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <link href="../assets/plugins/fontawesome/css/all.css" rel="stylesheet">

    <link href="../assets/plugins/date-picker/date-picker.css" rel="stylesheet">
    <script src="../assets/plugins/date-picker/date-picker.js"></script>

    <link href="../assets/css/template-custom.css" rel="stylesheet">
    <script src="../assets/js/template-custom.js"></script>

    <link href="../assets/plugins/jquery-pacejs/jquery-pacejs.css" rel="stylesheet">
    <script src="../assets/plugins/jquery-pacejs/jquery-pacejs.js"></script>

    <link href="../assets/plugins/jquery-toast/jquery-toast.css" rel="stylesheet">
    <script src="../assets/plugins/jquery-toast/jquery-toast.js"></script>

    <link href="../assets/plugins/sweet-alert/sweet-alert.css" rel="stylesheet">
    <script src="../assets/plugins/sweet-alert/sweet-alert.js"></script>

    <script src="../assets/js/jquery-mask.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function bodyOnLoad() {
            let globalErrorArray = <?php echo json_encode($globalErrorArray)?>;
            showGlobalError(globalErrorArray)
        }
    </script>

</head>
<body onload="bodyOnLoad();">
<div class="container-fluid">
    <div class="mb-5"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom-primary mb-2 rounded">
        <div class="container-fluid">
            <a class="navbar-brand" href="../"><?php echo COMPANY_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    $aArrayLinks = menus();
                    foreach ($aArrayLinks as $aArrayLink) {
                        $sActive = $sActivePage == $aArrayLink["path"] ? "active" : "";
                        echo '<li class="nav-item"><a class="nav-link ' . $sActive . '" href="../' . $aArrayLink["path"] . '">' . $aArrayLink["title"] . '</a></li>';
                    }
                    ?>
                </ul>
                <div class="d-flex justify-content-end w-100">
                    <a href = "javascript:void(0);" onclick="logout();" class="btn btn-warning btn-sm">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="main-container" id="main-container">
