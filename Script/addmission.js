const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

var alllUsers;

$(document).ready(function() {
  GetWardDetails();//display all the wards
  GetAllBeds();//display all the beds
  GetAvailableDoc();//display all the available doctors in the ward details tab combo box
  GetAllWards();//display all the wards
});

function getDate() {
  var today = new Date();
  var date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  var time =
    today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  return (dateTime = date + " " + time);
}

/////////////////start of admit patient tab//////////////
$("#btnPatientSearch").click(function(e) {
    $("#ptntN").html('');
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
        $("#ptntN").append(itemHTML);
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


//add record to admission
$('#btnAddAdmission').click(function(e){
  debugger;
  e.preventDefault();
  var PatID= $('#ptntN').val();
  var AdmissionDate = $('#admissionDate').val();
  var AdmissionFee = $('#admissionFee').val();
  var roomID= $('#room').val();


  if(PatID != null && PatID.trim() != ""){
    $.ajax({
      url: "http://localhost:51053/api/addmission/AdmitPatient",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        PatientID: PatID,
        DateAddmitted: AdmissionDate,
        AdmissionFee: AdmissionFee,
        RoomID: roomID
      }),
      success: function(data) {
        swal("Patient is Admitted!", {
          icon: "success",
        }).then((onOk) => {
          if (onOk) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding a new Admission!", {
            icon: "error",
          });
        }
      }
    });
  }
  else {
    toastr.error("Please Enter A Valid Patient!.", "Invalid Details!");
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


var wards;
function setWardDoc(Ward_ID){
  var wardID = Ward_ID;
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetWardDoc",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: wardID
    }),
    success: function(data) {
      wards = data;

      wards.forEach(item => {
        $("#docInChg").val(item.DocName);
      });

    },
    error: function(data) {
      swal("Something went wrong in Getting Doctor in-charge!", {

        icon: "error",
      });
    }
  });
}



$('#ward').change(function(){
  var wardID = $(this).val();
  setWardDoc(wardID);
  $("#room").empty();
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetAvailableRooms",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      WardID: wardID
    }),
    success: function(data) {
      rooms = data;
      rooms.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#room").append(itemHTML);
      });

      var roomID = $('#room').val();
      setRoomCharge(roomID);

    },
    error: function(data) {
      swal("Something went wrong in Getting Rooms!", {
        icon: "error",
      });
    }
  });
});

$('#room').change(function(){
  var roomID = $(this).val();
  setRoomCharge(roomID);
});

function setRoomCharge(room_ID){
  var roomID = room_ID;
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetRoomPrice",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      //model attributes is assigned with the input values
      ID: roomID
    }),
    success: function(data) {
      rooms = data;
      rooms.forEach(item => {
        $("#roomchgs").val(item.Price);
      });
    },
    error: function(data) {
      swal("Something went wrong in Getting Room Prices!", {
        icon: "error",
      });
    }
  });
}

/////////////////end of admit patient tab//////////////




//////////////Start Bed tab///////////

//add bed
$('#btnAddRoom').click(function(e){

  e.preventDefault();
  var roomTitle= $('#roomTitle').val();
  var roomPrice = $('#roomPrice').val();
  var availability = $('#availability option:selected').index();
  var WardID= $('#WardID').val();

  if(roomTitle != null && roomTitle.trim() != "" && roomPrice!= null && roomPrice.trim() != ""){
    $.ajax({
    //  http request to the conroller function addroom
      url: "http://localhost:51053/api/addmission/AddRoom",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        //assigning the model attributes with the input values
        Name: roomTitle,
        Price: roomPrice,
        IsAvailable: availability,
        WardID: WardID

      }),

      success: function(data) {
        //display success message
        swal("Room Added Successfully!", {
          icon: "success",
        }).then((onOk) => {

          if (onOk) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding a new Bed!", {
            icon: "error",
          });
        }
      }
    });
  }
  else {
    toastr.error("Please Enter Valid Details!", "Invalid Details!");
  }
});

//display all beds
var AllBeds;

