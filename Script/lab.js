$(document).ready(function() {
  $(".objoverlay").css("display", "block");
  GetAllReports();
  GetReportTypes();

  $(".objoverlay").css("display", "none");
});


var AllReports;


function GetAllReports() {
  $.ajax({
    url: "http://localhost:51053/api/report/GetReports",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      ShowAllReports("SHOW ALL REPORT DATA");
      ShowAllReports(data);
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}

function ShowAllReports(data)
{
  $('#printModalAllRpt').html('');
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    AllReports = data;
    var sampleDate = new Date(data[rowno].SampleDate);
    var testedDate = new Date(data[rowno].TestedDate);
    var htmlData = new Date(data[rowno].ReportHtml);

    sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + data[rowno].PatientID + "</td>";
      sertable += "<td>" + data[rowno].ReportType + "</td>";
      sertable += "<td>" + sampleDate.toLocaleDateString() + "</td>";
      sertable += "<td>" + testedDate.toLocaleDateString() + "</td>";
      sertable +=
        "<td><input type='button' id='viewReport"+rowcount+"' value='View Report' class='btn btn-success btn-sm viewReport' data-id='" +
        data[rowno].ID + "'> " +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#viewReport"+rowcount , function(e, htmlData) {
        //$('#ReportTypeID').val(e.currentTarget.dataset["id"]);
        debugger;
        var id = e.currentTarget.dataset["id"];

        AllReports.forEach(item => {
          if(item.ID == id)
          {
            console.log(item.ReportHtml);
            $('#printModalAllRpt').append(item.ReportHtml);
          }
        });

        $('#AllReportViewModal').modal('show');
      });
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
    $("#AllReportsBody").html("");
    $("#AllReportstable").attr("style", "display:none");
    return;
  }
  else{
    $("#AllReportstable").removeAttr("style");
  }

  $("#AllReportsBody").html("");
  $("#AllReportsBody").html(sertable);
}

$("#AllReportViewModalClose").click(function(){
  $('#printModalAllRpt').html('');
  $('#AllReportViewModal').modal('hide');
});


$("#btnAddNewRptType").click(function(e) {
  e.preventDefault();
  var reportType = $("#newRptType").val();
  if (reportType != null && reportType.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/report/AddNewReportType",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        Name: reportType
      }),
      success: function(data) {
        swal("New Report Type has been Added!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        console.log(data);
        //toastr.error(data.responseJSON.Message, "Invalid Details!");
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding the Report Type!", {
            icon: "error",
          });
        }
      }
    });
  } else {
    toastr.error("Please Enter A Valid Report Type!.", "Invalid Details!");
  }
  $("#userrole").val("");
});

function Clearfield(){
  $("#PatientList").val("");
  $("#ReportTypeList").val("");
  $("#PatientSearch").val("");
  $("#sampleDate").val("");
  $("#testedDate").val("");
  $("#results").val("");
  $("#remarks").val("");
}


function GetReportTypes() {
  $.ajax({
    url: "http://localhost:51053/api/report/GetReportTypes",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      userRoles = data;
      userRoles.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#ReportTypeList").append(itemHTML);
      });
      ShowReportTypes(data);
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

function ShowReportTypes(data)
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
      sertable += "<td>" + date + "</td>";
      sertable +=
        "<td><input type='button' id='editReportType"+rowcount+"' value='Update' class='btn btn-black btn-sm editReportType' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> " +
        "<a id='deleteReportType"+rowcount+"' class='btn btn-danger btn-sm deleteReportType' data-id='" + data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'><i class='fas fa-trash'></i> Delete </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#editReportType"+rowcount , function(e) {
        $('#ReportTypeID').val(e.currentTarget.dataset["id"]);
        $('#ReportTypeOldTxt').val(e.currentTarget.dataset["name"]);
        $('#ReportTypeUpdateModal').modal('show');
      });

      $(document).on("click", "a#deleteReportType"+rowcount , function(e) {
        var toDeleteID = e.currentTarget.dataset["id"];
        var toDeleteReportType = e.currentTarget.dataset["name"];
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              DeleteReportType(toDeleteID,toDeleteReportType);
            }
          });
      });
    }
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
    $("#reportTypesBody").html("");
    $("#reportTypestable").attr("style", "display:none");
    return;
  }
  else{
    $("#reportTypestable").removeAttr("style");
  }

  $("#reportTypesBody").html("");
  $("#reportTypesBody").html(sertable);
}

function DeleteReportType(roleID, reportType)
{
  $.ajax({
    url: "http://localhost:51053/api/report/DeleteReportType",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: roleID,
      Name: reportType
    }),
    success: function(data) {
      swal("Report Type has been deleted!", {
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


function UpdateReportType()
{
  var reportTypeID = $("#ReportTypeID").val();
  var reportTypeOld = $("#ReportTypeOldTxt").val();
  var reportTypeNew = $("#ReportTypeUpdateTxt").val();
  if(reportTypeNew == "" || reportTypeNew == null)
  {
    swal("Please Enter a valid Report Type!", {
      icon: "warning",
    });
  }
  else if(reportTypeNew == reportTypeOld)
  {
    swal("Report Type Exist! Please Enter a Different Type!", {
      icon: "warning",
    });
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/report/UpdateReportType",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: reportTypeID,
        Name: reportTypeNew
      }),
      success: function(data) {
        swal("Report Type Successfully Updated!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        console.log(data);
        swal("Something went wrong in updating Report Type!", {
          icon: "error",
        });
      }
    });
  }
}

$('#btnUpdateReportType').click(function(){
  UpdateReportType();
  $('#ReportTypeUpdateModal').modal('hide');
});


$("#btnPatientSearch").click(function(e) {
  e.preventDefault();
  var patientname = $("#PatientSearch").val();
  if (patientname != null && patientname.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/patient/SearchPatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
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
        $("#PatientList").empty();
        $("#PatientSearch").val('');
        $("#PatientList").append(itemHTML);
      })},
      error: function(data) {
        swal("Something went wrong in Getting Patients!", {
          icon: "error",
        });
      }
    });
  } else {
    toastr.error("Please Enter A Patient Name.", "Invalid Details!");
  }
});

