$(document).ready(function() {
  $(".objoverlay").css("display", "block");
  GetAllProducts();
  GetAllSalesReports(0,0,'','');

  $(".objoverlay").css("display", "none");
});

var AllReports;

$('#btnFilter').click(function(e){
  e.preventDefault();
  var txnProduct = $('#txnProduct').val();
  var txnPatientList = $('#txnPatientList').val();
  var fromDate = $('#fromDate').val();
  var toDate = $('#ToDate').val();
  GetAllSalesReports(txnPatientList,txnProduct,fromDate,toDate);
});

function GetAllProducts() {
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/GetProducts",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      transactionProducts(data);
    },
    error: function(data) {
      // console.log(data);
      swal(data, {
        icon: "error",
      });
    }
  });

  $("#mainSpinner").hide();
}

function GetAllSalesReports(PatientID, ProductID, FromDate, ToDate) {
  var patientID = PatientID;
  var productID = ProductID;
  var searchFromDate = FromDate;
  var searchToDate = ToDate;
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/GetSalesReports",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      PatientID: patientID,
      ProductID: productID,
      SearchFromDate: searchFromDate,
      SearchToDate: searchToDate,
    }),
    success: function(data) {
      console.log(data);
      // ShowAllSalesReports("show all sales data");
      ShowAllSalesReports(data);
    },
    error: function(data) {
      // console.log(data);
      var sertable = "";
      if(data.responseJSON.Message == "No Sales Exists!")
      {
        sertable += "<tr><td></td><td></td><td><b>"+ data.responseJSON.Message +"</b></td></tr>";
        $("#AllSalesReportsBody").html("");//clear
        $("#AllSalesReportsBody").html(sertable);//refill data
      }
    }
  });

  $("#mainSpinner").hide();
}

function ShowAllSalesReports(data)
{
  debugger;
  //$('#printModalAllRpt').html('');
  var sertable = "";
  var rowcount = 0;
for (rowno in data) {
    AllReports = data;
    //var sampleDate = new Date(data[rowno].SampleDate);
    //var testedDate = new Date(data[rowno].TestedDate);
    //var htmlData = new Date(data[rowno].ReportHtml);
    var salesDate = new Date(data[rowno].SalesDate);

//referring to the model attributes
    sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + data[rowno].PatientName + "</td>";
      sertable += "<td>" + data[rowno].TotalPrice + "</td>";
      sertable += "<td>" + data[rowno].TotalBill + "</td>";
      sertable += "<td>" + salesDate.toDateString() + "</td>";
}
  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    // $("#search_result").html('<div class="alert alert-danger">No Data Found!</div>');
    $("#AllSalesReportsBody").html("");
    $("#AllSalesReportstable").attr("style", "display:none");
    return;
  }
  else{
    $("#AllSalesReportstable").removeAttr("style");
  }

  $("#AllSalesReportsBody").html("");//clear
  $("#AllSalesReportsBody").html(sertable);//refill data
}

function transactionProducts(transactionProductsList){
  transactionProductsList.forEach(item => {
    var itemHTML =
      '<option value="' +
      item.ID +
      '">' +
      item.Name +
      "</option>";
    $("#txnProduct").append(itemHTML);
  });
}

$("#btntxnPatientSearchForRpt").click(function(e) {
  $("#txnPatientList").html('');
  e.preventDefault();
  var patientname = $("#txnPatientSearchForRpt").val();
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
        $("#txnPatientList").append(itemHTML);
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

//print sales report
$("#printreport").click(function(e) {
  printData();
});
function printData() {
  var divToPrint = document.getElementById("tableAllSalesReports");
  newWin = window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}
