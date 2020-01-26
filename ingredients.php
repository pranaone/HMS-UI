<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<style>
    #scrollStyle {
        max-height: 300px;
        overflow-y: scroll;
        overflow: auto;
        width: 100%;
    }

    #tblIngr {
        width: 95%;
    }
</style>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<?php include "includes/head.php"; ?>
<body>

<div class="page-wrapper" id="wrapper">
    <div class="overlay"></div>
    <?php include "includes/main-menu.php"; ?>

    <div id="content-wrapper">
        <?php include "includes/header.php" ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <hr>
                    <h1>Ingredients</h1>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-9 col-9 col-sm-9 col-md-9">
                    <input type="text" class="form-control" id="txtSearch" placeholder="Search">
                </div>
                <div class="col-xs-3 col-3 col-sm-3 col-md-3">
                    <button type="button" class="btn btn-primary" id="btnNewIngr" data-toggle="modal"
                            style='border-radius: 10px'
                            data-target=".bd-example-modal-lg"><i class="fas fa-plus-circle"></i> Add New Ingredient
                    </button>
                </div>
                <div class="col-xs-12 col-12 col-sm-12 col-md-12">


                    <div class="spacer-3x"></div>

                    <div class="container" id="scrollStyle">
                        <table class="table " id="tblIngr">
                            <thead>
                            <tr>
                                <th scope="col">Ingredient ID</th>
                                <th scope="col">Ingredient Name</th>
                                <th scope="col">Expire Date</th>
                                <th scope="col">Qty On Hand</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="ingrediant_table"></tbody>
                        </table>
                    </div>

                    <!-- Large modal -->


                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="ingrediantModal"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle">Add New Ingredient</h5>
                                    <button type="button" class="close" id="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <i class="far fa-times-circle"></i>
                                    </button>
                                </div>


                                <form style="padding: 23px;" id="ingrediantForm">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Ingredient Name</label>
                                                <input type="text" class="form-control" name="ingredientName"
                                                       id="ingredientName"
                                                       placeholder="Enter ingredient name">
                                                <input type="hidden" class="form-control" name="inventoryID"
                                                       id="inventoryID" hidden="true">
                                                <input type="hidden" class="form-control" name="ingredientID"
                                                       id="ingredientID" hidden="true">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Expire Date</label>
                                                <input type="date" class="form-control" name="expireDate"
                                                       id="expireDate">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Qty On Hand</label>
                                                <input type="number" class="form-control" name="qtyOnHand"
                                                       id="qtyOnHand">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="modalClose">Close</button>
                                        <button type="button" class="btn btn-primary" id="btnIngredientSave">Save
                                            <button type="button" class="btn btn-primary" id="btnIngredientUpdate">
                                                Update
                                            </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Content goes here... -->
                    <div class="spacer-4x"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>

