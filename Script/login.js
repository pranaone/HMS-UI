$(document).keypress(function(e) {
  var keycode = e.keyCode ? e.keyCode : e.which;
  if (keycode == "13") {
    fn_user_login();
  }
});

/**on forget submit */
$("#btnsubmit").click(function(event) {
  // var uemail = $("#forgetpass #fogtemail").val();
  // var uemail = $('input[name="fogtemail"]').val();
  // console.log(uemail);
  // if (uemail != null && uemail.trim() != "") {
  //   $("#submit_result").html(
  //     '<div class="alert alert-warning">Please Wait...</div>'
  //   );

  //   $.ajax({
  //     url: "http://localhost:51053/api/user/GetUsersForUsersPage",
  //     type: "POST",
  //     dataType: "json",
  //     contentType: "application/json",
  //     data: JSON.stringify({
  //       Username: uemail
  //     }),
  //     success: function(data, textStatus, xhr) {
  //       if (data.message == "success" && data.code == "1") {
  //         $("#submit_result").html(
  //           '<div class="alert alert-success">An email sent to you. Please follow the instructions!</div>'
  //         );
  //       } else {
  //         $("#submit_result").html(
  //           '<div class="alert alert-danger">Entered email does not linked with any user.</div>'
  //         );
  //       }
  //     },
  //     error: function(xhr, textStatus, errorThrown) {
  //       console.log(xhr);
  //       $("#submit_result").html(
  //         '<div class="alert alert-danger">Something went wrong!</div>'
  //       );
  //     }
  //   });
  // } else {
  //   $("#submit_result").html(
  //     '<div class="alert alert-danger">Email Address Required!</div>'
  //   );
  // }

  // setTimeout(() => {
  //   $("#submit_result").html("");
  // }, 3000);
});

function fn_user_login() {
  $(".mainSpinner").show();
  $(".objoverlay").css("display", "block");
  var txtuname = $("#username").val();
  var txtpass = $("#password").val();

  if (
    txtuname != null &&
    txtuname.trim() != "" &&
    txtpass != null &&
    txtpass.trim() != ""
  ) {
    $.ajax({
      
      url: "http://localhost:51053/api/auth/Login",
      type: "POST",
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      data: JSON.stringify({
        email: txtuname,
        Password: txtpass
      }),
      success: function(data) {
        console.log(data);
        debugger;

          /**save user details in session storage */
          sessionStorage.setItem("log_user_id", data.ID);
          sessionStorage.setItem("log_user_role", data.RoleID);
          sessionStorage.setItem("log_user_email", data.Email);
          // sessionStorage.setItem("log_session_id", data.sessionid);
          sessionStorage.setItem("user_token", data.Token);
          /** */

          location.href = "dashboard.php"; // if Admin goto admin panel

        /**if Admin goto dashboard */

        // if (data.user_role == 1 || data.user_role == 3 || data.user_role == 4) {

        //   /**save user details in session storage */
        //   sessionStorage.setItem("log_user_id", data.ID);
        //   sessionStorage.setItem("log_user_role", data.RoleID);
        //   sessionStorage.setItem("log_user_email", data.Email);
        //   // sessionStorage.setItem("log_session_id", data.sessionid);
        //   sessionStorage.setItem("user_token", data.Token);
        //   /** */

        //   location.href = "dashboard.php"; // if Admin goto admin panel
        // } else {
        //   /**if normal user remove added record from user login table and return to logout*/
        //   $.ajax({
        //     url:"http://localhost:51053/api/auth/Logout",
        //     type: "POST",
        //     dataType: "json",
        //     contentType: "application/json",
        //     headers:{
        //       'Authorization': 'Bearer ' + sessionStorage.getItem("user_token")
        //     },
        //     data: JSON.stringify({
        //       userID: sessionStorage.getItem("log_user_id"),
        //       token: sessionStorage.getItem("user_token"),
        //       email: sessionStorage.getItem("log_user_email")
        //     }),
        //     success: function(data) {
              
        //     },
        //     error: function(xhr) {
              
        //     }
        //   });
        //   /** */

        //   fn_loginfailed();
        // }
      },
      error: function(xhr, textStatus, errorThrown) {
        
        fn_loginfailed();
      }
    });
  } else {
    fn_loginfailed();
  }
  
  $(".mainSpinner").hide();
}

$("#btnlogin").click(function() {
  fn_user_login();
  // location.href = "dashboard.php";
});

function fn_loginfailed() {
  sessionStorage.setItem("loginfailed", "Login failed. Please Try again.");
  location.href = location.href;
}
