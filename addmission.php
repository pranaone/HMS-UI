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
                        <h1>Patient Admission</h1>
                        <div class="spacer-3x"></div>
                    </div>


                        <div class="row">
                            <div class="col-xs-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#admitptnt">Admit Patient</a></li>

                                <li><a data-toggle="tab" href="#ptntdischarge">Discharge Patient</a></li>

                                <li><a data-toggle="tab" href="#Treatmentdetails">Treatment Details</a></li>
                                <li><a data-toggle="tab" href="#warddetails">Ward Details</a></li>
                                <li><a data-toggle="tab" href="#roomdetails">Room Details</a></li>

                            </ul>

                            <div class="tab-content">
                                <!-- START OF ADMIT TAB -->
                                <div id="admitptnt" class="tab-pane fade in active">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <h2>Admit Patient</h2>
                                          <div class="spacer-3x"></div>
                                      </div>
                                  </div>
                                    <div class="row">
                                      <div class="col-xs-3 col-md-4">
                                        <form>
                                              <div class="form-group">
                                                  <label for="txnPatientSearch">Search Patient: </label>
                                                  <div class="input-group">
                                                      <input type="text" name="ptntName" class="form-control" id="PatientSearch" aria-describedby="PatientSearch" placeholder="Search Patient" required>
                                                      <div class="input-group-btn">
                                                          <button id="btnPatientSearch" name="btnPatientSearch" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                      </div>
                                                  </div>
                                              </div>
                                                <div class="form-group">
                                                    <label for="ptntN">Patient Name: </label>
                                                    <select class="form-control" id="ptntN" required>
                                                        <option value="">--Select A Patient--</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="admissionDate">Admission Date: </label>
                                                    <input type="date" class="form-control" id="admissionDate" aria-describedby="admissionDate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="admissionFee">Admission Fee: </label>
                                                    <input type="text" class="form-control" value="10000" id="admissionFee" aria-describedby="admissionFee" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ward">Ward: </label>
                                                    <select class="form-control" id="ward" required>
                                                        <option value="">--Select Ward--</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="docInChg">Doctor In Charge: </label>
                                                    <input type="text" class="form-control" id="docInChg" aria-describedby="docInChg" readonly>
                                                    <input type="hidden" class="form-control" id="docID" aria-describedby="docID">
                                                </div>

                                                <div class="form-group">
                                                    <label for="room">Available Rooms: </label>
                                                    <select class="form-control" id="room" required>
                                                        <option value="">--Select Room--</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="roomchg">Room Charges: </label>
                                                    <input type="text" class="form-control" id="roomchgs" aria-describedby="roomchgs" readonly >
                                                </div>
                                                <div class="form-group">
                                                    <button  class="btn btn-primary form-control" id="btnAddAdmission">Admit Patient</button>
                                                </div>

                                        </form>
                                    </div>
                                  </div>

                                </div>
                                <!-- END OF ADMIT TAB -->

                                <!-- START OF DISCHARGE TAB -->
                                <div id="ptntdischarge" class="tab-pane fade">
                                    <div class="row">
                                        <h2>Discharge Patient</h2>
                                        <div class="spacer-3x"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form>
                                              <div class="form-group">
                                                  <label for="txtAdmissionSearch">Admission No: </label>
                                                  <div class="input-group">
                                                      <input type="text" name="admNmber" class="form-control" id="admNmber" aria-describedby="admNmber" placeholder="Search Admission Number">
                                                      <div class="input-group-btn">
                                                          <button id="btnAdmissionSrch" name="btnAdmissionSrch" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="PatientNme">Patient Name: </label>
                                                  <input type="text" class="form-control" id="PtntName" aria-describedby="PtntName"
                                                      readonly>
                                              </div>
                                              <div class="form-group">
                                                  <label for="admDate">Admission Date: </label>
                                                  <input type="text" class="form-control" id="admDate" aria-describedby="admDate" disabled>
                                              </div>
                                              <div class="form-group">
                                                  <label for="PtntRoom">Room: </label>
                                                  <input type="text" class="form-control" id="PtntRoom" aria-describedby="PtntRoom"
                                                      readonly>
                                              </div>
                                              <div class="form-group">
                                                  <label for="RoomPrice">Room Price </label>
                                                  <input type="number" class="form-control" id="RoomPrice" aria-describedby="RoomPrice"
                                                      readonly>
                                              </div>
                                            </form>
                                          </div>
                                          <div class="col-md-2"></div>
                                          <div class="col-md-4">
                                              <form>

                                                <div class="form-group">
                                                    <label for="mdcharge">Medicine Charges: </label>
                                                    <input type="text" class="form-control" id="mdcharge" aria-describedby="mdcharge" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rpcharge">Report Charges: </label>
                                                    <input type="text" class="form-control" id="rpcharge" aria-describedby="rpcharge" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dischargeDate">Discharge Date: </label>
                                                    <input type="date" class="form-control" id="dischargeDate" aria-describedby="dischargeDate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bedcharge">Room Charges: </label>
                                                    <div class="input-group">
                                                        <input type="text" name="bedcharge" class="form-control" id="bedcharge" aria-describedby="bedcharge" readonly>
                                                        <div class="input-group-btn">
                                                            <button id="btnPatRoomChgs" name="btnPatRoomChgs" class="btn btn-primary form-control">Calculate</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button id="btnDischargePatient" class="btn btn-primary form-control">Discharge Patient</button>
                                                </div>
                                                <div class="spacer-4x"></div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- END OF DISCHARGE TAB -->


                                <!--START OF TREATMENT TAB-->
                                  <div id="Treatmentdetails" class="tab-pane fade">
                                      <div class="row">
                                          <h2>Treatment Details</h2>
                                          <div class="spacer-3x"></div>
                                      </div>
                                      <div class="row">
                                        <div class="col-xs-3 col-md-4">
                                                <form>
                                                  <div class="form-group">
                                                      <label for="txtAdmissionSearch">Admission No: </label>
                                                      <div class="input-group">
                                                          <input type="text" name="admissionNmber" class="form-control" id="AdmissionNumber" aria-describedby="AdmissionNumber" placeholder="Search Admission Number">
                                                          <div class="input-group-btn">
                                                              <button id="btnAdmissionSearch" name="btnAdmissionSearch" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="PatientName">Patient Name: </label>
                                                      <input type="text" class="form-control" id="PatientName" aria-describedby="PatientName"
                                                          readonly>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="PatientRoom">Room: </label>
                                                      <input type="text" class="form-control" id="PatientRoom" aria-describedby="PatientRoom"
                                                          readonly>
                                                  </div>
                                                  <div class="form-group">
                                                    <button class="btn btn-primary" id="btnAddTreatment" type="button" data-toggle="collapse" data-target="#btnAddTreatmentCollapse" aria-expanded="false" aria-controls="btnAddTreatmentCollapse">
                                                                Add Treatment Details
                                                    </button>
                                                    <!--  <button id="btnAddTreatment" class="btn btn-primary form-control" data-toggle="collapse" data-target="#btnAddTreatmentCollapse" aria-expanded="false" aria-controls="btnAddTreatmentCollapse">Add Treatment Details</button>-->
                                                  </div>
                                                </form>
                                                <div class="spacer-3x"></div>

                                              </div>

                                              <div class="col-xs-3 col-md-8">
                                                <div id="TreatmentTable" class="panel panel-primary filterable table-responsive">
                                                    <div class="panel-heading" style="background:#1B3C6D">
                                                        <h3 class="panel-title">Treatment Details</h3>
                                                    </div>
                                                    <table class="table" id="tableTreatment">
                                                        <thead>
                                                            <tr class="filters">
                                                                <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='AdmissionID' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Treatment' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Medicine' disabled></th>
                                                                <th><input type='text' class='form-control' placeholder='Report' disabled></th>
                                                              </tr>
                                                        </thead>
                                                        <tbody id="tableTreatmentBody">

                                                        </tbody>

                                                    </table>
                                                </div>



                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>

                                        </div>
                                        <!-- col row -->
                                        <div class="collapse" id="btnAddTreatmentCollapse">
                                            <form>
                                                <!-- row start -->
                                                <div class="row">
                                                    <!-- COL start -->
                                                    <div class="col-md-9">
                                                      <div class="form-group">
                                                          <label for="PtntTreatment">Treatment: </label>
                                                          <textarea name="PtntTreatment" id="PtntTreatment" class="form-control" cols="30" rows="3" required></textarea>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="PtntMedicine">Medicine: </label>
                                                        <textarea name="PtntMedicine" id="PtntMedicine" class="form-control" cols="30" rows="3" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="PtntReports">Reports: </label>
                                                        <textarea name="PtntReports" id="PtntReports" class="form-control" cols="30" rows="3" required></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <button id="btnUpdateTreatment" class="btn btn-primary form-control">Update Treatment Details</button>
                                                    </div>

                                                    <!-- COL End -->

                                                </div>
                                                <!-- row end -->


                                            </form>
                                        </div>
                                    </div>


                                    </div>
                                    <!-- col row -->
                                </div>
                                <!--END OF TREATMENT TAB-->






                              <!--START OF WARD TAB-->
                                <div id="warddetails" class="tab-pane fade">
                                    <div class="row">
                                        <h2>Ward  Details</h2>
                                        <div class="spacer-3x"></div>
                                    </div>
                                    <div class="row">
                                      <div class="col-xs-3 col-md-3">
                                              <form>
                                                <div class="form-group">
                                                    <label for="WardTitle">Ward: </label>
                                                    <input type="text" class="form-control" id="wardTitle" aria-describedby="wardTitle"
                                                        placeholder="Ward Title" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="DoctoID">Available Doctors: </label>
                                                    <select class="form-control" id="DoctorID">
                                                        <option value="">--Select Doctor--</option>

                                                    </select>
                                                </div>
                                                  <div class="form-group">
                                                      <button id="btnAddWard" class="btn btn-primary form-control">Add Ward</button>
                                                  </div>
                                              </form>
                                          <!-- Content goes here... -->
                                          <div class="spacer-4x"></div>
                                      </div>

                                      <div class="col-md-1"></div>
                                      <!-- START OF TABLE -->
                                      <div class="col-md-8">

                                          <div class="row">
                                              <div id="WardTable" class="panel panel-primary filterable table-responsive">
                                                  <div class="panel-heading" style="background:#1B3C6D">
                                                      <h3 class="panel-title">Ward Details</h3>
                                                  </div>

                                                  <table class="table" id="tableWard">
                                                      <thead>
                                                          <tr class="filters">
                                                              <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                              <th><input type='text' class='form-control' placeholder='WardID' disabled></th>
                                                              <th><input type='text' class='form-control' placeholder='Ward Name' disabled></th>
                                                              <th><input type='text' class='form-control' placeholder='DoctorID' disabled></th>
                                                              <th><input type='text' class='form-control' placeholder='Options' disabled></th>

                                                          </tr>
                                                      </thead>
                                                      <tbody id="tableWardBody">

                                                      </tbody>

                                                  </table>
                                              </div>
                                          </div>

                                      </div>
                                  </div>
                                  <!-- col row -->
                              </div>
                                  <!--END OF WARD TAB-->

                                  <!--START OF Room TAB-->
                                    <div id="roomdetails" class="tab-pane fade">
                                        <div class="row">
                                            <h2>Room  Details</h2>
                                            <div class="spacer-3x"></div>
                                        </div>
                                        <div class="row">
                                          <div class="col-xs-3 col-md-3">
                                                  <form>
                                                    <div class="form-group">
                                                        <label for="RoomTitle">Room: </label>
                                                        <input type="text" class="form-control" id="roomTitle" aria-describedby="roomTitle"
                                                            placeholder="Room Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="price">Price: </label>
                                                        <input type="number" class="form-control" id="roomPrice" aria-describedby="roomPrice" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Availability">Availability: </label>
                                                        <select class="form-control" id="availability">
                                                            <option value="0">Not Available</option>
                                                            <option value="1">Available</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Wardid">Ward: </label>
                                                        <select class="form-control" id="WardID">

                                                        </select>
                                                    </div>
                                                      <div class="form-group">
                                                          <button id="btnAddRoom" class="btn btn-primary form-control">Add Room</button>
                                                      </div>
                                                  </form>
                                              <!-- Content goes here... -->
                                              <div class="spacer-4x"></div>
                                          </div>

                                          <div class="col-md-1"></div>
                                          <!-- START OF TABLE -->
                                          <div class="col-md-8">

                                              <div class="row">
                                                  <div id="RoomTable" class="panel panel-primary filterable table-responsive">
                                                      <div class="panel-heading" style="background:#1B3C6D">
                                                          <h3 class="panel-title">Room Details</h3>
                                                      </div>
                                                      <table class="table" id="tableRoom">
                                                          <thead>
                                                              <tr class="filters">
                                                                  <th><input type='text' class='form-control' placeholder='#' disabled></th>

                                                                  <th><input type='text' class='form-control' placeholder='Room Name' disabled></th>
                                                                  <th><input type='text' class='form-control' placeholder='Price' disabled></th>
                                                                  <th><input type='text' class='form-control' placeholder='Availability' disabled></th>
                                                                  <th><input type='text' class='form-control' placeholder='WardID' disabled></th>
                                                                  <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                              </tr>
                                                          </thead>
                                                          <tbody id="tableRoomBody">

                                                          </tbody>

                                                      </table>
                                                  </div>
                                              </div>

                                          </div>
                                      </div>
                                      <!-- col row -->
                                  </div>
                                      <!--END OF Room TAB-->


