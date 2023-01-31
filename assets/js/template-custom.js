
function getValue(keyName = "") {
    let urlObject = new URL(window.location.href);
    let returnValue = urlObject.searchParams.get(keyName);
    return returnValue?returnValue:"";
}

function formFieldError(fieldId){
    let $inputField = $(`#${fieldId}`);
    $inputField.focus();
    $(`#${fieldId}_validation`).fadeIn().delay(5000).fadeOut("slow");
    return false;
}
function validateEmail(email) {
    let regexPattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return !regexPattern.test(email);
}

function validateMobileNumber(mobileNumber){
    let regexPattern = /^[0-9]{10}$/;
    console.log("mobileNumber",regexPattern.test(mobileNumber));
    return regexPattern.test(mobileNumber);
}

function requestAjax(url,parameters = {},success,async = false){
    Pace.start();
    $.ajax({
        type : "POST",
        url : url,
        data : parameters,
        async : async,
        error : function(e){
            let errorResponse = JSON.parse(e.responseText);
            toastMessage("ERROR",errorResponse.message,"error");
            Pace.stop();
            console.log("error",errorResponse);
        },
        success: function(response){
            Pace.stop();
            success(response);
        }
    });
}

function requestAjaxContainer(url,parameters = {},containerClass = ".",success = function(){}){
    Pace.start();
    $(`.${containerClass}`).html(``);
    $.ajax({
        type : "POST",
        url : url,
        data : parameters,
        error : function(e){
            Pace.stop();
            $(`.${containerClass}`).html(`<div>Error ${e}</div>`);
        },
        success: function(responseHTML){
            Pace.stop();
            $(`.${containerClass}`).html(responseHTML);
            success();
        }
    });
}

function toastMessage(title = null,message = null,type = "info"){
    $.toast({
        heading: title,
        text: message,
        icon: type,
        loader: true,
        position : "bottom-right",
        loaderBg: '#323567'
    })
}

function stringEncoded(stringValue = null){
    return btoa(stringValue);
}

function stringDecoded(stringValue = null){
    return atob(stringValue);
}

function setGlobalError(message = null){
    return `_e=${stringEncoded(message)}`;
}

function showGlobalError(errorMessage = {}){
    let messageLength = Object.keys(errorMessage).length;
    if(messageLength === 0)
        return false;
    console.log("errorMessage",errorMessage);
    toastMessage(errorMessage.title,errorMessage.message,errorMessage.type);
    return false;
}


function randomString(length = 12) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        counter += 1;
    }

    return result;
}

function login(){
    let username = $("#username").val();
    let password = $("#password").val();

    if(username === ""){
        formFieldError("username");
        return false;
    }

    if(password === ""){
        formFieldError("password");
        return false;
    }

    let parameters = {
        "action" : "login",
        "username" : username,
        "password" : password
    };

    requestAjax("../api/login.php",parameters,(response)=>{
        const result = JSON.parse(response);
        window.location = result.data.redirect;
    });



    return false;
}

function logout(){
    let parameters = {
        "action" : "logout",
    };
    requestAjax("../api/login.php",parameters,(response)=>{
        const result = JSON.parse(response);
        window.location = result.data.redirect;
    });

    console.error("Hello, Logout is clicked");
}