function GetAllBeds() {
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetRooms",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      AllBeds = data;
      ShowAllBeds(data);//function call
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


function ShowAllBeds(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var bname= data[rowno].Name;
    var price = data[rowno].Price;
    var availability= data[rowno].IsAvailable;
    var wardid = data[rowno].WardID;

      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + bname + "</td>";
      sertable += "<td>" + price + "</td>";
      sertable += "<td>" + availability  + "</td>";
      sertable += "<td>" + wardid + "</td>";
      sertable +=
        "<td><input type='button' id='editBed"+rowcount+"' value='Update' class='btn btn-black btn-sm editBed' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> "
        "</td>";
      sertable += "</tr>";

      $(document).on("click", "input#editBed"+rowcount , function(e) {
        var itemID = e.currentTarget.dataset["id"];
        $('#BedIDTxt').val(itemID);
        $('#BedOldTxt').val(e.currentTarget.dataset["name"]);

        var Price;
        var IsAvailable;
        var name;

          AllBeds.forEach(item => {
          if(item.ID == itemID){
            Price = item.Price;
            IsAvailable = item.IsAvailable;
          }
        });

        $('#newBedPrice').val(Price);
        $('#newBedAvailability').val(IsAvailable);
        $('#BedUpdateModal').modal('show');
      });


  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#tableRoomBody").html("");
    $("#RoomTable").attr("style", "display:none");
    return;
  }
  else{
    $("#RoomTable").removeAttr("style");
  }

  $("#tableRoomBody").html("");
  $("#tableRoomBody").html(sertable);
}

$('#btnUpdateBed').click(function(){
  UpdateBed();//functon call
});

//update bed details
function UpdateBed()
{
  var RoomID = $("#BedIDTxt").val();
  var RoomOld = $("#BedOldTxt").val();
  var RoomNew = $("#newBedTxt").val();
  var PriceNew = $("#newBedPrice").val();
  if(
    (RoomNew == "" || RoomNew == null) ||
    (PriceNew == "" || PriceNew == null)
  )
  {
    swal("Please Enter Valid Details!", {
      icon: "warning",
    });
  }
  else if(RoomNew == RoomOld)
  {
    swal("Room Name Exist! Please Enter a Different Room Name!", {
      icon: "warning",
    });
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/addmission/UpdateRoom",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: RoomID,
        Name: RoomNew,
        Price: PriceNew,
      }),
      success: function(data) {
        swal("Room Successfully Updated!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        swal("Something went wrong when  updating the Room!", {
          icon: "error",
        });
      }
    });
  }
}

/////////////End of Bed tab////////

/////////////Start of ward tab////////
//Add ward Details
$('#btnAddWard').click(function(e){

  e.preventDefault();
  var wardTitle= $('#wardTitle').val();
  var DoctorID = $('#DoctorID').val();

  if(wardTitle != null && wardTitle.trim() != ""){
    $.ajax({
    //  http request to the conroller function addroom
      url: "http://localhost:51053/api/addmission/AddWard",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        //assigning the model attributes with the input values
        Name: wardTitle,
        DoctorID: DoctorID

      }),

      success: function(data) {
        //display success message
        swal("Ward Added Successfully!", {
          icon: "success",
        }).then((onOk) => {

          if (onOk) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding a new Ward!", {
            icon: "error",
          });
        }
      }
    });
  }
  else {
    toastr.error("Please Enter Valid Details!", "Invalid Details!");
  }
});

