$(document).ready(function(e){
 
    sessionStorage.setItem("forgetuserid", "0");
    sessionStorage.setItem("forgetverify", "0"); 
    
    var userid = getUrlParameter("userid") == undefined ? '' : getUrlParameter("userid").trim();
    var verifycode = getUrlParameter("verifycode") == undefined ? '' : getUrlParameter("verifycode").trim();

    if (userid.trim() == "" || verifycode.trim() == ""){
        location.href = "login.php";
    } 
   
    sessionStorage.setItem('forgetuserid',userid);
    sessionStorage.setItem('forgetverify', verifycode);
});

 
$("#btncancel").click(function(e){
    location.href = 'login.php';
});


/**check confirm password matching */
$("#upass, #reupass").on("keyup", function () {
    if ($("#upass").val() == $("#reupass").val()) {
        $("#password_match").html("Matching").css("color", "green");
    } else {
        $("#password_match").html("Not Matching").css("color", "red");
    }
});


/**on reset btn click */
$("#btnsave").click(function(event){ 
    event.preventDefault();

    var upass = $("#upass").val();
    var reupass = $("#reupass").val();

    var strongRegex = new RegExp("(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}");
    if (!strongRegex.test(upass)) {
        $("#submit_result").html(
          '<div class="alert alert-warning">Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</div>'
        );
        return;
    }

    if (upass != reupass){
        $("#submit_result").html('<div class="alert alert-danger">Password doen not maching.</div>');
        return;
    }

 
    if (upass != null && upass.trim() != "" && reupass != null && reupass.trim() != "") {
        $("#submit_result").html('<div class="alert alert-warning">Please Wait...</div>');
        
        $.ajax({
            url: "/RestaurantApp/admin/controller/public/controller.resetforgetpassword.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify({
                userid: sessionStorage.getItem('forgetuserid'),
                verifycode: sessionStorage.getItem('forgetverify'),
                password: upass
            }),
            success: function (data, textStatus, xhr) {
                console.log(data);
                if (data.message == "success" && data.code == "1") {
                    $("#submit_result").html('<div class="alert alert-success">Password Reset Successfully!. Please login with your new password</div>');
                      
                } else {
                    $("#submit_result").html('<div class="alert alert-danger">Request failed!</div>');
                }

            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                $("#submit_result").html('<div class="alert alert-danger">Something went wrong!</div>');
            }
        });

    } else {
        $("#submit_result").html('<div class="alert alert-danger">Fill all required fields!...</div>');  
    } 

    sessionStorage.setItem('forgetuserid', '0');
    sessionStorage.setItem('forgetverify', '0'); 
});