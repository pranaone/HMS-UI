<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <?php
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <?php include "includes/head.php";?>
    <body>
    <div class="mainSpinner" id="mainSpinner">
        <div class="sk-folding-cube alignCenter">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
        <div class="page-wrapper" id="wrapper">
            <div class="overlay"></div>
            <?php include "includes/main-menu.php";?>

            <div id="content-wrapper">
                <?php include "includes/header.php"?>

                <div class="container-fluid" style="margin-left: 30px !important; margin-right: 30px !important;">
                    <div class="row">
                        <h1>Pharmacy</h1>
                        <div class="spacer-3x"></div>
                    </div>

                        <div class="row">
                            <div class="col-xs-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#transactions">Transactions</a></li>
                                <li><a data-toggle="tab" href="#product">Products</a></li>
                                <li><a data-toggle="tab" href="#inventory">Inventory</a></li>
                                <!-- <li><a data-toggle="tab" href="#medicine">Medicines</a></li> -->
                            </ul>

                            <div class="tab-content">
                                <!-- START OF ALL PRODUCTS TAB -->
                                <div id="product" class="tab-pane fade">
                                    <div class="row">
                                        <h1>Products</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="spacer-3x"></div>
                                                <form>
                                                    <div class="form-group">
                                                        <label for="productTitle">Name</label>
                                                        <input type="text" class="form-control" id="productTitle" aria-describedby="productTitle"
                                                            placeholder="Product Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="productDescription">Description</label>
                                                        <textarea name="productDescription" id="productDescription" class="form-control" cols="30" rows="10"
                                                            placeholder="Product Description" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ProductUnitPrice">Unit Price</label>
                                                        <input type="number" class="form-control" id="ProductUnitPrice" aria-describedby="ProductUnitPrice"
                                                            placeholder="Unit Price" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-sm" id="btnAddProduct">Add Product</button>
                                                    </div>
                                                </form>
                                                <!-- Content goes here... -->
                                                <div class="spacer-4x"></div>
                                            <!-- Content goes here... -->
                                        </div>

                                        <!-- START OF COL-MD-9 -->
                                        <div class="col-md-9">
                                            <div class="spacer-3x"></div>
                                            <div id="Productstable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tableDisplayProducts">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Product Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Description' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='UnitPrice' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Date Added' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="ProductsBody">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- END OF COL-MD-9 -->
                                    </div>
                                    <!-- END OF ROW -->

                                </div>
                                <!-- END OF ALL PRODUCT TAB -->

                                <!-- START OF MEDICINE TAB -->
                                <div id="medicine" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h1>Medicines</h1>
                                            <div class="spacer-3x"></div>
                                            <p>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addmedicineCollapse" aria-expanded="false" aria-controls="addmedicineCollapse">
                                                    <i class="fas fa-plus-circle"></i> Add New Medicine
                                                </button>
                                            </p>
                                            <div class="collapse" id="addmedicineCollapse">
                                                <form>

                                                    <div class="form-group">
                                                        <label for="mdeicineProductID">Products</label>
                                                            <select class="form-control" id="mdeicineProductID">
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="costPrice">Cost Price</label>
                                                        <input type="number" name="costPrice" id="costPrice" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sellingPrice">Selling Price</label>
                                                        <input type="number" name="sellingPrice" id="sellingPrice" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="number" name="quantity" id="quantity" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="btnAddMedicine" class="btn btn-primary btn-sm">Add new Medicine</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                    </div>
                                    <!-- col row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="Medicinetable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tableDisplayMedicine">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Date Added' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="DisplayMedicineBody">

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- END OF MEDICINE TAB -->

                                <!-- START OF INVENTORY TAB -->
                                <div id="inventory" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1>Maintain Inventory</h1>
                                            <div class="spacer-3x"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3 col-md-3">
                                            <form>
                                                  <div class="form-group">
                                                      <label for="invProduct">Product Name :</label>
                                                        <select class="form-control" id="invProduct" name="invProduct">
                                                      </select>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="invQuantity">Quantity :</label>
                                                      <input type="number" class="form-control" id="invQuantity" aria-describedby="invQuantity" placeholder="Quantity" required>
                                                  </div>
                                                    <div class="form-group">
                                                        <button id="btnAddInventory" class="btn btn-primary btn-sm">Add Inventory Record</button>
                                                    </div>
                                                </form>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                        <div class="col-xs-9 col-md-9">
                                            <div id="Inventorytable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tablesInventory">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Quantity' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="InventoryBody">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF INVENTORY TAB -->

                                <!-- START OF TRANSACTION TAB -->
                                <div id="transactions" class="tab-pane fade in active">
                                    <div class="row">
                                        <h1>Transactions</h1>
                                    </div>
                                    <div class="spacer-3x"></div>
                                    <div class="row">
                                        <div class="col-xs-3 col-md-3">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="txnProduct">Product :</label>
                                                        <select class="form-control" id="txnProduct">
                                                            <option value="">-- Select A Product --</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="availableQtyLabel">Available Quantity : <span id="availableQtyLabel"></span> </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="unitPriceLabel">Unit Price : <span id="unitPriceLabel"></span> </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="txnQuantity">Quantity :</label>
                                                        <input type="number" name="txnQuantity" id="txnQuantity" class="form-control" />
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="buyMedicineDate">Date</label>
                                                        <input type="date" name="buyMedicineDate" id="buyMedicineDate" class="form-control" />
                                                    </div> -->
                                                    <div class="form-group">
                                                        <button id="btnTxnItemAddToCart" class="btn btn-primary form-control">Add To Cart</button>
                                                    </div>
                                                </form>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>

                                        <!-- START OF TABLE -->
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="pull-right">
                                                    <button class="btn btn-primary" id="btnOpenNewBill">Open New Bill</button>
                                                </div>
                                                <div class="pull-right">
                                                    <button class="btn btn-warning" id="btnVoidBill">Void Bill</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txnPatientSearch">Search Patient :</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="txnPatientSearch" aria-describedby="txnPatientSearch" placeholder="Search Patient">
                                                                <div class="input-group-btn">
                                                                    <button id="btntxnPatientSearch" name="btntxnPatientSearch" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="txnPatientList">Patient :</label>
                                                            <select class="form-control" id="txnPatientList">
                                                                <option value="">--Select A Patient--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div id="txnTable" class="panel panel-primary filterable table-responsive">
                                                    <div class="panel-heading" style="background:#1B3C6D">
                                                        <h3 class="panel-title">Cart Items</h3>
                                                    </div>

                                                    <table class="table" id="tableTxn">
                                                        <thead>
                                                            <tr class="filters">
                                                                <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='ProductID' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Quantity' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Unit Price' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Total Price' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tableTxnBody">

                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="filters">
                                                                <!-- <td><input type='text' class='form-control' placeholder='#' disabled></td>
                                                                <td><input type='text' class='form-control' placeholder='Name' disabled></td>
                                                                <td><input type='text' class='form-control' placeholder='Quantity' disabled></td>
                                                                <td><input type='text' class='form-control' placeholder='Unit Price' disabled></td>
                                                                <td><input type='text' class='form-control' placeholder='Total' disabled></td>
                                                                <td><input type='text' class='form-control' placeholder='Options' disabled></td> -->
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td><p>Grand Total :</p></td>
                                                                <td><p id="grandTotal">00.00</p></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="pull-right">
                                                    <button class="btn btn-success" id="btnMakePayment">Make Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col row -->
                                </div>
                                <!-- END OF TRANSACTION TAB -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content goes here... -->
                <div class="spacer-4x"></div>
            </div>
        </div>
    </div>
<!-- content wrapper end -->
</div>
        <!-- page wrapper end -->

<!-- Modal PRODUCT -->
<div class="modal fade" id="ProductUpdateModal" tabindex="-1" role="dialog" aria-labelledby="ProductUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ProductUpdateModalLabel">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group" hidden>
                <label for="ProductIDTxt">Report Type ID</label>
                <input type="text" name="ProductIDTxt" id="ProductIDTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="PrductOldTxt">Old Product Name</label>
                <input type="text" name="PrductOldTxt" id="PrductOldTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="newProductTxt">New Product Name</label>
                <input type="text" name="newProductTxt" id="newProductTxt" class="form-control" />
            </div>
            <div class="form-group">
                <label for="newProductDescription">New Product Description</label>
                <textarea name="newProductDescription" id="newProductDescription" class="form-control" cols="30" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="newProductPrice">New Product Name</label>
                <input type="number" name="newProductPrice" id="newProductPrice" class="form-control" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateProduct">Save changes</button>
      </div>
    </div>
  </div>
</div>


        <?php include "includes/footer.php"?>

        <script src="Script/pharmacy.js"></script>
    </body>
</html>
