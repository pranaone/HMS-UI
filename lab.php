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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">

                            <h1>Lab Reports</h1>
                            <div class="spacer-3x"></div>
                            <div id="OrdersListForDel">

                            </div>
                            <!-- Content goes here... -->
                            <div class="spacer-4x"></div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Add New Report</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">View Reports <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li id="allRptTab"><a data-toggle="tab" href="#menu1">View All Reports</a></li>
                                            <li id="patientRptTab"><a data-toggle="tab" href="#patientRpt">View Patient Report</a></li>
                                        </ul>
                                    </li>

                                    <!-- <li id="allRptTab"><a data-toggle="tab" href="#menu1">View All Reports</a></li> -->
                                    <li><a data-toggle="tab" href="#rptTypes">Add New Report Type</a></li>
                                </ul>

                                <div class="tab-content">
                                <!-- START OF ALL USERS TAB -->
                                <div id="home" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1>Add New Report</h1>
                                            <div class="spacer-3x"></div>
                                            <form>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="PatientList">Patient</label>
                                                                <select class="form-control" id="PatientList">

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="PatientSearch">Search Patient</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="PatientSearch" aria-describedby="PatientSearch" placeholder="Search Patient">
                                                                    <div class="input-group-btn">
                                                                        <button id="btnPatientSearch" name="btnPatientSearch" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="ReportTypeList">Report Type</label>
                                                                <select class="form-control" id="ReportTypeList">
                                                                    <option value="">--Select A Report Type--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fee">Fee</label>
                                                                <input type="number" class="form-control success" id="fee" aria-describedby="fee" placeholder="500.00" min=1>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="sampleDate">Sample Date</label>
                                                                <input type="date" class="form-control" id="sampleDate" aria-describedby="sampleDate" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="testedDate">Tested Date</label>
                                                                <input type="date" class="form-control" id="testedDate" aria-describedby="testedDate" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="results">Results</label>
                                                                <textarea name="results" class="form-control" id="results" cols="30" rows="10"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="remarks">Remarks</label>
                                                                <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="10"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-6">
                                                            <div class="form-group">
                                                                <button id="viewRpt" class="form-control btn btn-success">View Report</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>

                                            <!-- Content goes here... -->

                                            </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="serusertable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tableserusers">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Email' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Gender' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Address' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Mobile No' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='User Role' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Doctor Category' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Registered Date' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableserusersbody">

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- END OF ALL USERS TAB -->

                                <!-- START OF ALL REPORTS TAB -->
                                <div id="menu1" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h1>All Reports</h1>

                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                    </div>
                                    <!-- col row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="AllReportstable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tableAllReports">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Patient ID' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Report Type' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Sample Date' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Tested Date' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="AllReportsBody">

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- END OF ALL REPORTS TAB -->

                                <!-- START OF PATIENT REPORTS TAB -->
                                <div id="patientRpt" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h1>Patient Reports</h1>

                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="PatientRptList">Patient</label>
                                                <select class="form-control" id="PatientRptList">
                                                    <option value="">--Select A Patient--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="PatientrptSearch">Search Patient</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="PatientrptSearch" aria-describedby="PatientrptSearch" placeholder="Search Patient">
                                                    <div class="input-group-btn">
                                                        <button id="btnPatientrptSearch" name="btnPatientrptSearch" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="PatientReportstable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tablePatientReports">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Patient ID' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Report Type' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Sample Date' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Tested Date' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="PatientReportsBody">

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- END OF PATIENT REPORTS TAB -->



                                <!-- START OF ALL USER ROLES TAB -->
                                <div id="rptTypes" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h1>Report Types</h1>
                                            <div class="spacer-3x"></div>
                                            <form>
                                                <div class="form-group">
                                                    <label for="newRptType">Report Type</label>
                                                    <input type="text" name="newRptType" id="newRptType" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <button id="btnAddNewRptType" class="btn btn-primary btn-sm">Add New Report Type</button>
                                                </div>
                                            </form>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                    </div>
                                    <!-- col row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="reportTypestable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div>

                                                <table class="table" id="tableReportTypes">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Date Added' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="reportTypesBody">

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- END OF ALL USER ROLES TAB -->

                            </div>

                        </div>
                    </div>
                </div>

            </div>

<!-- Modal REPORTVIEW -->
<div class="modal fade" id="ReportViewModal" tabindex="-1" role="dialog" aria-labelledby="ReportViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ReportViewModalLabel">REPORT VIEW</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="printModal">
        <div class="row">
            <div class="col-md-3">
                <p>Name: </p>
            </div>
            <div class="col-md-9">
                <p id="PatientNameRpt"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Report Type: </p>
            </div>
            <div class="col-md-9">
                <p id="ReportTypeRpt"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Sample Date: </p>
            </div>
            <div class="col-md-9">
                <p id="SampleDateRpt"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Tested Date: </p>
            </div>
            <div class="col-md-9">
                <p id="TestedDateRpt"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Results: </p>
            </div>
            <div class="col-md-9">
                <p id="ResultsRpt"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Remarks: </p>
            </div>
            <div class="col-md-9">
                <p id="RemarksRpt"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <p>Fee: </p>
            </div>
            <div class="col-md-9">
                <p id="FeeRpt"></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnPrintRpt">Print Report</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal REPORTVIEW -->
<div class="modal fade" id="AllReportViewModal" tabindex="-1" role="dialog" aria-labelledby="AllReportViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AllReportViewModalLabel">REPORT VIEW</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="printModalAllRpt">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="AllReportViewModalClose">Close</button>
        <button type="button" class="btn btn-primary" id="btnPrintRptAllRpt">Print Report</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal REPORT TYPE -->
<div class="modal fade" id="ReportTypeUpdateModal" tabindex="-1" role="dialog" aria-labelledby="ReportTypeUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ReportTypeUpdateModalLabel">Update Report Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group" hidden>
                <label for="ReportTypeID">Report Type ID</label>
                <input type="text" name="ReportTypeID" id="ReportTypeID" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="ReportTypeOldTxt">Old Report Type</label>
                <input type="text" name="ReportTypeOldTxt" id="ReportTypeOldTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="ReportTypeUpdateTxt">New Report Type</label>
                <input type="text" name="ReportTypeUpdateTxt" id="ReportTypeUpdateTxt" class="form-control" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateReportType">Save changes</button>
      </div>
    </div>
  </div>
</div>


        <?php include "includes/footer.php"?>
        <script src="Script/lab.js" type="text/javascript"></script>
    </body>
</html>
