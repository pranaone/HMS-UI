
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta lang="en">
        <meta charset="utf-8">

        <title>Login | Asceso Hospital (Pvt) Ltd</title>

        <script src="js/jquery-3.2.0.min.js" type="text/javascript"></script>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/headerStyles.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- view login failed or login expired message -->
        <script type="text/javascript"> 
            $(document).ready(function() {
                $(".mainSpinner").hide();
                loginFailedSession();// check login failed or login expired
            });

            function loginFailedSession(){ 
                var loginfailed = document.getElementById("loginfailed"); 

                /**if this is a login failed */
                if (sessionStorage.getItem("loginfailed")) {
                    loginfailed.innerHTML = sessionStorage.getItem("loginfailed");
                    sessionStorage.removeItem("loginfailed");
                }
                /** */ 
                /**if this is login expired */
                else if (sessionStorage.getItem("loginexpired")) {
                    loginfailed.innerHTML = sessionStorage.getItem("loginexpired");
                    sessionStorage.removeItem("loginexpired");
                }
                /** */
                else{
                    loginfailed.innerHTML = '';
                }

                sessionStorage.clear();//clear all session storage values.
            }
        </script>


    </head>
    <body>
    <div class="mainSpinner">
        <div class="sk-folding-cube alignCenter">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <div class="container-fluid login-wrapper">
        <div class="row">
            <div class="col-md-6" id="loginContent-side">

            </div>
            <div class="col-md-6 text-center" id="loginContent-wrapper">
                <div class="login-panel" style="padding:15px">
                    <div class="login-logo">
                        <h1 href="#">Asceso Hospital (Pvt) Ltd</h1>
                        <div class="spacer-3x"></div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-8 col-md-offset-2">
                            <p style='color: red;' id='loginfailed'></p>

                            <form action="Login" method="post">
                                <div class="form-group spacer-3x">
                                    <input type='text' id="username" name="username" label="Username" class="form-control inputField" placeholder="Username" required />
                                </div>
                                <div class="spacer-2x"></div>
                                <div class="form-group spacer-3x">
                                    <input type='password' id="password" name="password" label="Password" class="form-control inputField" placeholder="Password" required />
                                </div>
                                <div class="spacer-2x"></div>
                                <!--<s:checkbox name="remember" label="Remember me?" />--> 
                                <input id='btnlogin' type='button' value="SIGN IN" class="btn btn-blue btn-block btn-primary inputField" />
                                <p></p>
                                <!-- <p style="text-align:center" >
                                    <a href="#" id="btnforgetpassword" data-target="#forgetpass" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="text-danger" style="text-decoration:none">Forget Password ?<a>
                                </p> -->
                            </form>
                            <div class="spacer-2x"></div>
                        </div>
                    </div>
                    <!-- login wrapper end --> 
                </div>
            </div>
        </div>
    </div>
    <!-- page wrapper end --> 

        <!-- show forget password screen -->
        <div id="forgetpass" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" >
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Forgot Password
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group"> 
                        <label id="fogtemail">Email Address</label> 
                        <input type="email" id="fogtemail" name="fogtemail" placeholder="Enter Email Address" class="form-control" required>
                    </div>     
                </div>
                <div class="modal-footer"> 
                    <span id='submit_result' style="text-align:left"></span>
                    <button type="button" id="btnsubmit" class="btn btn-black">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
                </div>
                </div>
            </div>
        </div>


        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="Script/login.js" type="text/javascript"></script>
    </body>
</html>