$(document).ready(function() {
  //$(".objoverlay").css("display", "block");

  GetAllProducts();
  GetAllInventoryRecords();

  if(sessionStorage.getItem("cartHeaderID"))
  {
    GetCartDetails();
    $('#btnVoidBill').removeAttr("disabled");
    $('#btnOpenNewBill').attr('disabled', 'disabled');
  }
  else{
    $('#btnTxnItemAddToCart').attr('disabled', 'disabled');
    $('#btnMakePayment').attr('disabled', 'disabled');
    $('#btnOpenNewBill').removeAttr("disabled");
    $('#btnVoidBill').attr('disabled', 'disabled');
  }
  $(".mainSpinner").css("display", "none");
});

// PRODUCTS START //
var AllProducts;
var AllInventory;
var MainTotalBill = 0;
var taxPercentage = 0;

$('#btnAddProduct').click(function(e){
  e.preventDefault();

  var productTitle = $('#productTitle').val();
  var description = $('#productDescription').val();
  var unitPrice = $('#ProductUnitPrice').val();

  if(productTitle != null && productTitle.trim() != ""){
    $.ajax({
      url: "http://localhost:51053/api/Pharmacy/AddProducts",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        Name: productTitle,
        Description: description,
        UnitPrice: unitPrice
      }),
      success: function(data) {
        swal("New Product has been Added!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
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
          swal("Something went wrong in Adding a new Product!", {
            icon: "error",
          });
        }
      }
    });
  }
  else {
    toastr.error("Please Enter A Valid Product Title!.", "Invalid Details!");
  }
  $("#productTitle").val("");
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
      AllProducts = data;
      ShowAllProducts(data);
      inventoryProducts(data);
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

function ShowAllProducts(data)
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
      sertable += "<td>" + data[rowno].Description + "</td>";
      sertable += "<td>" + (data[rowno].UnitPrice).toString()  + "</td>";
      sertable += "<td>" + date.toDateString() + "</td>";
      sertable +=
        "<td><input type='button' id='editProduct"+rowcount+"' value='Update' class='btn btn-black btn-sm editProduct' data-id='" +
        data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'> " +
        "<a id='deleteProduct"+rowcount+"' class='btn btn-danger btn-sm deleteProduct' data-id='" + data[rowno].ID +
        "' data-name='" + data[rowno].Name + "'><i class='fas fa-trash'></i> Delete </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "input#editProduct"+rowcount , function(e) {
        var itemID = e.currentTarget.dataset["id"];
        $('#ProductIDTxt').val(itemID);
        $('#PrductOldTxt').val(e.currentTarget.dataset["name"]);

        var desc;
        var UnitPrice;
        var name;

        AllProducts.forEach(item => {
          if(item.ID == itemID){
            desc = item.Description;
            UnitPrice = item.UnitPrice;
          }
        });

        $('#newProductDescription').val(desc);
        $('#newProductPrice').val(UnitPrice);
        $('#ProductUpdateModal').modal('show');
      });

      $(document).on("click", "a#deleteProduct"+rowcount , function(e) {
        var toDeleteID = e.currentTarget.dataset["id"];
        var toDeleteProduct = e.currentTarget.dataset["name"];
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              DeleteProduct(toDeleteID,toDeleteProduct);
            }
          });
      });
    }
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#ProductsBody").html("");
    $("#Productstable").attr("style", "display:none");
    return;
  }
  else{
    $("#Productstable").removeAttr("style");
  }

  $("#ProductsBody").html("");
  $("#ProductsBody").html(sertable);
}

function DeleteProduct(productID, product)
{
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/DeleteProducts",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ID: productID,
      Name: product
    }),
    success: function(data) {
      swal("Product has been deleted!", {
        icon: "success",
      }).then((willDelete) => {
        if (willDelete) {
          location.reload(true);
        }
      });
    },
    error: function(data) {
      // console.log(data);
      swal(data, {
        icon: "error",
      });
    }
  });
}

$('#btnUpdateProduct').click(function(){
  UpdateProduct();
});