<!--//////start of modal class to update bed///////-->
<div class="modal fade" id="BedUpdateModal" tabindex="-1" role="dialog" aria-labelledby="BedUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="BedUpdateModalLabel">Update Room Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group" hidden>
                <label for="BedIDTxt">Room ID</label>
                <input type="text" name="BedIDTxt" id="BedIDTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="BedOldTxt">Old Room Name</label>
                <input type="text" name="BedOldTxt" id="BedOldTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="newBedTxt">New Room Name</label>
                <input type="text" name="newBedTxt" id="newBedTxt" class="form-control" />
            </div>
            <div class="form-group">
                <label for="newBedPrice">New Room Price</label>
                <input type="number" name="newBedPrice" id="newBedPrice" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="newBedAvailability">Availability</label>
                <input type="text" name="newBedAvailability" id="newBedAvailability" class="form-control" disabled/>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateBed">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--/////end of modal class to update bed///////-->

<!--//////start of modal class to update Ward///////-->
<div class="modal fade" id="WardUpdateModal" tabindex="-1" role="dialog" aria-labelledby="WardUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="WardUpdateModalLabel">Update Room Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group" hidden>
                <label for="WardIDTxt">Ward ID</label>
                <input type="text" name="WardIDTxt" id="WardIDTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="WardOldTxt">Old Ward Name</label>
                <input type="text" name="WardOldTxt" id="WardOldTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="newWardTxt">New Ward Name</label>
                <input type="text" name="newWardTxt" id="newWardTxt" class="form-control" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateWard">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--/////end of modal class to update Ward///////-->

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

        <script src="Script/addmission.js"></script>
    </body>
</html>
