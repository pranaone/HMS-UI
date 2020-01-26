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
                        <h1>Users</h1>
                        <div class="spacer-3x"></div> 
                    </div>
                        
                        
                        <div class="row">
                            <div class="col-xs-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">All Users</a></li>
                                <li><a data-toggle="tab" href="#menu1">User Roles</a></li>
                                <li><a data-toggle="tab" href="#menu2">Doctor Categories</a></li>
                            </ul>

                            <div class="tab-content">
                                <!-- START OF ALL USERS TAB -->
                                <div id="home" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <h1>Users</h1>
                                            <div class="spacer-3x"></div> 
                                            <p>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addUserCollapse" aria-expanded="false" aria-controls="addUserCollapse">
                                                    <i class="fas fa-plus-circle"></i> Add new User
                                                </button>
                                            </p>
                                            <div class="collapse" id="addUserCollapse">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="userFirstName">First Name</label>
                                                        <input type="text" class="form-control" id="userFirstName" aria-describedby="FirstName"
                                                            placeholder="First Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userLastName">Last Name</label>
                                                        <input type="text" class="form-control" id="userLastName" aria-describedby="LastName"
                                                            placeholder="Last Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userEmail">Email</label>
                                                        <input type="email" class="form-control" id="userEmail" aria-describedby="Email" placeholder="Enter email"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userPassword">Password</label>
                                                        <input type="password" class="form-control" id="userPassword" aria-describedby="Password"
                                                            placeholder="Password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userConfirmPassword">Confirm Password</label>
                                                        <input type="password" class="form-control" id="userConfirmPassword" aria-describedby="ConfirmPassword"
                                                            placeholder=" Confirm Password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userMobileNo">Mobile No</label>
                                                        <input type="text" class="form-control" id="userMobileNo" aria-describedby="MobileNo"
                                                            placeholder="Mobile No - 07XX XXX XXX" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userGender">Gender</label>
                                                        <select class="form-control" id="userGender">
                                                            <option value="">--Select Your Gender--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userRoles">User Role</label>
                                                        <select class="form-control" id="userRoles">
                                                            <option value="">--Select A User Role--</option>
                                                            <!-- <option value="1">Admin</option>
                                                            <option value="2">Customer</option>
                                                            <option value="3">Cheff</option>
                                                            <option value="4">Driver</option> -->
                                                        </select>
                                                    </div>

                                                    <div class="form-group" id="docCatDiv">
                                                        <label for="doctorCategoryList">Doctor Category</label>
                                                        <select class="form-control" id="doctorCategoryList">
                                                            <option value="">--Select A User Role--</option>
                                                            <!-- <option value="1">Admin</option>
                                                            <option value="2">Customer</option>
                                                            <option value="3">Cheff</option>
                                                            <option value="4">Driver</option> -->
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-sm" id="btnAddNewUser">Add User</button>
                                                    </div>
                                                </form>
                                            </div>
                                                
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>  

                                            <!-- Content goes here... --> 

                                            </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div id="serusertable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div> 
                                                
                                                <table class="table" id="tableserusers">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Email' disabled></th> 
                                                            <th><input type='text' class='form-control' placeholder='Gender' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Address' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Mobile No' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='User Role' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Doctor Category' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Registered Date' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableserusersbody">

                                                    </tbody>
                                                </table>  
                                                
                                            </div> 
                                                
                                        </div>
                                    </div>  

                                </div>
                                <!-- END OF ALL USERS TAB -->

                                <!-- START OF ALL USER ROLES TAB -->
                                <div id="menu1" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h1>User Roles</h1>
                                            <div class="spacer-3x"></div> 
                                            <p>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addUserRoleCollapse" aria-expanded="false" aria-controls="addUserRoleCollapse">
                                                    <i class="fas fa-plus-circle"></i> Add New User Role
                                                </button>
                                            </p>
                                            <div class="collapse" id="addUserRoleCollapse">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="userrole">User Role</label>
                                                        <input type="text" name="userrole" id="userrole" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="btnAddUserRole" class="btn btn-primary btn-sm">Add User Role</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>  
                                        </div>
                                    </div>
                                    <!-- col row -->
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div id="UserRolestable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div> 
                                                
                                                <table class="table" id="tablesUserRoles">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Date Added' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Options' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="UserRolesBody">

                                                    </tbody>
                                                </table>  
                                                
                                            </div> 
                                                
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF ALL USER ROLES TAB -->

                                <!-- START OF ALL DOCTOR CATEGORIES TAB -->
                                <div id="menu2" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
                                            <h1>Doctor Categories</h1>
                                            <div class="spacer-3x"></div> 
                                            <p>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addDoctorCategoryCollapse" aria-expanded="false" aria-controls="addUserRoleCollapse">
                                                    <i class="fas fa-plus-circle"></i> Add New Doctor Category
                                                </button>
                                            </p>
                                            <div class="collapse" id="addDoctorCategoryCollapse">
                                                <form>
                                                    <div class="form-group">
                                                        <label for="doctorCategoryTxt">Doctor Category</label>
                                                        <input type="text" name="doctorCategoryTxt" id="doctorCategoryTxt" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="btnAddDoctorCategory" class="btn btn-primary btn-sm">Add Doctor Category</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Content goes here... -->
                                            <div class="spacer-4x"></div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"> 
                                            <div id="DocCategoriestable" class="panel panel-primary filterable table-responsive" style="display:none">
                                                <div class="panel-heading" style="background:#1B3C6D">
                                                    <h3 class="panel-title">&nbsp;</h3>
                                                    <div class="pull-right">
                                                        <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                                    </div>
                                                </div> 
                                                
                                                <table class="table" id="tablesDocCategories">
                                                    <thead>
                                                        <tr class="filters">
                                                            <th><input type='text' class='form-control' placeholder='#' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Name' disabled></th>
                                                            <th><input type='text' class='form-control' placeholder='Date Added' disabled></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="DocCategoriesBody">

                                                    </tbody>
                                                </table>  
                                                
                                            </div> 
                                                
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF ALL DOCTOR CATEGORIES TAB -->
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

