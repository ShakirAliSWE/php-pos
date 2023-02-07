<?php
include_once "../includes/includes.php";
global $objFormFields;
global $objDatabase;
$date = date("Y-m-d");
?>

<div class="d-flex justify-content-between mb-2">
    <div>
        <?php echo $objFormFields->breadCrumb([
            ["title" => "All Users", "url" => "../users/"],
            ["title" => "Add Users", "active" => true]
        ]);?>
    </div>
</div>
<div class="custom-container">
    <div class="text-center">
        <h5>ADD NEW USER</h5>
    </div>
    <div class="row">
        <form onsubmit="return formOnSubmit();" >
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="mb-3">
                    <?php echo $objFormFields->inputMobile("username", "Username","","Username",'<i class="fa fa-phone"></i>',true) ?>
                </div>
                <div class="mb-3">
                    <?php echo $objFormFields->inputPassword("password", "Password","","Password",true) ?>
                </div>
                <div class="mb-3">
                    <?php  echo $objFormFields->inputCheckBox("status", "Status",1); ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 text-end">
                    <button type = "submit" class="btn btn-primary m-1" style="width: 220px;">SAVE RECORD</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<script>
    function formOnSubmit(){
        let username        = $("#username").val();
        let password        = $("#password").val();
        let status          = $("#status").is(":checked")?1:0;

        if(username === ""){
            return formFieldError("username");
        }

        if(password === ""){
            return formFieldError("password");
        }

        let params = {
            action : "add",
            username : username,
            password : password,
            status : status
        };

        confirmationRequest("Do you want to add this record?",()=>{
            requestAjax("../api/users.php",params,(success)=>{
                let response = JSON.parse(success);
                toastMessage("SUCCESS",response.message,"success");
                window.location = `../users/?_action=view&_id=${response.data.id}`;
            });
        });


        return false;
    }

</script>