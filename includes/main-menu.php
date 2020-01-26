<aside id="main-menu">
			 
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="dashboard.php">
                    <h4><i class="fas fa-briefcase-medical"></i> Asceso Hospital (Pvt) Ltd</h4>
                </a>
            </li>
                
            <li class="<?php if($current_page == "dashboard.php") {echo "active";} ?>" id="dashboard">
                <a href="dashboard.php"><i class="fas fa-notes-medical"></i> Dashboard</a>
            </li>

            <li class="<?php if($current_page == "lab.php") {echo "active";} ?>" id="lab"> 
                <a href="lab.php"><i class="fas fa-microscope"></i> Lab</a>
            </li>

            <li class="<?php if($current_page == "pharmacy.php") {echo "active";} ?>" id="pharmacy"> 
                <a href="pharmacy.php"><i class="fas fa-first-aid"></i> Pharmacy</a>
            </li>
	
		<li class="<?php if($current_page == "parm.php") {echo "active";} ?>" id="parm"> 
                <a href="parm.php"><i class="fas fa-first-aid"></i> Pharmacy</a>
            </li>
                
            <li class="<?php if($current_page == "appointments.php") {echo "active";} ?>" id="appointments"> 
                <a href="appointments.php"><i class="fas fa-list-alt"></i> Appointments</a>
            </li>

            <li class="<?php if($current_page == "patients.php") {echo "active";} ?>" id="patients"> 
                <a href="patients.php"><i class="fas fa-user-injured"></i> Patients</a>
            </li>

            <li class="<?php if($current_page == "patienthistory.php") {echo "active";} ?>" id="patienthistory"> 
                <a href="patienthistory.php"><i class="fas fa-user-injured"></i> Manage Patients</a>
            </li>

            <li class="<?php if($current_page == "addmission.php") {echo "active";} ?>" id="addmission"> 
                <a href="addmission.php"><i class="fas fa-procedures"></i> Addmissions</a>
            </li>

            <li class="<?php if($current_page == "reports.php") {echo "active";} ?>" id="reports"> 
                <a href="reports.php"><i class="fas fa-notes-medical"></i> Reports</a>
            </li>
            
            <li class="<?php if($current_page == "users.php") {echo "active";} ?>" id="users"> 
                <a href="users.php"><i class="fas fa-user"></i> Users</a>
            </li>

            <li class="<?php if($current_page == "about.php") {echo "active";} ?>" id="about">
                <a href="about.php"><i class="fa fa-fw fa-info-circle"></i> About</a>
            </li>
            
        </ul>
    </nav>

</aside><!-- main menu end -->

<script>
$(document).ready(function() {
    if(sessionStorage.getItem("log_user_role") != 1)
    {
        $('#users').hide();
    }

    if(sessionStorage.getItem("log_user_role") == 2)
    {
        $('#addmission').hide();
        $('#lab').hide();
        $('#patients').hide();
    }
    
    if(sessionStorage.getItem("log_user_role") == 1004)
    {
        $('#lab').hide();
        $('#reports').hide();
    }

    if(sessionStorage.getItem("log_user_role") != 1 || sessionStorage.getItem("log_user_role") != 1005)
    {
        $('#pharmacy').hide();
    }

    if(sessionStorage.getItem("log_user_role") == 1005)
    {
        $('#lab').hide();
        $('#reports').hide();
        $('#patients').hide();
        $('#patienthistory').hide();
        $('#pharmacy').show();
        $('#addmission').hide();
        $('#appointments').hide();
        $('#dashboard').hide();
    }

});
</script>