function UpdateProduct()
{
  var ProductID = $("#ProductIDTxt").val();
  var ProductOld = $("#PrductOldTxt").val();
  var ProductNew = $("#newProductTxt").val();
  var ProductNewDescription = $("#newProductDescription").val();
  var ProductNewPrice = $("#newProductPrice").val();
  if(
    (ProductNew == "" || ProductNew == null) ||
    (ProductNewDescription == "" || ProductNewDescription == null) ||
    (ProductNewPrice == "" || ProductNewPrice == null)
  )
  {
    swal("Please Enter a valid Product!", {
      icon: "warning",
    });
  }
  else if(ProductNew == ProductOld)
  {
    swal("There Exists A Product with the same name! Please Enter a Different Product!", {
      icon: "warning",
    });
  }
  else{
    $.ajax({
      url: "http://localhost:51053/api/Pharmacy/UpdateProduct",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ID: ProductID,
        Name: ProductNew,
        Description: ProductNewDescription,
        UnitPrice: ProductNewPrice
      }),
      success: function(data) {
        swal("Product has been Updated!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        swal("Something went wrong in updating the Product!", {
          icon: "error",
        });
      }
    });
  }
}
// PDOUCTS END //


// INVENTORY START //

function inventoryProducts(inventoryProductsList){
  inventoryProductsList.forEach(item => {
    var itemHTML =
      '<option value="' +
      item.ID +
      '">' +
      item.Name +
      "</option>";
    $("#invProduct").append(itemHTML);
  });
}

$('#btnAddInventory').click(function(e){
  e.preventDefault();

  var invProduct = $('#invProduct').val();
  var invQuantity = $('#invQuantity').val();

  if(
    (invProduct != null && invProduct.trim() != "") &&
    (invQuantity != null && invQuantity.trim() != "")
  ){
    $.ajax({
      url: "http://localhost:51053/api/Pharmacy/AddInventory",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        ProductID: invProduct,
        Quantity: invQuantity
      }),
      success: function(data) {
        swal("New Inventory Record has been Added!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
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
          swal("Something went wrong in Updating Inventory!", {
            icon: "error",
          });
        }
      }
    });
  }
  else {
    toastr.error("Please Enter A Valid Product Title!.", "Invalid Details!");
  }
  $("#invQuantity").val("");
});

function GetAllInventoryRecords() {
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/GetInventory",
    type: "GET",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    success: function(data) {
      // console.log(data);
      AllInventory = data;
      ShowAllInventory(data);
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

function ShowAllInventory(data)
{
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var uname = data[rowno].Name;

    if (uname.toLowerCase().indexOf(name.toLowerCase()) >= 0) {
      ++rowcount
      sertable += "<tr id='" + rowcount + "'>";
      sertable += "<td>" + rowcount + "</td>";
      sertable += "<td>" + uname + "</td>";
      sertable += "<td>" + data[rowno].Quantity  + "</td>";
      sertable += "</tr>";
    }
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#InventoryBody").html("");
    $("#Inventorytable").attr("style", "display:none");
    return;
  }
  else{
    $("#Inventorytable").removeAttr("style");
  }

  $("#InventoryBody").html("");
  $("#InventoryBody").html(sertable);
}

// INVENTORY END //

// TRANSACTOIONS START //

$('#btnOpenNewBill').click(function(){
  var userID = sessionStorage.getItem("log_user_id");
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/OpenNewBill",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      CartHeaderID: userID,
      UserID: userID
    }),
    success: function(data) {
      sessionStorage.setItem("cartHeaderID", data);
      $('#btnTxnItemAddToCart').removeAttr("disabled");
      $('#btnMakePayment').removeAttr("disabled");
      $('#btnVoidBill').removeAttr("disabled");
      $('#btnOpenNewBill').attr('disabled', 'disabled');
    },
    error: function(data) {
      swal("Something went wrong in Getting Patients!", {
        icon: "error",
      });
    }
  });
});

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

$("#btntxnPatientSearch").click(function(e) {
  $("#txnPatientList").html('');
  e.preventDefault();
  var patientname = $("#txnPatientSearch").val();
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


$('#txnProduct').change(function(){
  var productID = $(this).val();

  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/GetSingleInventory",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      ProductID: productID
    }),
    success: function(data) {
      $('#availableQtyLabel').html(data[0].Quantity);
      $('#unitPriceLabel').html(data[0].UnitPrice);
    },
    error: function(data) {
      swal("Something went wrong in Getting Patients!", {
        icon: "error",
      });
    }
  });
});

