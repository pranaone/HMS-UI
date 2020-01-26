const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$(document).ready(function() {

});

function getDate() {
  var today = new Date();
  var date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  var time =
    today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  return (dateTime = date + " " + time);
}


$("#btnSearchPatient").click(function(e) {
  e.preventDefault();
  var patientname = $("#patName").val();
  //var userID = sessionStorage.getItem("log_user_id");
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
        $("#patID").val(item.ID);
        $("#patName").val(item.Name);
        $("#patAddress").val(item.Address);
        $("#patContact").val(item.Contact);
        $("#patNIC").val(item.NIC);
        //$("#isNonNIC").val("");
        $("#guardNIC").val(item.GuardianNIC);
      })},
      error: function(data) {
        //console.log(data);
        toastr.error(data.responseJSON.Message, "Server Error!");
      }
    });
  } else {
    toastr.error("Please Enter A Patient Name.", "Invalid Details!");
  }
});


$("#btnAddPatient").click(function(e) {
  e.preventDefault();
  var patName = $("#patName").val();
  var patAddress= $("#patAddress").val();
  var patContact = $("#patContact").val();
  var PatNIC = $("#patNIC").val();
  var isNonNIC = $("#isNonNIC").val();
  var guardNIC = $("#guardNIC").val();

  if (PatNIC!=null) {
    $.ajax({
      url: "http://localhost:51053/api/patient/AddPatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
          Name : patName,
          Contact : patContact,
          Address : patAddress,
          NIC : PatNIC,
          isNonNIC : isNonNIC,
          GuardianNIC : guardNIC

      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Data Added!");
        clearFields();
        //location.reload(true);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Invalid Details!");
      }
    });
  } else {
    toastr.error("Please Enter A Valid User Role!.", "Invalid Details!")
  }
});

function clearFields() {
    $("#patName").val("");
    $("#patAddress").val("");
    $("#patContact").val("");
    $("#patNIC").val("");
    //$("#isNonNIC").val("");
    $("#guardNIC").val("");
}

$("#btnUpdatePatient").click(function(e) {
  e.preventDefault();
  var PatID = $("#patID").val();
  //console.log(PatID);
  var patName = $("#patName").val();
  var patAddress= $("#patAddress").val();
  var patContact = $("#patContact").val();
  var PatNIC = $("#patNIC").val();
  var isNonNIC = $("#isNonNIC").val();
  var guardNIC = $("#guardNIC").val();
  if (PatID!=null) {
    $.ajax({
      url: "http://localhost:51053/api/patient/UpdatePatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: PatID,
        Name : patName,
        Contact : patContact,
        Address : patAddress,
        NIC : PatNIC,
        isNonNIC : isNonNIC,
        GuardianNIC : guardNIC
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Data Updated!");
        clearFields();
        //location.reload(true);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Invalid Details!");
      }
    });
  } else {
    toastr.error("Internal Error Occured!!", "Invalid Details!")
  }
});

$("#btnDeletePatient").click(function(e) {
  e.preventDefault();
  var PatID = $("#patID").val();
  var ParNIC = $("#patNIC").val();
  if (PatID!=null) {
    $.ajax({
      url: "http://localhost:51053/api/patient/DeletePatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: PatID,
        NIC: ParNIC
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Data Deleted!");
        clearFields();
        //location.reload(true);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Invalid Details!");
      }
    });
  } else {
    toastr.error("Internal Error Occured!!", "Invalid Details!")
  }
});


  $("#mainSpinner").hide();
