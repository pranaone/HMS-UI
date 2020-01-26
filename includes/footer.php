 
        <script src="js/bootstrap.min.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
        <script src="js/bootstrap-select.min.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script> 
        <script src="js/sorttable.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
        <script src="js/jspdf.min.js?rnd=<?php echo uniqid(); ?>"></script>
        <script src="js/jspdf.plugin.autotable.js?rnd=<?php echo uniqid(); ?>"></script>
        <script src="js/sessionStorageTabs.js?rnd=<?php echo uniqid(); ?>"></script>
        <script src="js/fas_icon.js?rnd=<?php echo uniqid(); ?>" type="text/javascript"></script>
        
  <!-- printThis -->

  <script type="text/javascript" src="js/printThis.js"></script>

        <script src="js/toastr.min.js"></script>
        <!--log out when sessions empty-->
        <script>
            $(document).ready(function(){  

                if(typeof sessionStorage.log_user_id === 'undefined' || sessionStorage.getItem('log_user_id').trim() == '' ||
                    typeof sessionStorage.log_user_email === 'undefined' || sessionStorage.getItem('log_user_email').trim() == '' ||
                    typeof sessionStorage.log_user_role === 'undefined' || sessionStorage.getItem('log_user_role').trim() == ''){

                        window.location.href = "logout.php"; // if session empty redirect to logout.php
                    }
                    else{ 
                        //set lblusername in header.php
                        document.getElementById("lblusername").innerHTML = sessionStorage.log_user_email;
                    }
            });
        </script>
        <!-- -->

        <!-- auto logout if no activity with in minutes--> 
        <script type="text/javascript">
            var timeoutID;
 
            function setup() {
                this.addEventListener("mousemove", resetTimer, false);
                this.addEventListener("mousedown", resetTimer, false);
                this.addEventListener("keypress", resetTimer, false);
                this.addEventListener("DOMMouseScroll", resetTimer, false);
                this.addEventListener("mousewheel", resetTimer, false);
                this.addEventListener("touchmove", resetTimer, false);
                this.addEventListener("MSPointerMove", resetTimer, false);
            
                startTimer();
            }
            setup();
 
            function startTimer() { 
                timeoutID = window.setTimeout(goInactive, 3600 * 1000); // wait 60 minutes (in miliseconds) before calling goInactive
            }
            
            function resetTimer(e) {
                window.clearTimeout(timeoutID); 
                goActive();
            }
            
            function goInactive() {
                sessionStorage.setItem("loginexpired", "Session expired. Please login again.");
                location.href = "logout.php";
            }
            
            function goActive() { 
                startTimer();
            }
        </script>
        <!---->

        <script type="text/javascript">

            $(document).ready(function () {
                if ($(document).width() > 767) {
                    $("#sidebar-wrapper").removeClass("m-hidden");
                    $("#content-wrapper").removeClass("m-hidden-c");
                } else {
                    $("#sidebar-wrapper").addClass("m-hidden");
                    $("#content-wrapper").addClass("m-hidden-c");
                    $('.overlay').hide();
                }
                $(window).resize(function () {
                    if ($(document).width() > 767) {
                        $("#sidebar-wrapper").removeClass("m-hidden");
                        $("#content-wrapper").removeClass("m-hidden-c");
                    } else {
                        $("#sidebar-wrapper").addClass("m-hidden");
                        $("#content-wrapper").addClass("m-hidden-c");
                        $('.overlay').hide();
                    }
                });

                $(".nav-toggle").click(function () {
                    if ($("#sidebar-wrapper").hasClass("m-hidden")) {
                        $("#sidebar-wrapper").removeClass("m-hidden");
                        $("#content-wrapper").removeClass("m-hidden-c");
                        $('.overlay').show();
                    } else {
                        $("#sidebar-wrapper").addClass("m-hidden");
                        $("#content-wrapper").addClass("m-hidden-c");
                        $('.overlay').hide();
                    }
                });
                /* var trigger = $('.hamburger'),
                 overlay = $('.overlay'),
                 isClosed = false;
                 
                 trigger.click(function () {
                 hamburger_cross();
                 });
                 
                 function hamburger_cross() {
                 
                 if (isClosed == true) {
                 overlay.hide();
                 trigger.removeClass('is-open');
                 trigger.addClass('is-closed');
                 isClosed = false;
                 } else {
                 overlay.show();
                 trigger.removeClass('is-closed');
                 trigger.addClass('is-open');
                 isClosed = true;
                 }
                 }
                 
                 $('[data-toggle="offcanvas"]').click(function () {
                 $('#wrapper').toggleClass('toggled');
                 }); */
            });

        </script>