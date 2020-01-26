var totalOrders;
var totalNoOrOrders = 0;
var completedOrders = 0;
var inProgressOrders = 0;
var pendingOrders = 0;

$(document).ready(function() {
  $(".objoverlay").css("display", "block");

  loadDashboard();
  //reload in every 1 minutes
  window.setInterval(function() {
    loadDashboard();
  }, 1000 * 60);//

  $(".objoverlay").css("display", "none");

  if(sessionStorage.getItem("log_user_role") == 1005)
  {
    location.href = "pharmacy.php";
  }
});

function loadDashboard() {
  console.log('loadDashboard');
  getDashboardData();
}


function getDashboardData(){

  var userid = sessionStorage.getItem("log_user_id");
  var usertoken = sessionStorage.getItem("user_token");
  var email = sessionStorage.getItem("log_user_email");

  $.ajax({
    url: "http://localhost:51053/api/patient/GetPatientsForDashboard",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },

    success: function(data) {
      console.log(data);
      toastr.success(
        "Updated All Data In The Dashboard!!.",
        "Dashboard Updated!"
      );
      totalOrders = data;
      updateUI(data);
    },
    error: function(data) {
      console.log(data);
      toastr.error(
        "Error In Getting Orders!!.",
        "Error!!"
      );
    }
  });
}

function updateUI(DashboardDetails){

  
  $("#totalNoOfPatients").text(DashboardDetails.NoOfPatients);
  $("#NoOfPatientsAdmitted").text(DashboardDetails.NoOfPatientsAdmitted);
  $("#NoOfPatientsDischarged").text(DashboardDetails.NoOfPatientsDischarged);
  $("#NoOfPatientsInHouse").text(DashboardDetails.NoOfPatientsInHouse);
}