function GetCartDetails() {
  var userID = sessionStorage.getItem("log_user_id");
  var cartHeaderID = sessionStorage.getItem("cartHeaderID");
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/GetCartDetails",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      UserID: userID,
      CartHeaderID: cartHeaderID
    }),
    success: function(data) {
      // console.log(data);
      ShowCartItems(data);
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

$('#btnTxnItemAddToCart').click(function(e){
  e.preventDefault();
  var userID = sessionStorage.getItem("log_user_id");
  var cartHeaderID = sessionStorage.getItem("cartHeaderID");
  var txnProduct = $('#txnProduct').val();
  var txnQuantity = $('#txnQuantity').val();
  var unitPriceLabel = $('#unitPriceLabel').html();

  if(
    (userID != null && userID.trim() != "") &&
    (txnProduct != null && txnProduct.trim() != "") &&
    (txnQuantity != null && txnQuantity.trim() != "") &&
    (unitPriceLabel != null && unitPriceLabel.trim() != "")
  )
  {
    var totalPrice = txnQuantity * (+unitPriceLabel);
    $.ajax({
      url: "http://localhost:51053/api/Pharmacy/AddToCart",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        UserID: userID,
        CartHeaderID: cartHeaderID,
        ProductID: txnProduct,
        Quantity: txnQuantity,
        UnitPrice: unitPriceLabel,
        TotalPrice: totalPrice,
      }),
      success: function(data) {
        ShowCartItems(data);
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
});


function ShowCartItems(data)
{
  MainTotalBill = 0;
  var sertable = "";
  var rowcount = 0;
  for (rowno in data) {
    var uname = data[rowno].Name;
    var date = new Date(data[rowno].DateAdded);
    MainTotalBill += (+data[rowno].TotalPrice);

    sertable += "<tr id='" + data[rowno].CartDetailID + "'>";
      sertable += "<td>" + ++rowcount + "</td>";
      sertable += "<td>" + data[rowno].ProductID + "</td>";
      sertable += "<td>" + data[rowno].Quantity + "</td>";
      sertable += "<td>" + (data[rowno].UnitPrice).toString()  + "</td>";
      sertable += "<td>" + (data[rowno].TotalPrice).toString()  + "</td>";
      sertable += "<td>" +
        "<a id='removeCartItem"+rowcount+"' class='btn btn-danger btn-sm removeCartItem' data-id='" + data[rowno].CartDetailID +
        "' data-name='" + data[rowno].ProductID + "'><i class='fas fa-trash'></i> Delete </a>" +
        "</td>";
        sertable +=
        " btn-sm actuser'></td>";
      sertable += "</tr>";

      $(document).on("click", "a#removeCartItem"+rowcount , function(e) {
        var toDeleteCartDetailID = e.currentTarget.dataset["id"];
        var toDeleteProductID= e.currentTarget.dataset["name"];
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              DeletePCartDetail(toDeleteCartDetailID,toDeleteProductID);
            }
          });
      });
  }

  if (rowcount == 0) {
    swal("No Data Found!", "", "error");
    $("#tableTxnBody").html("");
    $("#txnTable").attr("style", "display:none");
    $('#grandTotal').html('00.00');
    return;
  }
  else{
    $("#txnTable").removeAttr("style");
    $('#grandTotal').html(MainTotalBill);
  }

  $("#tableTxnBody").html("");
  $("#tableTxnBody").html(sertable);
}

function DeletePCartDetail(cartDetailID)
{
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/DeleteCartDetail",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      CartDetailID: cartDetailID
    }),
    success: function(data) {
      swal("Product has been deleted!", {
        icon: "success",
      }).then((willDelete) => {
        if (willDelete) {
          location.reload(true);
        }
      });
    },
    error: function(data) {
      // console.log(data);
      swal(data, {
        icon: "error",
      });
    }
  });
}

$('#btnVoidBill').click(function(){

  var userID = sessionStorage.getItem("log_user_id");
  var cartHeaderID = sessionStorage.getItem("cartHeaderID");
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this Record!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      voidBill(cartHeaderID);
    }
  });
});

