<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <?php
    $current_page = basename($_SERVER['PHP_SELF']); 
    ?>

    <?php include "includes/head.php";?>
    <body>
        <div class="objoverlay loader"></div>

        <div class="page-wrapper" id="wrapper">
            <div class="overlay"></div>
            <?php include "includes/main-menu.php";?>

            <div id="content-wrapper">
                <?php include "includes/header.php"?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">

                            <h1>Dashboard</h1>
                            <div class="spacer-4x"></div>

                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="panel panel-default"> 
                                        <div class="panel-heading">
                                            <h3>Total No Of Patients</h3>
                                        </div>
                                        <div class="panel-body">
                                            <h1 id="totalNoOfPatients">0</h1> 
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>No Of Patients Admitted</h3>
                                        </div>
                                        <div class="panel-body">
                                            <h1 id="NoOfPatientsAdmitted">0</h1> 
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>No Of Patients Discharged</h3>
                                        </div>
                                        <div class="panel-body">
                                            <h1 id="NoOfPatientsDischarged">0</h1> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>No Of Patients In-House</h3>
                                        </div>
                                        <div class="panel-body">
                                            <h1 id="NoOfPatientsInHouse">0</h1> 
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- col end -->
                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->
            </div>
            <!-- content wrapper end -->
        </div>
        <!-- page wrapper end -->

        <?php include "includes/footer.php"?>

        <script src="Script/dashboard.js" type="text/javascript"></script>

    </body>
</html>