<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title> Simply Tasty</title> 
        
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="css/font-awesome.min.css?rnd=<?php echo uniqid(); ?>">

        <link href="css/bootstrap.min.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet">
        <link href="css/bootstrap-select.min.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet">
        <link href="css/style.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet">
        <link href="css/tablefilter.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet"> 
         
        <script src="js/jquery-3.2.0.min.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
        <script src="Script/common.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
 
       

    </head> 
    <body class="login-page" style="background-image:url('../Admin/images/cute_dog.jpg')">        
        <div class="objoverlay"></div> 
        <div class="page-wrapper" id="wrapper"> 

            <div class="container"> 
                    <div class="row"> 
                        <div class="col-md-4 col-md-offset-8">  
                            <div class="login-panel" style="padding:15px">  
                                <div class="login-logo">
                                    <a href="login.php">Simply <i class="fa fa-cutlery"></i> Tasty</a>
                                </div>  
                                
                                <h5 class="text-warning">Reset your password by entering new password.</h5> 
                                <div class="login">
                                    <form method="post" id="formorg" theme="simple" enctype="multipart/form-data" >
                                        <input type="hidden" id="hidid" name="hidid">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group" id="lbltxtorgname">
                                                    <label for="">Password</label>
                                                    <input type="password" name="upass" id="upass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" placeholder="Enter Password" required />
                                                </div> 
                                                <div class="form-group" id="lbltxtorgname">
                                                    <label for="">Confirm Password</label>
                                                    <input type="password" name="reupass" id="reupass" class="form-control" placeholder="Enter Confirm Password" required />
                                                    <span id='password_match'></span>
                                                </div> 
                                            </div>  
                                        </div>
                                        <div class="form-group"> 
                                            <span id='submit_result'></span>
                                            <input id="btnsave" name="btnsave" type="submit" value="RESET" class="btn btn-blue btn-block btn-login" /> 
                                            <input id="btncancel" name="btnsave" type="button" value="LOGIN" class="btn btn-danger btn-block btn-login" /> 

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
            </div>
        </div>  


        <script src="Script/forgetpassword.js" type="text/javascript"></script>

    </body>
</html>