<!--<script src="Script/ingredients.js"></script>-->
</body>
<script>
    $(document).ready(function () {
        $("#btnIngredientUpdate").hide();
        $("#modalTitle").text("Add New Ingredient");

        // var load = $('#ingredientName').serializeArray();
        // load.push({"name": "operation", "value": "All"});
        // $.ajax({
        //     url: "/RestaurantApp/admin/controller/public/controller.ingredient.php",
        //     type: 'GET',
        //     cache: false,
        //     data: load,
        //     dataType: "json",
        //     contentType: "application/json; charset=utf-8",
        //     success: function (result) {
        //         $('#ingrediant_table').empty();
        //         for (var i in result) {
        //             var tempA = result[i];
        //             let row = "" +
        //                 "<tr>" +
        //                 "<td>" + tempA.ingredientId + "</td>" +
        //                 "<td>" + tempA.ingredient_name + "</td>" +
        //                 "<td>" + tempA.insertedDateTime + "</td>" +
        //                 "<td>" + tempA.expire_date + "</td>" +
        //                 "<td>" + tempA.qty_on_hand + "</td>" +
        //                 "<td>" +
        //                 "<button class='btn btn-warning' onClick='onUpdate(" + tempA.ingredientId + ")'><i class=\"fas fa-edit\"></i> Update</button>" +
        //                 "</td>" +
        //                 "</tr>";
        //             $('#ingrediant_table').append(row);
        //         }
        //     },
        //     error: function (result) {
        //         console.log(result);
        //     }
        //
        // });

        var userID = sessionStorage.getItem("log_user_id");
        $.ajax({
            url: "http://localhost:50028/api/GetIngredients",
            type: "POST",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            headers: {
                Authorization: "Bearer " + sessionStorage.getItem("user_token")
            },
            data: JSON.stringify({
                userID: userID,
                token: sessionStorage.getItem("user_token"),
                email: sessionStorage.getItem("log_user_email")
            }),
            success: function (result) {
                $('#ingrediant_table').empty();
                for (var i in result) {
                    var tempA = result[i];
                    let row = "" +
                        "<tr>" +
                        "<td>" + tempA.ingredientID + "</td>" +
                        "<td>" + tempA.ingredientName + "</td>" +
                        "<td>" + tempA.expireDate + "</td>" +
                        "<td>" + tempA.quantity + "</td>" +
                        "<td>" +
                        "<button class='btn btn-success' style='border-radius: 10px' onClick='onUpdate(" + tempA.ingredientID + ")'><i class=\"fas fa-edit\"></i> Update</button>" +
                        "</td>" +
                        "</tr>";
                    $('#ingrediant_table').append(row);
                }
            },
            error: function (result) {
                console.log(result);
            }
        });


    });

    function onUpdate(ingredientID) {
        var userID = sessionStorage.getItem("log_user_id");
        $.ajax({
            url: "http://localhost:50028/api/GetIngredientForUpdate",
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
                ingredientID: ingredientID
            }),
            success: function (result) {
                $("#ingredientName").val(result.ingredientName);
                $("#expireDate").val(result.expireDate);
                $("#qtyOnHand").val(result.quantity);
                $("#inventoryID").val(result.inventoryID);
                $("#ingredientID").val(result.ingredientID);
                $("#ingrediantModal").modal("show");
                $("#btnIngredientSave").hide();
                $("#btnIngredientUpdate").show();
                $("#modalTitle").text("Update Ingredient");
            },
            error: function (result) {
                console.log(result);
            }
        });
    }


    //update
    $('#btnIngredientUpdate').on('click', function () {
        var ingredientName = $("#ingredientName").val();
        var ingredientID = $("#ingredientID").val();
        var inventoryID = $("#inventoryID").val();
        var expireDate = $("#expireDate").val();
        var quantity = $("#qtyOnHand").val();
        var userID = sessionStorage.getItem("log_user_id");

        if (ingredientName != null && ingredientName.trim() != "") {
            if (expireDate != null && expireDate.trim() != "") {
                if (quantity != null && quantity.trim() != "") {
                    $.ajax({
                        url: "http://localhost:50028/api/UpdateIngredient",
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
                            ingredientName: ingredientName,
                            expireDate: expireDate,
                            quantity: quantity,
                            ingredientID: ingredientID,
                            inventoryID: inventoryID
                        }),
                        success: function (data) {
                            console.log(data);
                            toastr.success(data, "Ingredient Name Added!");
                        },
                        error: function (data) {
                            console.log(data);
                            toastr.error(
                                "Error in adding new ingredient Name!!!.",
                                "Invalid Details!"
                            );
                        }
                    });
                } else {
                    toastr.error("Please Enter Qty-On-Hand!.", "Invalid Details!");
                }
            } else {
                toastr.error("Please Enter Expire Date!.", "Invalid Details!");
            }
        } else {
            toastr.error("Please Enter A Valid ingredient Name!.", "Invalid Details!");
        }
        $("#ingredientName").val("");
        $("#expireDate").val("");
        $("#qtyOnHand").val("");
    });




    $('#btnIngredientSave').on('click', function () {
        var ingredientName = $("#ingredientName").val();
        var expireDate = $("#expireDate").val();
        var quantity = $("#qtyOnHand").val();
        var userID = sessionStorage.getItem("log_user_id");

        if (ingredientName != null && ingredientName.trim() != "") {
            if (expireDate != null && expireDate.trim() != "") {
                if (quantity != null && quantity.trim() != "") {
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
                            ingredientName: ingredientName,
                            expireDate: expireDate,
                            quantity: quantity
                        }),
                        success: function (data) {
                            console.log(data);
                            toastr.success(data, "Ingredient Name Added!");
                        },
                        error: function (data) {
                            console.log(data);
                            toastr.error(
                                "Error in adding new ingredient Name!!!.",
                                "Invalid Details!"
                            );
                        }
                    });
                } else {
                    toastr.error("Please Enter Qty-On-Hand!.", "Invalid Details!");
                }
            } else {
                toastr.error("Please Enter Expire Date!.", "Invalid Details!");
            }
        } else {
            toastr.error("Please Enter A Valid ingredient Name!.", "Invalid Details!");
        }
        $("#ingredientName").val("");
        $("#expireDate").val("");
        $("#qtyOnHand").val("");
    });

    $('#modalClose').on('click', function () {
        location.reload();
    });

    $(document).ready(function () {
        $("#txtSearch").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#ingrediant_table tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });


    $('#tblIngr').DataTable();

</script>

</html>

