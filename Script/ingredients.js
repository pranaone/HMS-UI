$(document).ready(function() {
  GetIngredients();
});

$("#btnAddIngredient").click(function(e) {
  e.preventDefault();
  var ingredientName = $("#ingredientName").val();
  var userID = sessionStorage.getItem("log_user_id");
  console.log(ingredientName);
  if (ingredientName != null && ingredientName.trim() != "") {
    $.ajax({
      url: "http://localhost:50028/api/AddIngredient",
      type: "POST",
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      headers: {
        Authorization: "Bearer " + sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        userID: userID,
        token: sessionStorage.getItem("user_token"),
        email: sessionStorage.getItem("log_user_email"),
        ingredientName: ingredientName
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Ingredient Name Added!");
      },
      error: function(data) {
        console.log(data);
        toastr.error(
          "Error in adding new ingredient Name!!!.",
          "Invalid Details!"
        );
      }
    });
  } else {
    toastr.error("Please Enter A Valid ingredient Name!.", "Invalid Details!");

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
  $("#ingredientName").val("");
});

function GetIngredients() {
  $.ajax({
    url: "http://localhost:50028/api/GetIngredients",
    type: "POST",
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    headers: {
      Authorization: "Bearer " + sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      userID: sessionStorage.getItem("log_user_id"),
      token: sessionStorage.getItem("user_token"),
      email: sessionStorage.getItem("log_user_email")
    }),
    success: function(data) {
      
      console.log(data);
      ingTable(data);
      userRoles = data;
      userRoles.forEach(item => {
        var itemHTML =
          '<option value="' +
          item.ingredientID +
          '">' +
          item.ingredientName +
          "</option>";
        $("#updatingIngredientID").append(itemHTML);
      });

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
}

$("#btnUpdateIngredientQty").click(function(e) {
  e.preventDefault();
  var updatingIngredientID = $("#updatingIngredientID").val();
  var ingredientQty = $("#ingredientQty").val();
  var userID = sessionStorage.getItem("log_user_id");
  console.log(updatingIngredientID);
  if (
    updatingIngredientID != null &&
    updatingIngredientID.trim() != "" &&
    ingredientQty != null &&
    ingredientQty.trim() != "" &&
    ingredientQty > 0
  ) {
    $.ajax({
      url: "http://localhost:50028/api/UpdateIngredientQuantity",
      type: "POST",
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      headers: {
        Authorization: "Bearer " + sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        userID: userID,
        token: sessionStorage.getItem("user_token"),
        email: sessionStorage.getItem("log_user_email"),
        ingredientID: updatingIngredientID,
        quantity: ingredientQty
      }),
      success: function(data) {
        console.log(data);
        toastr.success(data, "Ingredient Name Added!");
      },
      error: function(data) {
        console.log(data);
        toastr.error(
          "Error in adding new ingredient Name!!!.",
          "Invalid Details!"
        );
      }
    });
  } else {
    toastr.error("Please Enter A Valid ingredient Name!.", "Invalid Details!");

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
  $("#updatingIngredientID").val("");
  $("#ingredientQty").val("");
});


function ingTable(data){
  $("#databody").html("");

      var sertable = "";
      var rowcount = 0;
      for (rowno in data) {

        sertable += "<tr id='" + data[rowno].ingredientID + "'>";
        sertable += "<td>" + ++rowcount + "</td>";
        sertable += "<td>" + data[rowno].ingredientName + "</td>";
        sertable += "<td>" + data[rowno].quantity + "</td>";
        sertable +=
          "<td><input type='button' id='edituser"+rowcount+"' value='Select' class='btn btn-black btn-sm edituser' data-id='" +
          data[rowno].userID +
          "'></td>";
        sertable += "</tr>";
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
}