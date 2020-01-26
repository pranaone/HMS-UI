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


                        <div class="col-md-3"></div>


                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->


                <div class="container-fluid" style="margin-left: 30px !important; margin-right: 30px !important;">
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- <h3>Search</h3> -->
                            <div class="spacer-3x"></div>

                            <!-- Content goes here... -->

                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">Search Patient</a></li>
                                <li><a data-toggle="tab" href="#menu1">Patient history</a></li>
                            </ul>

                            <div class="tab-content">
                                <!-- START OF ALL USERS TAB -->
                                <div id="home" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h1>Patient Details</h1>
                                            <div class="spacer-3x"></div>
                                            <p>
                                                <div class="form-group">
                                                  <!-- <label for="patientID">Patient ID</label> -->
                                                  <div class="row">
                                                    <div class="col-md-5">
                                                      <input type="text" id="PatientSearchID" class="form-control"  aria-describedby="PatientID"
                                                          placeholder="Patient Name"  required>
                                                    </div>
                                                    <div class="col-md-5">
                                                      <button class="btn btn-primary" id="btnPatSearch" type="button" data-toggle="collapse" data-target="#searchPatientCollapse" aria-expanded="false" aria-controls="searchPatientCollapse">
                                                           Search Patient
                                                      </button>
                                                    </div>
                                                  </div>

                                                </div>

                                            </p>
                                            <div class="collapse" id="searchPatientCollapse">
                                                <form>
                                                    <div class="form-group">
                                                      <br>
                                                        <label for="patientname">Name</label>
                                                        <input type="text" class="form-control" id="patientname" aria-describedby="PatientName" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="patientcontact">Contact</label>
                                                        <input type="text" class="form-control" id="patientcontact" aria-describedby="PatientContact"
                                                             readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="patientaddress">Address</label>
                                                        <input type="text" class="form-control" id="patientaddress" aria-describedby="PatientAddress"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="patientnic">NIC</label>
                                                        <input type="text" class="form-control" id="patientnic" aria-describedby="PatientNIC"
                                                             readonly>
                                                    </div>

                                                </form>
                                            </div>

                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>

                                            <!-- Content goes here... -->

                                            </div>


                                    </div>


                                </div>
                                <!-- END OF ALL USERS TAB -->

                                <!-- START OF ALL USER ROLES TAB -->
                                <div id="menu1" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 ">
                                            <h1>Patient History</h1>
                                            <div class="spacer-3x"></div>
                                            <p>
                                              <div class="form-group">
                                                <div class="row">
                                                  <div class="col-md-5">
                                                    <input type="text" class="form-control" id="txtPatNIC" aria-describedby="SeachPatientNIC"
                                                        placeholder="Patient NIC" required>
                                                  </div>
                                                  <div class="col-md-5">
                                                        <button class="btn btn-primary" id="btnSearchPatHistory" type="button" data-toggle="collapse" data-target="#searchpatienthistoryCollapse" aria-expanded="true" aria-controls="searchpatienthistoryCollapse">
                                                             Search Patient history
                                                        </button>
                                                  </div>
                                                </div>
                                              </div>
                                            </p>


                                            <div class="collapse" id="searchpatienthistoryCollapse">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="ViewPatientID">Patient ID</label>
                                                        <input type="text" name="ViewPatientID" id="ViewPatientID" class="form-control" required readonly/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ViewPatientName">Patient Name</label>
                                                        <input type="text" name="ViewPatientName" id="ViewPatientName" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ViewPatientSymptoms">Symptoms</label>
                                                        <input type="text" name="ViewPatientSymptoms" id="ViewPatientSymptoms" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ViewPatientDiagnosis">Diagnosis</label>
                                                        <input type="text" name="ViewPatientDiagnosis" id="ViewPatientDiagnosis" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ViewPatientChanges">Changes</label><br>
                                                        <textarea name="ViewPatientChanges" id="ViewPatientChanges" rows="8" cols="157"></textarea>
                                                        <!-- <input type="text" name="ViewPatientChanges" id="ViewPatientChanges" class="form-control" required/> -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ViewPatientRemarks">Remarks</label>
                                                        <input type="text" name="ViewPatientRemarks" id="ViewPatientRemarks" class="form-control"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="ViewPatientRemarks">Prescriptions</label>
                                                        <input type="text" name="ViewPatientPrescriptions" id="ViewPatientPrescriptions" class="form-control"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="ViewPatientRemarks">Last Modified</label>
                                                        <input type="text" name="ViewLastModified" id="ViewLastModified" class="form-control" readonly/>
                                                    </div>

                                                    <div class="form-group">
                                                        <button id="btnUpdatePatientHistory" class="btn btn-primary btn-sm">Update Patient History</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>
                                        </div>
                                    </div>
                                    <!-- col row -->

                                </div>
                                <!-- END OF PATIENT HISTORY TAB -->


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


        <?php include "includes/footer.php"?>

        <script src="Script/patienthistory.js"></script>
    </body>
</html>
