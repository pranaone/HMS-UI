const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$(document).ready(function() {
  GetUserRoles();
  GetDoctorCategories();
  GetUsers();
  // $("#mainSpinner").hide();
  $("#docCatDiv").attr("hidden",true);
});

function getDate() {
  var today = new Date();
  var date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  var time =
    today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  return (dateTime = date + " " + time);
}

$('#userRoles').on('change', function() {
  console.log(this.innerHTML);
  if(this.value == 2 )
  {
    $("#docCatDiv").attr("hidden",false);
  }
  else{
    $("#docCatDiv").attr("hidden",true);
  }
});

$("#btnAddUserRole").click(function(e) {
  e.preventDefault();
  var userrole = $("#userrole").val();
  var userID = sessionStorage.getItem("log_user_id");
  console.log(userrole);
  if (userrole != null && userrole.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/userRole/AddUserRole",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        Name: userrole
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Data Added!");
        location.reload(true);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Invalid Details!");
      }
    });
  } else {
    toastr.error("Please Enter A Valid User Role!.", "Invalid Details!");

    // swal({
    //     title: "Are you sure?",
    //     text: "You will not be able to recover this action!",
    //     icon: "warning",
    //     buttons: {
    //         cancel: "No"
    //       },
    //     dangerMode: true,
    //     closeOnClickOutside: false
    //     });
  }
  $("#userrole").val("");
});

/**on search click */
$("#btnsearch").click(function(e) {
  GetUsers();
});

$("#btnAddNewUser").click(function(e) {
  registerUser(e);
});

function registerUser(e) {
  e.preventDefault();
  var userFirstName = $("#userFirstName").val();
  var userLastName = $("#userLastName").val();
  var userEmail = $("#userEmail").val();
  var userPassword = $("#userPassword").val();
  var userConfirmPassword = $("#userConfirmPassword").val();
  var userMobileNo = $("#userMobileNo").val();
  var userGender = $("#userGender").val();
  var userRoles = $("#userRoles").val();
  var doctorCategory = $("#doctorCategoryList").val();

  if (
    userFirstName == null ||
    userFirstName == "" ||
    userLastName == null ||
    userLastName == "" ||
    userEmail == null ||
    userEmail == "" ||
    userPassword == null ||
    userPassword == "" ||
    userConfirmPassword == null ||
    userConfirmPassword == "" ||
    userMobileNo == null ||
    userMobileNo == "" ||
    userGender == null ||
    userGender == "" ||
    userRoles == null ||
    userRoles == ""
  ) {
    toastr.error("Please Enter Valid Data to register the user!!.", "Error!");
    return;
  } else {
    if (userConfirmPassword !== userPassword) {
      toastr.error("Passwords Don't Match!!.", "Error!");
      return;
    } else {
      $.ajax({
        url: "http://localhost:51053/api/auth/Register",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          firstname: userFirstName,
          lastname: userLastName,
          email: userEmail,
          Password: userPassword,
          username: userEmail,
          mobileNo: userMobileNo,
          gender: userGender,
          RoleID: userRoles,
          registered_date: getDate(),
          Doctor_Category: doctorCategory
        }),
        success: function(data) {
          toastr.success(
            "We have sent you an email to Verify your account!.",
            "Registation Successsful!"
          );
          location.reload();
        },
        error: function(data) {
          console.log(data);
          toastr.error(
            "Please Enter Valid Details To Register!.",
            "Invalid Details!"
          );
        }
      });
    }
  }
}

function clearFields() {
  $("#userFirstName").val("");
  $("#userLastName").val("");
  $("#userEmail").val("");
  $("#userPassword").val("");
  $("#userConfirmPassword").val("");
  $("#userMobileNo").val("");
  $("#userGender").val("");
  $("#userRoles").val("");
}