function voidBill(cartHeaderID)
{
  $.ajax({
    url: "http://localhost:51053/api/Pharmacy/VoidBill",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    headers: {
      Authorization: sessionStorage.getItem("user_token")
    },
    data: JSON.stringify({
      CartHeaderID: cartHeaderID
    }),
    success: function(data) {
      sessionStorage.removeItem("cartHeaderID");
      swal("Bill has been voided!", {
        icon: "success",
      }).then((willDelete) => {
        if (willDelete) {
          location.reload(true);
        }
      });
    },
    error: function(data) {
      // console.log(data);
      swal("Something Went Wrong!", {
        icon: "error",
      });
    }
  });
}


$('#btnMakePayment').click(function(){
  var userID = sessionStorage.getItem("log_user_id");
  var cartHeaderID = sessionStorage.getItem("cartHeaderID");
  var txnPatient = $('#txnPatientList option:selected').val();
  var totalPrice = MainTotalBill;
  var tax = MainTotalBill * taxPercentage;
  var totalBill = totalPrice + tax;

  if(txnPatient == null || txnPatient.trim() == ""){
    swal("Please Select A Patient To Proceed with the payment!", {
      icon: "error",
    }).then((willDelete) => {
      if (willDelete) {
        return;
      }
    });
  }
  else{
    if(
      (userID != null && userID.trim() != "") &&
      (cartHeaderID != null && cartHeaderID.trim() != "") &&
      (txnPatient != null && txnPatient.trim() != "") &&
      (totalPrice != null) && MainTotalBill != 0
    )
    {
      var totalPrice = txnQuantity * (+unitPriceLabel);
      $.ajax({
        url: "http://localhost:51053/api/Pharmacy/AddSales",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        headers: {
          Authorization: sessionStorage.getItem("user_token")
        },
        data: JSON.stringify({
          UserID: userID,
          CartHeaderID: +cartHeaderID,
          PatientID: txnPatient,
          TotalPrice: MainTotalBill,
          TaxAmount: +tax,
          TotalBill: +totalBill,
        }),
        success: function(data) {
          // console.log(data);
          sessionStorage.removeItem("cartHeaderID");
          swal("Payment Successful!", {
            icon: "success",
          }).then((willDelete) => {
            if (willDelete) {
              location.reload(true);
            }
          });
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
    else{
      swal("Something went wrong when making the payment!", {
        icon: "error",
      });
    }
  }
});

// TRANSACTIONS END //


// MEDICINE START //

$('#btnAddMedicine').click(function(e){
  e.preventDefault();

  var mdeicineProductID = $('#mdeicineProductID').val();
  var costPrice = $('#costPrice').val();
  var sellingPrice = $('#sellingPrice').val();
  var quantity = $('#quantity').val();

  if((mdeicineProductID != null && mdeicineProductID.trim() != "") &&
      (costPrice != null && costPrice.trim() != "") &&
      (sellingPrice != null && sellingPrice.trim() != "") &&
      (quantity != null && quantity.trim() != "")
  ){
    $.ajax({
      url: "http://localhost:51053/api/Pharmacy/AddMedicine",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      headers: {
        Authorization: sessionStorage.getItem("user_token")
      },
      data: JSON.stringify({
        Pid: mdeicineProductID,
        Pid: mdeicineProductID,
        Pid: mdeicineProductID,
        Pid: mdeicineProductID,
      }),
      success: function(data) {
        swal("New Product has been Added!", {
          icon: "success",
        }).then((willDelete) => {
          if (willDelete) {
            location.reload(true);
          }
        });
      },
      error: function(data) {
        // console.log(data);
        //toastr.error(data.responseJSON.Message, "Invalid Details!");
        if(data.statusText == "Unauthorized")
        {
          swal("You Are Not Authorized To Perform This Action!", {
            icon: "error",
          });
        }
        else{
          swal("Something went wrong in Adding a new Product!", {
            icon: "error",
          });
        }
      }
    });
  }
  else {
    toastr.error("Please Enter A Valid Product Title!.", "Invalid Details!");
  }
  $("#productTitle").val("");
});


function mdeicineProducts(mdeicineProductsList){
  mdeicineProductsList.forEach(item => {
    var itemHTML =
      '<option value="' +
      item.ID +
      '">' +
      item.Name +
      "</option>";
    $("#mdeicineProductID").append(itemHTML);
  });
}

// MEDICINE END //
