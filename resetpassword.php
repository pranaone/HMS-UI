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

                            <h1>Reset Password</h1>
                            <div class="spacer-3x"></div> 

                            <!-- Content goes here... -->
                            <div class="spacer-4x"></div>  

                            <form method="post" id="formresetpass" theme="simple" enctype="multipart/form-data">
                                <input type="hidden" id="hidid" name="hidid">

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="oldpass">Incorrect Password</label>
                                            <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="Old Password" required />
                                        </div> 
                                    </div> 
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="newpass">New Password</label>
                                            <input type="password" name="newpass" id="newpass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="New Password" required />
                                        </div> 
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="cofnewpass">Confirm New Password</label>
                                            <input type="password" name="cofnewpass" id="cofnewpass" class="form-control" placeholder="Confirm New Password" required />
                                            <span id='password_match'></span>
                                        </div> 
                                    </div> 
                                </div>

                                <div class="form-group"> 
                                    <input id="btnsave" name="btnsave" type="submit" value="Reset" class="btn btn-black" />
                                    <input id="btncancel" name="btncancel" type="reset" value="Cancel" class="btn btn-danger" />
                                    <span id='submit_result'></span>
                                </div>
                            
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <span id='submit_result'></span>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php include "includes/footer.php"?>

        <script src="Script/resetpassword.js" type="text/javascript"></script>	 

    </body>
</html>