function GetUserRoles() {
  $.ajax({
    url: "http://localhost:51053/api/userRole/GetUserRoles",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    // data: JSON.stringify({
    //   userID: sessionStorage.getItem("log_user_id"),
    //   token: sessionStorage.getItem("user_token"),
    //   email: sessionStorage.getItem("log_user_email")
    // }),
    success: function(data) {
      userRoles = data;
      userRoles.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#userRoles").append(itemHTML);
      });
      ShowUserRoles(data);
      // for(var i = 0; i < userRoles.length; i++)
      // {
      //   var itemHTML = '<option value="' + userRoles[i].user_role_id + '">'+ userRoles[i].user_role +'</option>';
      //   $("#userRoles").append(itemHTML);
      // }
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}

function ShowUserRoles(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var uname = data[rowno].Name;
    var date = new Date(data[rowno].DateAdded);
    if (uname.toLowerCase().indexOf(name.toLowerCase()) >= 0) {
      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + uname + "</td>";
      sertable += "<td>" + date.toDateString() + "</td>";
      sertable +=
        "<td><input type='button' id='editUserRole"+rowcount+"' value='Update' class='btn btn-black btn-sm editUserRole' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> " +
        "<a id='deleteUserRole"+rowcount+"' class='btn btn-danger btn-sm deleteUserRole' data-id='" + data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'><i class='fas fa-trash'></i> Delete </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#editUserRole"+rowcount , function(e) {
        $('#userroleID').val(e.currentTarget.dataset["id"]);
        $('#userroleOldTxt').val(e.currentTarget.dataset["name"]);
        $('#UserRoleUpdateModal').modal('show');
      });

      $(document).on("click", "a#deleteUserRole"+rowcount , function(e) {
        var toDeleteID = e.currentTarget.dataset["id"];
        var toDeleteRole = e.currentTarget.dataset["name"];
        swal({
            title: "Are you Sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              DeleteUserRole(toDeleteID,toDeleteRole);
            }
          });
      });
    }
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
    $("#UserRolesBody").html("");
    $("#UserRolestable").attr("style", "display:none");
    return;
  }
  else{
    $("#UserRolestable").removeAttr("style");
  }

  $("#UserRolesBody").html("");
  $("#UserRolesBody").html(sertable);
}

function DeleteUserRole(roleID, role)
{
  $.ajax({
    url: "http://localhost:51053/api/userRole/DeleteUserRole",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: roleID,
      Name: role
    }),
    success: function(data) {
      swal("Poof! User Role has been deleted!", {
        icon: "success",
      }).then((willDelete) => {
        if (willDelete) {
          location.reload(true);
        }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
}

function UpdateUserRole()
{
  var roleID = $("#userroleID").val();
  var roleOld = $("#userroleOldTxt").val();
  var role = $("#userroleUpdateTxt").val();
  if(role == "" || role == null)
  {
    swal("Please Enter a valid User Role!", {
      icon: "warning",
    });
  }
  else if(role == roleOld)
  {
    swal("This Role already Exists with the same name! Please Enter a Different User Role!", {
      icon: "warning",
    });
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/userRole/UpdateUserRole",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: roleID,
        Name: role
      }),
      success: function(data) {
        swal("User Role has been Updated!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        console.log(data);
        swal("Something went wrong in updating the User Role!", {
          icon: "error",
        });
      }
    });
  }
}


