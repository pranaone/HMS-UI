<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <?php 
          if ($current_page == "dashboard.php")
            $display_name = "Dashboard";

	  if ($current_page == "parm.php")
            $display_name = "Pharmacy";

          if ($current_page == "users.php")
            $display_name = "Users";

          if ($current_page == "reports.php")
            $display_name = "Reports";

          if ($current_page == "myaccount.php")
            $display_name = "My Account";
          
          if ($current_page == "lab.php")
            $display_name = "Lab";

          if ($current_page == "pharmacy.php")
              $display_name = "Pharmacy";
          
          if ($current_page == "addimissions.php")
            $display_name = "Addimissions";

          if ($current_page == "appointments.php")
            $display_name = "Appointments";

          if ($current_page == "patienthistory.php")
            $display_name = "Patients History";

          if ($current_page == "patients.php")
            $display_name = "Patients";

          if ($current_page == "about.php")
            $display_name = "About";

          if ($current_page == "accountverified.php")
            $display_name = "Account Verified";

            if ($current_page == "addmission.php")
            $display_name = "Addmission";

          if ($current_page == "error.php")
            $display_name = "Error";

          if ($current_page == "resetpassword.php")
            $display_name = "Reset Password";
        ?>

        <title><?php echo $display_name ?> | Asceso Hospital (Pvt) Ltd</title> 
        
        <link rel="shortcut icon" href="Assets/favicon1.ico">

        <link href="css/bootstrap.min.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet">
        <link href="css/bootstrap-select.min.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet">
        <link href="css/style.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet">
        <link href="css/tablefilter.css?rnd=<?php echo uniqid(); ?>" rel="stylesheet"> 
         
        <script src="js/jquery-3.2.0.min.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
        <script src="Script/common.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
        <link rel="stylesheet" href="css/toastr.min.css" />
        <link rel="stylesheet" href="css/spinner.css">
        <script src="js/sweetalert.min.js"></script>
 <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
 <link rel="stylesheet" href="css/font-awesome.min.css?rnd=<?php echo uniqid(); ?>">
        
        <!-- -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>