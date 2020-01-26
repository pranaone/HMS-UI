
/**check confirm password matching */
$("#newpass, #cofnewpass").on("keyup", function () {
    if ($("#newpass").val() == $("#cofnewpass").val()) {
        $("#password_match").html("Matching").css("color", "green");
    } else {
        $("#password_match").html("Not Matching").css("color", "red");
    }
});


$("#formresetpass").submit(function(event){
    event.preventDefault();

    var oldpass = $("#oldpass").val();
    var newpass = $("#newpass").val();
    var confnewpass = $("#cofnewpass").val();

    /**check new password and confirm password */
    if(newpass != confnewpass){
        // $("#submit_result").html(
        //     '<div class="alert alert-danger">Password Not Matching</div>'
        // );
        swal("Password Not Matching!","","error");
        return;
    }

    /**get user login id from session */
    var loguserid = sessionStorage.getItem("log_user_id"); 
    console.log(loguserid);

    // $("#submit_result").html('<div class="alert alert-warning">Please Wait...</div>'); 

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this action!",
        icon: "warning", 
        buttons: {
            cancel: "No", 
            button: { 
              text: "Yes",
              closeModal: false,
            }
          },
        dangerMode: true,  
        closeOnClickOutside: false
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: "/RestaurantApp/admin/controller/public/controller.resetpassword.php",
                    type: "POST",
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify({
                      token: sessionStorage.getItem("user_token"), 
                      userid: loguserid,
                      oldpassword: oldpass,
                      newpassword: newpass 
                    }),
                    success: function(data, textStatus, xhr) {
                      console.log(data);
                      if (data.isnewtoken == "1") {
                        sessionStorage.setItem("user_token", data.token);
                      }
              
                      if (data.message == "success" && data.code == "1") {
                         
                          swal("Operation Success!","Page will auto logout in 5 seconds!","success");
                          // $("#submit_result").html(
                          //     '<div class="alert alert-success">Successfully Saved!</div>'
                          // );
              
                          setTimeout(() => {
                              location.href = "logout.php";
                          }, 5000);
              
                      } else if (data.message == "incorrect" && data.code == "1") {
                          swal("Current Password Incorrect!","","error");
                          // $("#submit_result").html(
                          //     '<div class="alert alert-danger">Current Password Incorrect</div>'
                          // );
                          
                      } else if (data.message == "incorrect email" && data.code == "1") {
                          swal("Incorrect Email!","","error");
                          // $("#submit_result").html(
                          //     '<div class="alert alert-danger">Incorrect Email</div>'
                          // );
                          
                      }else {
                          // $("#submit_result").html(
                          //     '<div class="alert alert-danger">Something went wrong!</div>'
                          // );
                          swal("Operation Unsuccess!", "", "error");
                        //   swal("Something went wrong!","","error");
                      }
                    },
                    error: function(xhr, textStatus, errorThrown) { 
                      console.log(xhr);
                      swal("Something went wrong!","","error");
                      // $("#submit_result").html(
                      //   '<div class="alert alert-danger">Something went wrong!</div>'
                      // );
                    }
                  });

            } else {
                //nothing happen
            }
        });

    


    // setTimeout(() => {
    //   $("#submit_result").html("");
    // }, 3000);
});