function GetDoctorCategories() {
  $.ajax({
    url: "http://localhost:51053/api/doctorCategory/GetDoctorCategories",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    // data: JSON.stringify({
    //   userID: sessionStorage.getItem("log_user_id"),
    //   token: sessionStorage.getItem("user_token"),
    //   email: sessionStorage.getItem("log_user_email")
    // }),
    success: function(data) {
      DoctorCategories = data;
      DoctorCategories.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#doctorCategoryList").append(itemHTML);
      });
      ShowDoctorCategories(data)
      // for(var i = 0; i < userRoles.length; i++)
      // {
      //   var itemHTML = '<option value="' + userRoles[i].user_role_id + '">'+ userRoles[i].user_role +'</option>';
      //   $("#userRoles").append(itemHTML);
      // }
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}

function ShowDoctorCategories(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var uname = data[rowno].Name;
    var date = new Date(data[rowno].DateAdded);
    if (uname.toLowerCase().indexOf(name.toLowerCase()) >= 0) {
      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + uname + "</td>";
      sertable += "<td>" + date.toDateString() + "</td>";
      sertable +=
        "<td><input type='button' id='editDoctorCategory"+rowcount+"' value='Update' class='btn btn-black btn-sm editDoctorCategory' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> " +
        "<a id='deleteDoctorCategory"+rowcount+"' class='btn btn-danger btn-sm deleteDoctorCategory' data-id='" + data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'><i class='fas fa-trash'></i> Delete </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#editDoctorCategory"+rowcount , function(e) {
        $('#doctorCategoryID').val(e.currentTarget.dataset["id"]);
        $('#doctorCategoryTxtOld').val(e.currentTarget.dataset["name"]);
        $('#doctorCategoryUpdateModal').modal('show');
      });

      $(document).on("click", "a#deleteDoctorCategory"+rowcount , function(e) {
        var toDeleteID = e.currentTarget.dataset["id"];
        var toDeleteDoctorCategory = e.currentTarget.dataset["name"];
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              // swal("Poof! Your imaginary file has been deleted!", {
              //   icon: "success",
              // });
              DeleteDoctorCategory(toDeleteID,toDeleteDoctorCategory);
            }
            // else {
            //   swal("Your imaginary file is safe!");
            // }
          });
      });

    }
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
    $("#DocCategoriesBody").html("");
    $("#DocCategoriestable").attr("style", "display:none");
    return;
  }
  else{
    $("#DocCategoriestable").removeAttr("style");
  }

  $("#DocCategoriesBody").html("");
  $("#DocCategoriesBody").html(sertable);
}


function DeleteDoctorCategory(docCategoryID, docCategory)
{
  $.ajax({
    url: "http://localhost:51053/api/doctorCategory/DeleteDoctorCategory",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: docCategoryID,
      Name: docCategory
    }),
    success: function(data) {
      swal("Poof! Doctor Category has been deleted!", {
        icon: "success",
      }).then((willDelete) => {
        if (willDelete) {
          location.reload(true);
        }
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
}

function UpdateDoctorCategory()
{
  var docCategoryID = $("#doctorCategoryID").val();
  var docCategoryOld = $("#doctorCategoryTxtOld").val();
  var docCategory = $("#doctorCategoryTxtUpdate").val();
  if(docCategory == "" || docCategory == null)
  {
    swal("Please Enter a valid Doctor Category!", {
      icon: "warning",
    });
  }
  else if(docCategoryOld == docCategory)
  {
    swal("A Doctor Category aleady exists with the same name! Please Enter a Different Doctor Category!", {
      icon: "warning",
    });
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/doctorCategory/UpdateDoctorCategory",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: docCategoryID,
        Name: docCategory
      }),
      success: function(data) {
        swal("Doctor Category has been Updated!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        console.log(data);
        swal("Something went wrong in updating the Doctor Category!", {
          icon: "error",
        });
      }
    });
  }
}

