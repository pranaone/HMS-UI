$(document).ready(function() {
    GetCurrentUserData();
    $('#btnUpdate').hide();
    $('#btnCancelUpdate').hide();
    $('#btnEnableUpdate').show();
  });
  
  function GetCurrentUserData()
  {
    var userID = sessionStorage.getItem("log_user_id");
    $.ajax({
      url: "http://localhost:51053/api/user/GetUserForMyAccount",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: userID
      }),
      success: function(data) {
        console.log(data);
        var regDate = new Date(data[0].RegisteredDate);
        $("#firstname").val(data[0].Firstname);
        $("#lastname").val(data[0].Lastname);
        $("#addressLine1").val(data[0].Address_line_1);
        $("#addressLine2").val(data[0].Address_line_2);
        $("#postalCode").val(data[0].PostalCode);
        $("#mobileNo").val(data[0].MobileNo);
        $("#email").val(data[0].Email);
        $("#role").val(data[0].RoleID);
        $("#activeStatus").val(data[0].ActiveStatus);
        $("#registeredDate").val(regDate.toDateString());
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

  $('#btnEnableUpdate').click(function(e){
      e.preventDefault();
    $('#btnUpdate').show();
    $('#btnCancelUpdate').show();
    $('#btnEnableUpdate').hide();
    $("#firstname").removeAttr("readonly");
    $("#lastname").removeAttr("readonly");
    $("#addressLine1").removeAttr("readonly");
    $("#addressLine2").removeAttr("readonly");
    $("#postalCode").removeAttr("readonly");
    $("#mobileNo").removeAttr("readonly");
  });


$('#btnUpdate').click(function(e){
    e.preventDefault();
  $('#btnEnableUpdate').show();
  $('#btnUpdate').hide();
  $('#btnCancelUpdate').hide();
});

$('#btnCancelUpdate').click(function(e){
    e.preventDefault();
  $('#btnEnableUpdate').show();
  $('#btnCancelUpdate').hide();
  $('#btnUpdate').hide();
  $("#firstname").attr('readonly', true);
  $("#lastname").attr('readonly', true);
  $("#addressLine1").attr('readonly', true);
  $("#addressLine2").attr('readonly', true);
  $("#postalCode").attr('readonly', true);
  $("#mobileNo").attr('readonly', true);
});

