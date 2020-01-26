<script src="js/jquery-3.2.0.min.js" type="text/javascript"></script>
<script src="Script/common.js" type="text/javascript"></script>

<script>
    /**update logout datetime */ 
    var userid = sessionStorage.user_id;  
    var usertoken = sessionStorage.user_token; 

    $.ajax({
        url: "http://localhost:51053/api/auth/Logout",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        headers:{
            'Authorization': 'Bearer ' + sessionStorage.getItem("user_token")
        },
        data: JSON.stringify({
            ID: sessionStorage.getItem("log_user_id"),
            token: sessionStorage.getItem("user_token"),
            Email: sessionStorage.getItem("log_user_email")
        }),
        success: function (data) { 
            // console.log(data);
            if (data.message == "success" && data.code == "1") { 
                // /** check this is login expired */
                // var isloginexpired = 0
                // if (sessionStorage.getItem("loginexpired") == 'Session expired. Please login again.') {
                //     isloginexpired = 1;// if login expired 
                // }
                sessionStorage.clear(); // clear all session storage elements  

                // /**if login expired then create and set a session for show message in login page */
                // if (isloginexpired == 1) { 
                //     sessionStorage.setItem("loginexpired","Session expired. Please login again.");
                // }
            }
        },
        error: function (xhr, textStatus, errorThrown) { }
    });

    location.href = "./login.php";

</script>
