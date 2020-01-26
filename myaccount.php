
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

                <div class="container-fluid form-group">
                    <div class="row">
                        <div class="col-xs-12"> 
                            <h1>My Account</h1>
                            <div class="spacer-3x"></div> 
                            <!-- Content goes here... -->
                        </div>
                        <!-- row end -->  
                        <!-- Content goes here... -->   
                    </div>
                    <!-- row end -->
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstname">First name :</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="firstname">Last name :</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstname">Address Line 1:</label>
                                <input type="text" class="form-control" id="addressLine1" name="addressLine1" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="firstname">Address Line 2:</label>
                                <input type="text" class="form-control" id="addressLine2" name="addressLine2" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstname">Postal Code:</label>
                                <input type="text" class="form-control" id="postalCode" name="postalCode" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="firstname">Mobile No:</label>
                                <input type="text" class="form-control" id="mobileNo" name="mobileNo" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstname">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="firstname">Role :</label>
                                <input type="text" class="form-control" id="role" name="role" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="firstname">Active Status:</label>
                                <input type="text" class="form-control" id="activeStatus" name="activeStatus" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="firstname">Registered Date :</label>
                                <input type="text" class="form-control" id="registeredDate" name="registeredDate" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary  pull-right" id="btnEnableUpdate">Enable Update</button>
                                <button class="btn btn-danger  pull-right" id="btnCancelUpdate" hidden>Cancel Update</button>
                                <button class="btn btn-success  pull-right" id="btnUpdate" hidden>Update Details</button>
                            </div>
                            
                        </div>
                    </form>

                </div>
            </div>
            <!-- container end -->
        </div>
        <!-- content wrapper end -->
        </div>
    <!-- page wrapper end -->

    <?php include "includes/footer.php" ?>


    <script src="Script/myaccount.js"></script>
    </body>
</html>