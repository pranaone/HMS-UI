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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Patients</h1>
                        </div>
                    </div>
                    <!-- row end -->

                    <!-- row start -->
                    <div class="row">
                        <div class="spacer-3x"></div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addPatientCollapse" aria-expanded="false" aria-controls="addAppointmentCollapse">
                                        Add New Patient
                            </button>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="spacer-4x"></div>
                    <!-- row start -->
                    <div class="collapse" id="addPatientCollapse">
                        <form>
                            <!-- row start -->
                            <div class="row">
                                <!-- COL start -->
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="itemDescription">Patient Name</label>
                                      <input type="text" class="form-control" id="patName" required/>
                                      <button id="btnSearchPatient" class="btn btn-Secondary">Search Patient</button>
                                      <input type="hidden" class="form-control" id="patID"/>
                                  </div>
                                  <div class="form-group">
                                      <label for="itemDescription">Residential Address</label>
                                      <input type="text" class="form-control" id="patAddress"/>
                                  </div>
                                  <div class="form-group">
                                      <label for="itemDescription">Contact Number</label>
                                      <input type="text" class="form-control"id="patContact"/>
                                  </div>
                                  <div class="form-group">
                                      <label for="itemDescription">NIC Number</label>
                                      <input type="text" class="form-control" id="patNIC"/>
                                  </div>
                                  <input type="checkbox" value="YES" id="isNonNIC">Underage Patient<br>
                                  <div class="form-group">
                                      <label for="itemDescription">Guardian NIC Number</label>
                                      <input type="text" class="form-control"id="guardNIC"/>
                                  </div>

                                  <div class="form-group">
                                        <button id="btnAddPatient" class="btn btn-success">Add Patient</button>
                                        <button id="btnUpdatePatient" class="btn btn-warning">Update Patient</button>
                                        <button id="btnDeletePatient" class="btn btn-danger">Delete Patient</button>
                                    </div>

                                <!-- COL End -->

                            </div>
                            <!-- row end -->

                            <!-- row start -->

                            <!-- row end -->
                        </form>
                    </div>
                </div>
                    <!-- Content goes here... -->
            </div>
                <!-- container end -->
            <hr style="border-top: 1.5px dotted black;">

            <div id="content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="serusertable" class="panel panel-primary filterable table-responsive" style="display:none">
                                <div class="panel-heading" style="background:#1B3C6D">
                                    <h3 class="panel-title">&nbsp;</h3>
                                    <div class="pull-right">
                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                    </div>
                                </div>

                                <table class="table" id="DisplayPatients">
                                    <thead>
                                        <tr class="filters">
                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='Patients Name' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='Residential Address' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='Contact Number' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='NIC Number' disabled></th>
                                        </tr>
                                    </thead>
                                    <tbody id="databody">

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content wrapper end -->

        <!-- page wrapper end -->

        <?php include "includes/footer.php"?>

        <script src="Script/patient.js"></script>
    </body>
</html>
