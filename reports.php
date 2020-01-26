<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <?php include "includes/head.php";?>
    <body>

        <div class="page-wrapper" id="wrapper">
            <div class="overlay"></div>
            <?php include "includes/main-menu.php";?>

            <div id="content-wrapper">
                <?php include "includes/header.php"?>

                <div class="container-fluid" style="margin-left: 30px !important; margin-right: 30px !important;">
                  <!--start of Heading-->
                  <div class="row">
                    <h1>Sales Report</h1>
                      <div class="spacer-3x"></div>
                  </div>
                  <!--end of Heading-->

                  <!--start of row-->
                    <div class="row">
                      <!-- START OF SALES REPORT TAB -->

                      <div>
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
                                          <label for="btntxnPatientSearchForRpt">Search Patient :</label>
                                          <div class="input-group">
                                              <input type="text" class="form-control" id="txnPatientSearchForRpt" aria-describedby="txnPatientSearch" placeholder="Search Patient">
                                              <div class="input-group-btn">
                                                  <button id="btntxnPatientSearchForRpt" name="btntxnPatientSearchForRpt" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="txnPatientList">Patient :</label>
                                          <select class="form-control" id="txnPatientList">
                                              <option value="">--Select A Patient--</option>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="sampleDate">From Date: </label>
                                          <input type="date" class="form-control" id="fromDate" aria-describedby="fromDate" >
                                      </div>
                                      <div class="form-group">
                                          <label for="sampleDate">To Date: </label>
                                          <input type="date" class="form-control" id="ToDate" aria-describedby="ToDate" >
                                      </div>
                                      <div class="form-group">
                                          <button id="btnFilter" class="btn btn-primary form-control">Search</button>
                                      </div>
                                  </form>
                              <!-- Content goes here... -->
                              <div class="spacer-4x"></div>
                          </div>





                            <div class="col-md-9">

                                <div id="AllSalesReportstable" class="panel panel-primary filterable table-responsive" style="display:none">
                                    <div class="panel-heading" style="background:#1B3C6D">
                                        <h3 class="panel-title">Sales summary</h3>
                                        <div class="pull-right">
                                          <button id="printreport" class="btn btn-default btn-xs">Print</button>
                                        </div>
                                    </div>

                                    <table class="table" id="tableAllSalesReports">
                                        <thead>
                                            <tr class="filters">
                                              <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                              <!--<th><input type='text' class='form-control' placeholder='CartHeaderID' disabled></th>
                                              <th><input type='text' class='form-control' placeholder='UserID' disabled></th>-->
                                              <th><input type='text' class='form-control' placeholder='PatientName' disabled></th>
                                              <th><input type='text' class='form-control' placeholder='TotalPrice' disabled></th>
                                              <th><input type='text' class='form-control' placeholder='TotalBill' disabled></th>
                                              <th><input type='text' class='form-control' placeholder='Sales Date' disabled></th>
                                            </tr>
                                        </thead>
                                        <tbody id="AllSalesReportsBody">

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>

                      </div>
                      <!-- END OF SALES REPORT TAB -->
                </div>

        <?php include "includes/footer.php"?>
        <script src="Script/reports.js" type="text/javascript"></script>
          <!-- <script src="Script/pharmacy.js"></script> -->
    </body>
</html>
