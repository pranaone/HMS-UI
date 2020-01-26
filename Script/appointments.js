const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$(document).ready(function() {
  GetDoctors();
  GetFee();
  GetAppointments();
});

function getDate() {
  var today = new Date();
  var date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  var time =
    today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  return (dateTime = date + " " + time);
}


$("#btnPatientSearch").click(function(e) {
  $("#PatientID").html('');
  e.preventDefault();
  var patientname = $("#PatientSearch").val();
  //var userID = sessionStorage.getItem("log_user_id");
  console.log(patientname);
  if (patientname != null && patientname.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/patient/SearchPatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization:sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        Name: patientname
      }),
      success: function(data) {
      PatientID = data;
      PatientID.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#PatientID").append(itemHTML);
      })},
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Server Error!");
      }
    });
  } else {
    toastr.error("Please Enter A Patient Name.", "Invalid Details!");
  }
});


function GetAppointments() {
  $.ajax({
    url: "http://localhost:51053/api/appointment/GetAppointments",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      console.log(data);
      ShowAppointments(data);
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}




$("#btnAddAppointment").click(function(e) {
  e.preventDefault();
  var PatID = $("#PatientID").val();
  var DocID= $("#DoctorID").val();
  var AppDate = $("#AppointmentDate").val();
  var AppFee = $("#AppointmentFee").val();
  //console.log(AppFee);
  if (PatID!=null) {
    $.ajax({
      url: "http://localhost:51053/api/appointment/AddAppointment",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        PatientID: PatID,
        DoctorID : DocID,
        Date: AppDate,
        Fee : AppFee
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Data Added!");
        //location.reload(true);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Invalid Details!");
      }
    });
  } else {
    toastr.error("Please Provide valid details!.", "Invalid Details!")
  }
});



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



function ShowAppointments(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var date = new Date(data[rowno].Date).toLocaleDateString();
    var time = new Date(data[rowno].Date).toLocaleTimeString();
      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + data[rowno].PatientID + "</td>";
      sertable += "<td>" + data[rowno].DoctorID + "</td>";
      sertable += "<td>" + date + "</td>";
      sertable += "<td>" + time + "</td>";
      sertable +=
        "<td><a id='deleteUserRole"+rowcount+"' class='btn btn-danger btn-sm deleteUserRole' data-id='" + data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'><i class='fas fa-trash'></i> Cancel </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#editUserRole"+rowcount , function(e) {
        debugger;
        console.log(e.currentTarget.dataset["id"]);
        console.log(e.currentTarget.dataset["name"]);
      });

      $(document).on("click", "a#deleteUserRole"+rowcount,function(e) {
        console.log(e.currentTarget.dataset["id"]);
        console.log(e.currentTarget.dataset["name"]);
        var toDeleteID = e.currentTarget.dataset["id"];
        swal({
            title: "Cancel Appointment?",
            text: "Are you sure to cancel the appointment?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

              DeleteAppointment(toDeleteID);
            }
            // else {
            //   swal("Your imaginary file is safe!");
            // }
          });
      });
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#AppointmentsBody").html("");
    $("#Appointmentstable").attr("style", "display:none");
    return;
  }
  else{
    $("#Appointmentstable").removeAttr("style");
  }

  $("#AppointmentsBody").html("");
  $("#AppointmentsBody").html(sertable);
}

