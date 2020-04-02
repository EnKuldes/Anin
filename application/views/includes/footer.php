        </div>
        <!-- end wrapper -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        2019 &copy; IT Specialist DBO
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <!-- Global Scripts -->
        <script src="<?php echo base_url(); ?>assets/libs/jquery-toast/jquery.toast.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/libs/ladda/spin.js"></script>
        <script src="<?php echo base_url(); ?>assets/libs/ladda/ladda.js"></script>
        <script type="text/javascript">
            // Func Notification
            function notificationScript(type, title, message) {
              console.log('Notification will start')
              $.toast({
                    text: message, // Text that is to be shown in the toast
                    heading: title, // Optional heading to be shown on the toast
                    icon: type, // Type of toast icon
                    showHideTransition: 'fade', // fade, slide or plain
                    allowToastClose: false, // Boolean value true or false
                    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    textAlign: 'left',  // Text alignment i.e. left, right or center
                    loader: false,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                    beforeShow: function () {}, // will be triggered before the toast is shown
                    afterShown: function () {}, // will be triggered after the toat has been shown
                    beforeHide: function () {}, // will be triggered before the toast gets hidden
                    afterHidden: function () {}  // will be triggered after the toast has been hidden
                });
            }
        </script>
        </body>
</html>