<header>
    <div class="header-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-4">
                    <button type="button" class="btn btn-default nav-toggle" >
                        <span class="hamb-top"></span>
                        <span class="hamb-middle"></span>
                        <span class="hamb-bottom"></span>
                    </button> 
                </div><!-- col end -->
            
                <div class="col-xs-8"> 
                    <ul class="nav navbar-nav navbar-right top-nav">
                        <!-- <li><a href="#">&nbsp; <i class="fa fa-bell" aria-hidden="true"></i></a></li> -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                                </i>&nbsp; <label id="lblusername"></label> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                        </li>

                        <li>
                            <form id="myForm" action="" method="post" theme="simple">
                                <input type="hidden" name="id" value="" />
                                    <a href="myaccount.php"  style="padding: 3px 20px;position: relative;display: block;">
                                        <i class="fas fa-users-cog"></i> My Account
                                    </a>
                                    <!-- <a href="resetpassword.php"  style="padding: 3px 20px;position: relative;display: block;">
                                        <i class="fa fa-fw fa-key"></i> Reset Password
                                    </a> -->
                            </form>
                        </li>

                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></i> Logout</a></li> 
                    </ul> 

                </div><!-- col end-->
            </div><!-- row end -->
        </div><!-- container fluid end -->
    </div><!-- header wrapper end -->
</header>