function DeleteAppointment(appID)
{
  $.ajax({
    url: "http://localhost:51053/api/appointment/DeleteAppointment",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: appID
    }),
    success: function(data) {
      swal("Appointment Successfully Cancelled!!", {
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

function GetDoctors() {
  $.ajax({
    url: "http://localhost:51053/api/doctor/GetDoctors",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      //Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      DoctorID = data;
      DoctorID.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#DoctorID").append(itemHTML);
      });
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}

function GetFee() {
  $.ajax({
    url: "http://localhost:51053/api/appointment/GetFees",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      //Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      AppointmentFee = data;
      console.log(data);
      AppointmentFee.forEach(item => {
        var itemHTML =
          '<option value=' +
          item.Fee +
          '>' +
          item.Description +
          "</option>";
        $("#AppointmentFee").append(itemHTML);
      });
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}

function ShowAppointmxxxents(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var uname = data[rowno].Name;
    var date = new Date(data[rowno].DateAdded);
    if (rowcount >= 0) {
      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + uname + "</td>";
      sertable += "<td>" + date.toDateString() + "</td>";
      sertable +=
        "<td><input type='button' id='editDoctorCategory"+rowcount+"' value='Select' class='btn btn-black btn-sm editDoctorCategory' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> " +
        "<a id='deleteDoctorCategory"+rowcount+"' class='btn btn-danger btn-sm deleteDoctorCategory' data-id='" + data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'><i class='fas fa-trash'></i> Delete </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#editDoctorCategory"+rowcount , function(e) {
        debugger;
        console.log(e.currentTarget.dataset["id"]);
        console.log(e.currentTarget.dataset["name"]);
      });

      $(document).on("click", "a#deleteDoctorCategory"+rowcount , function(e) {
        var toDeleteID = e.currentTarget.dataset["id"];
        var toDeleteDoctorCategory = e.currentTarget.dataset["name"];
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
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

function GetUsers() {
  $("#mainSpinner").show();
  var searchName = $("#searchName").val();
  var searchEmail = $("#searchEmail").val();

  // $("#search_result").html('<div class="alert alert-warning">Please Wait...</div>');
  swal("Please wait...", "", {
    button: false,
    closeOnClickOutside: false
  });

  $.ajax({
    url: "http://localhost:50028/api/GetUsers",
    type: "POST",
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      userID: sessionStorage.getItem("log_user_id"),
      token: sessionStorage.getItem("user_token"),
      email: sessionStorage.getItem("log_user_email"),
      name: searchName,
      searchName: searchEmail
    }),
    success: function(data) {
      console.log(data);

      $("#databody").html("");

      var sertable = "";
      var rowcount = 0;
      for (rowno in data) {
        var uname = data[rowno].firstname + " " + data[rowno].lastname;

        if (uname.toLowerCase().indexOf(name.toLowerCase()) >= 0) {
          var gender = data[rowno].gender;

          var userRole = "";

          if (data[rowno].user_role == 1) {
            userRole = "Admin";
          } else if (data[rowno].user_role == 2) {
            userRole = "Customer";
          } else if (data[rowno].user_role == 3) {
            userRole = "Cheff";
          } else if (data[rowno].user_role == 4) {
            userRole = "Driver";
          } else if (data[rowno].user_role == 5) {
            userRole = "Guest";
          }

          var uage =
            new Date(getNowDate()).getFullYear() -
            new Date(data[rowno].user_dob).getFullYear() +
            " Year(s)";

          var userstatus = "";
          var actbtncls = "";
          if (data[rowno].active_status == "0") {
            userstatus = "Active";
            actbtncls = "success";
          } else {
            userstatus = "Inactive";
            actbtncls = "danger";
          }

          sertable += "<tr id='" + data[rowno].userID + "'>";
          sertable += "<td>" + ++rowcount + "</td>";
          sertable += "<td>" + uname + "</td>";
          sertable += "<td>" + data[rowno].email + "</td>";
          sertable += "<td>" + gender + "</td>";
          // sertable += "<td>" + data[rowno].user_dob + "</td>";
          // sertable += "<td>" + uage + "</td>";
          sertable +=
            "<td>" +
            data[rowno].address_line_1 +
            ", " +
            data[rowno].address_line_2 +
            "</td>";
          // sertable += "<td>" + data[rowno].user_city + "</td>";
          // sertable += "<td>" + data[rowno].user_country + "</td>";
          sertable += "<td>" + data[rowno].mobile_no + "</td>";
          sertable += "<td>" + userRole + "</td>";
          sertable +=
            "<td><input type='button' id='edituser"+rowcount+"' value='Select' class='btn btn-black btn-sm edituser' data-id='" +
            data[rowno].userID +
            "'></td>";
          sertable +=
            "<td><input data-status=" +
            data[rowno].active_status +
            " type='button' value=" +
            userstatus +
            " class='btn btn-" +
            actbtncls +
            " btn-sm actuser'></td>";
          sertable += "</tr>";


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
        $("#databody").html("");
        $("#serusertable").attr("style", "display:none");
        return;
      }

      $("#databody").html("");
      $("#databody").html(sertable);
      // $("#search_result").html("");

      swal.close();

      $("#serusertable").attr("style", "display:block");
    },
    error: function(xhr) {
      console.log(xhr);
      swal("Something went wrong!", "", "error");
      // $("#search_result").html('<div class="alert alert-danger">Something went wrong!</div>');
    }
  });

  function editUserfunc(e) {
    alert(e.target.name);
  }

  $("#mainSpinner").hide();
  // setTimeout(() => {
  //   $("#search_result").html("");
  // }, 3000);
}
