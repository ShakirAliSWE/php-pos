<?php
include_once __DIR__ . "/../includes/includes.php";
$globalErrorArray = getGlobalError(getValue("_e", "GET"));
if(verifyUser()){
    redirect("../dashboard/");
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

    <script src="../assets/js/jquery-mask.js"></script>

    <script>
        function bodyOnLoad() {
            let globalErrorArray = <?php echo json_encode($globalErrorArray)?>;
            showGlobalError(globalErrorArray)
        }
    </script>

    <style>
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }

        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }</style>

</head>
<body>
<div class="container">
    <div class="mt-5"></div>
    <div class="d-flex flex-column" style="align-items: center;">
        <div><h4>Please sign in</h4></div>
        <div class="custom-container" style="width: 22em;">
            <form onsubmit="return login();" autocomplete="off">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" placeholder="03xxxxxxxxx">
                    <label for="username">Mobile Number - 03xxxxxxxxx</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <div class="d-flex mb-3 gap-1">
                    <button type = "button" class="btn btn-warning" style="width: 50%;">Forget Password</button>
                    <button type = "submit" class="btn btn-primary" style="width: 50%;">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="clear: both"><br/>
<script>
    $("#username").mask("03000000000");
</script>

<?php include_once "../includes/footer.php"; ?>