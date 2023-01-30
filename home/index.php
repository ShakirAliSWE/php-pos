<?php
$sActivePage = "home";
include_once "../includes/header.php";
global $objFormFields;

?>
<div class = "custom-background-image">
    <div class="container-fluid">
        <div style = "clear: both"><br/></div>
        <div class = "text-center"><h4 class = "text-light">WE'RE HERE TO HELP</h4></div>
        <div class = "text-center mb-3"><h1 class = "text-light">Everything for your move, all in one place</h1></div>
        <div class = "text-center mb-2"><h6 class = "text-light">Plan, prep, set up services, and save on what your home needs most.</h6></div>
        <div class = "d-flex flex-wrap justify-content-center">
            <div class = "m-3 custom-card">
                <?php echo $objFormFields->cardTemplate("../assets/icons/icon-internet-and-tv.svg","Internet & TV","Compare & shop plans from top providers","Find Internet","../change-address","",""); ?>
            </div>
            <div class = "m-3 custom-card">
                <?php echo $objFormFields->cardTemplate("../assets/icons/icon-change-address.svg","Change of Address","Make sure your mail moves with you!","Change Address","../change-address","",""); ?>
            </div>
            <div class = "m-3 custom-card">
                <?php echo $objFormFields->cardTemplate("../assets/icons/icon-home-security.svg","Home Security","Protect what matters most, for less.","Get Home Security","http://safestreets.com/conciergency","_blank","with SafeStreets"); ?>
            </div>

        </div>
        <div style = "clear: both"><br/></div>
    </div>

</div>
<div style = "clear: both"><br/></div>

<?php include_once "../includes/footer.php"; ?>