$("#viewRpt").click(function(e){
  e.preventDefault();
  ShowReportStructure();
});


function ShowReportStructure(){
  var patientID = $("#PatientList").val();
  var patientName = $("#PatientList option:selected").html();

  var reportTypeID = $("#ReportTypeList").val();
  var reportType = $("#ReportTypeList option:selected").html();

  var fee = $("#fee").val();
  var sampleDateOne = $("#sampleDate").val();
  var sampleDate = new Date(sampleDateOne).toLocaleDateString();

  var testedDateOne = $("#testedDate").val();
  var testedDate = new Date(testedDateOne).toLocaleDateString();

  var results = $("#results").val();
  var remarks = $("#remarks").val();


  if(
    (patientID != "" && patientID != null) &&
    (reportTypeID != "" && reportTypeID != null) &&
    (fee != "" && fee != null) &&
    (sampleDate != "" && sampleDate != null) &&
    (testedDate != "" && testedDate != null) &&
    (results != "" && results != null) &&
    (remarks != "" && remarks != null)
  )
  {
    $("#PatientNameRpt").html(patientName);
    $("#ReportTypeRpt").html(reportType);
    $("#SampleDateRpt").html(sampleDate);
    $("#TestedDateRpt").html(testedDate);
    $("#ResultsRpt").html(results);
    $("#RemarksRpt").html(remarks);
    $("#FeeRpt").html(fee);

    var rptHtml = $("#printModal").html();


    $.ajax({
      url: "http://localhost:51053/api/report/AddReport",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        PatientID: patientID,
        ReportType: reportTypeID,
        Results: results,
        SampleDate: sampleDate,
        TestedDate: testedDate,
        Remarks: remarks,
        Fee: fee,
        ReportHtml: rptHtml
      }),
      success: function(data) {
        console.log(data);
        $("#ReportViewModal").modal('show');
        Clearfield();
      },
      error: function(data) {
        swal("Something went wrong in In Saving the Report!", {
          icon: "error",
        });
      }
    });
  }
  else{
    toastr.error("Please Enter Valid Details.", "Invalid Details!");
  }


}

$("#btnPrintRpt").click(function(){
  $('#printModal').printThis({
    header: "<h3>Lab Report!</h3>"
  });
});

$("#btnPrintRptAllRpt").click(function(){
  $('#printModalAllRpt').printThis({
    header: "<h3>Lab Report!</h3>"
  });
});



// PATIENT REPORT START//
$("#btnPatientrptSearch").click(function(e) {
  e.preventDefault();
  var patientname = $("#PatientrptSearch").val();
  if (patientname != null && patientname.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/patient/SearchPatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
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
        $("#PatientRptList").empty();
        $("#PatientRptList").append('<option value=""> -- Select A Patient -- </option>');
        $("#PatientRptList").append(itemHTML);
      })},
      error: function(data) {
        swal("Something went wrong in Getting Patients!", {
          icon: "error",
        });
      }
    });
  } else {
    toastr.error("Please Enter A Patient Name.", "Invalid Details!");
  }
});

$('#PatientRptList').change(function(){
  var patientID = $(this).val();

  if(patientID == "" || patientID == null)
  {
    $("#PatientReportstable").attr("style", "display:none");
    $("#PatientrptSearch").val('');
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/report/GetPatientReport",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        PatientID: patientID
      }),
      success: function(data) {
        console.log(data);
        ShowPatientsReports(data);
      },
      error: function(data) {
        swal("Something went wrong in Getting Patients!", {
          icon: "error",
        });
      }
    });
  }

});

function ShowPatientsReports(data)
{
  $('#printModalAllRpt').html('');
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    AllReports = data;
    var sampleDate = new Date(data[rowno].SampleDate);
    var testedDate = new Date(data[rowno].TestedDate);
    var htmlData = new Date(data[rowno].ReportHtml);

    sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + data[rowno].PatientID + "</td>";
      sertable += "<td>" + data[rowno].ReportType + "</td>";
      sertable += "<td>" + sampleDate.toDateString() + "</td>";
      sertable += "<td>" + testedDate.toDateString() + "</td>";
      sertable +=
        "<td><input type='button' id='viewPatientReport"+rowcount+"' value='View Report' class='btn btn-success btn-sm viewPatientReport' data-id='" +
        data[rowno].ID + "'> " +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#viewPatientReport"+rowcount , function(e, htmlData) {
        var id = e.currentTarget.dataset["id"];

        AllReports.forEach(item => {
          if(item.ID == id)
          {
            console.log(item.ReportHtml);
            $('#printModalAllRpt').append(item.ReportHtml);
          }
        });

        $('#AllReportViewModal').modal('show');
      });
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
    $("#PatientReportsBody").html("");
    $("#PatientReportstable").attr("style", "display:none");
    return;
  }
  else{
    $("#PatientReportstable").removeAttr("style");
  }

  $("#PatientReportsBody").html("");
  $("#PatientReportsBody").html(sertable);
}


// PATIENT REPORT END//