function GetUsers() {
  debugger;
  $("#mainSpinner").show();
  //var searchName = $("#searchName").val();
  //var searchEmail = $("#searchEmail").val();

  // $("#search_result").html('<div class="alert alert-warning">Please Wait...</div>');
  swal("Please wait...", "", {
    button: false,
    closeOnClickOutside: false
  });

  $.ajax({
    url: "http://localhost:51053/api/user/GetUsersForUsersPage",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      console.log(data);

      $("#databody").html("");

      var sertable = "";
      var rowcount = 0;
      for (rowno in data) {
        var uname = data[rowno].Firstname + " " + data[rowno].Lastname;
        var addLine1 = data[rowno].address_line_1 == undefined ? 'N/A' : data[rowno].address_line_1;
        var addLine2 = data[rowno].address_line_2 == undefined ? 'N/A' : data[rowno].address_line_2;

        if (uname.toLowerCase().indexOf(name.toLowerCase()) >= 0) {
          var actbtncls = "";
          var actbtnclsTxt = '';
          if (data[rowno].ActiveStatus == "Active") {
            actbtnclsTxt = "Deactivate User";
            actbtncls = "danger";
          } else {
            actbtnclsTxt = "Activate User";
            actbtncls = "success";
          }

          sertable += "<tr id='" + data[rowno].ID + "'>";
          sertable += "<td>" + ++rowcount + "</td>";
          sertable += "<td>" + uname + "</td>";
          sertable += "<td>" + data[rowno].Email + "</td>";
          sertable += "<td>" + data[rowno].Gender; + "</td>";
          // sertable += "<td>" + data[rowno].user_dob + "</td>";
          // sertable += "<td>" + uage + "</td>";
          sertable +=
            "<td>" +
            addLine1 +
            ", " +
            addLine2 +
            "</td>";
          // sertable += "<td>" + data[rowno].user_city + "</td>";
          // sertable += "<td>" + data[rowno].user_country + "</td>";
          sertable += "<td>" + data[rowno].MobileNo + "</td>";
          sertable += "<td>" + data[rowno].RoleID + "</td>";
          sertable += "<td>" + data[rowno].Doctor_Category + "</td>";
          sertable += "<td>" + data[rowno].RegisteredDate + "</td>";
          sertable +=
            "<td><input type='button' id='edituser"+rowcount+"' value='Update User' class='btn btn-black btn-sm edituser' data-id='" +
            data[rowno].ID +
            "'> <input data-status=" +
            data[rowno].ActiveStatus +
            " type='button' value='" +
            actbtnclsTxt +
            "' class='btn btn-" +
            actbtncls +
            " btn-sm actuser'  id='updateActiveStatusBtn"+rowcount+"' data-id='" +
            data[rowno].ID +
            "' ></td>";
          sertable += "</tr>";

          $(document).on("click", "input#updateActiveStatusBtn"+rowcount , function(e) {
            var userID =  e.currentTarget.dataset["id"]
            var activeStatus =  e.currentTarget.dataset["status"]
            activateDeactivateUser(userID,activeStatus);
          });

          $(document).on("click", "input#edituser"+rowcount , function(e) {
            editUserfunc(data);
          });

        }
      }

      for(var i = 1; i < rowcount+1; i++)
      {
        $("#edituser"+rowcount).click(function(){
          alert(121);
        });
      }

      if (rowcount == 0) {
        swal("No Data Found!", "", "error");
        // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
        $("#tableserusersbody").html("");
        $("#serusertable").attr("style", "display:none");
        return;
      }

      $("#tableserusersbody").html("");
      $("#tableserusersbody").html(sertable);
      // $("#search_result").html("");

      swal.close();

      $("#serusertable").attr("style", "display:block");
    },
    error: function(xhr) {
      swal("Something went wrong!", "", "error");
    }
  });


  $("#mainSpinner").hide();
  // setTimeout(() => {
  //   $("#search_result").html("");
  // }, 3000);
}


function editUserfunc(user) {
  console.log(user);
}

function activateDeactivateUser(userID,activeStatus){
  alert(activeStatus);
  $.ajax({
    url: "http://localhost:51053/api/user/ChangeUserActiveStatus",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: userID,
      ActiveStatus: activeStatus
    }),
    success: function(data) {
      console.log(data);
      toastr.success(data, "User Status Changed!");
      location.reload(true);
    },
    error: function(data) {
      console.log(data);
      toastr.error(data.responseJSON.Message, "Something Went Wrong!");
    }
  });
}

$("#btnAddDoctorCategory").click(function(e) {
  e.preventDefault();
  var doctorCategory = $("#doctorCategoryTxt").val();
  var userID = sessionStorage.getItem("log_user_id");
  console.log(userrole);
  if (doctorCategory != null && doctorCategory.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/doctorCategory/AddDoctorCategory",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        Name: doctorCategory
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Data Added!");
        location.reload(true);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Invalid Details!");
      }
    });
  } else {
    toastr.error("Please Enter A Valid User Role!.", "Invalid Details!");
  }
  $("#doctorCategoryTxt").val("");
});


$('#btnUpdateUserRole').click(function(){
  UpdateUserRole();
  $('#UserRoleUpdateModal').modal('hide');
});

$('#btnUpdateDoctorCategory').click(function(){
  UpdateDoctorCategory();
  $('#doctorCategoryUpdateModal').modal('hide');
});