//displaying all the available doctors in the combo box
function GetAvailableDoc() {
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetAvailableDoc",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      //Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      wards = data;
      wards.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.DoctorID +
          '">' +
          item.DocName +
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

//display all Wards
var AllWards;

function GetAllWards() {
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetWards",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      AllWards = data;
      ShowAllWards(data);//function call
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


function ShowAllWards(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var ID= data[rowno].ID;
    var wname= data[rowno].Name;
    var Doctorid = data[rowno].DoctorID;

      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + ID + "</td>";
      sertable += "<td>" + wname + "</td>";
      sertable += "<td>" + Doctorid + "</td>";
      sertable +=
        "<td><input type='button' id='editWard"+rowcount+"' value='Update' class='btn btn-black btn-sm editWard' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> "
        "</td>";
      sertable += "</tr>";

      $(document).on("click", "input#editWard"+rowcount , function(e) {
        var itemID = e.currentTarget.dataset["id"];
        $('#WardIDTxt').val(itemID);
        $('#WardOldTxt').val(e.currentTarget.dataset["name"]);

        var DoctorID;
        var IsAvailable;
        var name;

          AllWards.forEach(item => {
          if(item.ID == itemID){
            DoctorID = item.DoctorID;
          }
        });

        $('#newDocID').val(DoctorID);
        $('#WardUpdateModal').modal('show');
      });


  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#tableWardBody").html("");
    $("#WardTable").attr("style", "display:none");
    return;
  }
  else{
    $("#WardTable").removeAttr("style");
  }

  $("#tableWardBody").html("");
  $("#tableWardBody").html(sertable);
}

$('#btnUpdateWard').click(function(){
  UpdateWard();//functon call
});

//update Ward details
function UpdateWard()
{
  var Wardd_ID = $("#WardIDTxt").val();
  var WardOld = $("#WardOldTxt").val();
  var WardNew = $("#newWardTxt").val();
  if(
    (WardNew == "" || WardNew == null)
  )
  {
    swal("Please Enter Valid Details!", {
      icon: "warning",
    });
  }
  else if(WardNew == WardOld)
  {
    swal("Ward Name Exist! Please Enter a Different Ward Name!", {
      icon: "warning",
    });
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/addmission/UpdateWard",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: Wardd_ID,
        Name: WardNew
      }),
      success: function(data) {
        swal("Ward Successfully Updated!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        swal("Something went wrong when  updating the Ward!", {
          icon: "error",
        });
      }
    });
  }
}

/////////////End of ward tab////////

/////////////Start of discharge tab////////
var Room__ID;

//search admission details and display values to text fields
$("#btnAdmissionSrch").click(function(e) {
  e.preventDefault();
  var Adnumber = $("#admNmber").val();
  //$("#patientname").val(patientname);
  //var userID = sessionStorage.getItem("log_user_id");
  //console.log(patientname);
  if (Adnumber != null && Adnumber.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/Addmission/SearchAdmission",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization:sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        AdmissionID: Adnumber
      }),
      success: function(data) {
        console.log(data);
        var admitDtae = new Date(data.admissiondate);
        $("#PtntName").val(data.PatientName);
        $("#admDate").val(admitDtae.toDateString());
        $("#PtntRoom").val(data.RoomName);
        $("#PatientID").val(data.PatientID);
        $("#RoomPrice").val(data.RoomPrice);
        Room__ID = data.RoomID;//save the room id

      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Server Error!");
      }
    });
  } else {
    toastr.error("Please Enter an Admission Number.", "Invalid Details!");
  }
});

$('#btnPatRoomChgs').click(function(e){
  e.preventDefault();
  var roomPrice = $('#RoomPrice').val();
  var admitDate = $('#admDate').val();
  var DisDate = $('#dischargeDate').val();

  console.log(roomPrice);
  var date1 = new Date(admitDate);
  var date2 = new Date(DisDate);

  var Difference_In_Time = date2.getTime() - date1.getTime();

  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

  Difference_In_Days = Math.round(Difference_In_Days * 100) / 100;
  console.log(Difference_In_Days);

  var roomCharges = roomPrice * Difference_In_Days;
  $('#bedcharge').val(roomCharges);
});


$("#btnDischargePatient").click(function(e) {
    e.preventDefault();

//updateDisDateRoomStatus();
adddisBillDetails();//add the bill details to the DB
});