<!-- Modal USER -->
<div class="modal fade" id="UserUpdateModal" tabindex="-1" role="dialog" aria-labelledby="UserUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UserUpdateModalLabel">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="userroleOld">User Details</label>
                <input type="text" name="userroleOld" id="userroleOld" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="userrole">User Details</label>
                <input type="text" name="userroleUpdate" id="userroleUpdate" class="form-control" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateUser">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal USER ROLE -->
<div class="modal fade" id="UserRoleUpdateModal" tabindex="-1" role="dialog" aria-labelledby="UserRoleUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="UserRoleUpdateModalLabel">Update User Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group" hidden>
                <label for="userroleID">Old user role ID</label>
                <input type="text" name="userroleID" id="userroleID" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="userroleOldTxt">Old User Role</label>
                <input type="text" name="userroleOldTxt" id="userroleOldTxt" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="userroleUpdateTxt">New User Role</label>
                <input type="text" name="userroleUpdateTxt" id="userroleUpdateTxt" class="form-control" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateUserRole">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal DOCTOR CATEGORY -->
<div class="modal fade" id="doctorCategoryUpdateModal" tabindex="-1" role="dialog" aria-labelledby="doctorCategoryUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="doctorCategoryUpdateModalLabel">Update Doctor Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group" hidden>
                <label for="doctorCategoryID">Old Doctor Category</label>
                <input type="text" name="doctorCategoryID" id="doctorCategoryID" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="doctorCategoryTxtOld">Old Doctor Category</label>
                <input type="text" name="doctorCategoryTxtOld" id="doctorCategoryTxtOld" class="form-control" disabled/>
            </div>
            <div class="form-group">
                <label for="doctorCategoryTxtUpdate">New Doctor Category</label>
                <input type="text" name="doctorCategoryTxtUpdate" id="doctorCategoryTxtUpdate" class="form-control" />
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateDoctorCategory">Save changes</button>
      </div>
    </div>
  </div>
</div>

        <!-- page wrapper end -->


        <?php include "includes/footer.php"?>

        <script src="Script/users.js"></script>
    </body>
</html>