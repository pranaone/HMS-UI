
<!DOCTYPE html>

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
                            <h1>Appointments</h1>
                        </div>
                    </div>
                    <!-- row end -->

                    <!-- row start -->
                    <div class="row">
                        <div class="spacer-3x"></div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addAppointmentCollapse" aria-expanded="false" aria-controls="addAppointmentCollapse">
                                        Add New Appointment
                            </button>
                        </div>
                    </div>
                    <!-- row end -->
                    <div class="spacer-4x"></div>
                    <!-- row start -->
                    <div class="collapse" id="addAppointmentCollapse">
                        <form>
                            <!-- row start -->
                            <div class="row">
                                <!-- COL start -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <table>
                                        <tr>
                                          <td><input type="text" id="PatientSearch" class="form-control" placeholder="Enter Patient Name...." required></td>
                                          <td><button id="btnPatientSearch" class="btn btn-primary">Search Patient</button> </td>
                                        </tr>
                                      <table>
                                    </div>
                                    <div class="form-group">
                                        <label for="PatientID">Patient Name</label>
                                        <select class="form-control" id="PatientID">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="DoctorID">Available Doctors</label>
                                        <select class="form-control" id="DoctorID">
                                            <option value="">--Select Doctor--</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="AppointmentFee">Appointment Type</label>
                                        <select class="form-control" id="AppointmentFee">
                                            <option value="">--Select Appointment--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="AppointmentDate">Appointment Date</label>
                                        <br>
                                        <input type="datetime-local" id="AppointmentDate">
                                    </div>
                                <!-- COL End -->

                            </div>
                            <!-- row end -->

                            <!-- row start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button id="btnAddAppointment" class="btn btn-success">Create Appointment</button>
                                    </div>
                                </div>
                            </div>
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
                        <div class="col-md-12">
                            <div id="Appointmentstable" style="display:none">

                                <table class="table" id="tableAppointments">
                                    <thead>
                                        <tr class="filters">
                                            <th><input type='text' class='form-control' placeholder='App #' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='PatientID' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='DoctorID' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='Date' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='Time' disabled></th>
                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                        </tr>
                                    </thead>
                                    <tbody id="AppointmentsBody">

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
        <!-- Print receipt of appointment Modal-->
          <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Appointment Invoice</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table>
                    <tr>
                      <td><label>Patient Name</label></td>
                      <td><label>Patient Name</label></td>
                    </tr>
                    <tr>
                      <td><label>Consultant Name</label></td>
                      <td><label>Consultant Name</label></td>
                    </tr>
                    <tr>
                      <td><label>Payment</label></td>
                      <td><label>Payment</label></td>
                    </tr>
                    <tr>
                      <td><label>Appointment Date</label></td>
                      <td><label>Appointment Date</label></td>
                    </tr>
                  </table>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Print</button>
                  <a class="btn btn-primary" href="#">No</a>
                </div>
              </div>
            </div>
          </div>



        <?php include "includes/footer.php"?>

        <script src="Script/appointments.js"></script>
    </body>
</html>