function adddisBillDetails(){
  var Admission_No= $('#admNmber').val();
  var RoomCharge = $('#bedcharge').val();
  var MedCharge = $('#mdcharge').val();
  var ReportCharge= $('#rpcharge').val();
  var dischargedte= $('#dischargeDate').val();

  if(Admission_No == null || Admission_No.trim() == ""  || RoomCharge == null || RoomCharge.trim() == ""|| MedCharge == null || MedCharge.trim() == ""|| ReportCharge == null || ReportCharge.trim() == ""
  ){
      toastr.error("Invalid Action Performed!", "Invalid Details!");
  }
  else {
    $.ajax({
      url: "http://localhost:51053/api/addmission/AddDisBill",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        AdmissionID: Admission_No,
        MedBill: MedCharge,
        ReportBill: ReportCharge,
        RoomBill: RoomCharge,
        RoomID: Room__ID,
        DischargedDate: dischargedte
      }),
      success: function(data) {
        swal("Patient Successfully Discharged!", {
          icon: "success",
        }).then((onOk) => {
          if (onOk) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding the Details!", {
            icon: "error",
          });
        }
      }
    });
  }
}


///////////////End of discharge tab///////////

/////////////Start of Treatment tab////////

//search admission details and display values to text fields and table
$("#btnAdmissionSearch").click(function(e) {
  e.preventDefault();
  var Admnumber = $("#AdmissionNumber").val();

  if (Admnumber != null && Admnumber.trim() != "") {
    $.ajax({
      url: "http://localhost:51053/api/Addmission/GetAdmissionTreatment",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization:sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        AdmissionID: Admnumber
      }),
      success: function(data) {
        console.log(data);
        $("#PatientName").val(data.PatientName);
        $("#PatientRoom").val(data.RoomName);
        $("#RoomPrice").val(data.RoomPrice);
        ShowPatientTreatments(data.PtntTreatments);
      },
      error: function(data) {
        console.log(data);
        toastr.error(data.responseJSON.Message, "Server Error!");
      }
    });
  } else {
    toastr.error("Please Enter an Admission Number.", "Invalid Details!");
  }
});

//add the treatment details to the db table
$('#btnUpdateTreatment').click(function(e){
  e.preventDefault();
  var AdmissionID= $('#AdmissionNumber').val();
  var Treatment = $('#PtntTreatment').val();
  var Medicine = $('#PtntMedicine').val();
  var Report= $('#PtntReports').val();

    $.ajax({
      url: "http://localhost:51053/api/addmission/AddTreatment",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        AdmissionID: AdmissionID,
        PtntTreatment: Treatment,
        Medicines: Medicine,
        Reports: Report
      }),
      success: function(data) {
        swal("Treatment Details are Added!", {
          icon: "success",
        }).then((onOk) => {
          if (onOk) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding Treatment Details!", {
            icon: "error",
          });
        }
      }
    });

});

function ShowPatientTreatments(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var Admission_ID= data[rowno].AdmissionID;
    var ptnttreatmnt= data[rowno].PtntTreatment;
    var medicines = data[rowno].Medicines;
    var reports = data[rowno].Reports;


      sertable += "<tr id='" + data[rowno].ID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + Admission_ID + "</td>";
      sertable += "<td>" + ptnttreatmnt + "</td>";
      sertable += "<td>" + medicines + "</td>";
      sertable += "<td>" + reports + "</td>";
      sertable += "</tr>";
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#tableTreatmentBody").html("");
    $("#TreatmentTable").attr("style", "display:none");
    return;
  }
  else{
    $("#TreatmentTable").removeAttr("style");
  }

  $("#tableTreatmentBody").html("");
  $("#tableTreatmentBody").html(sertable);
}

/////////////End of Treatment tab////////

////////Start of passing the ward details to combo box////////
function GetWardDetails() {
  $.ajax({
    url: "http://localhost:51053/api/addmission/GetWards",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      //Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      wards = data;
      wards.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ID +
          '">' +
          item.Name +
          "</option>";
        $("#ward").append(itemHTML);//admit patient tab
        $("#WardID").append(itemHTML);//room tab
      });
    },
    error: function(data) {
      console.log(data);
    }
  });

  $("#mainSpinner").hide();
}
////////End of passing the ward details to combo box////////
