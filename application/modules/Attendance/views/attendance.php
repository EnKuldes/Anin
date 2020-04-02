<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

        <!-- Plugins css-->
        <link href="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- Loading button css -->
        <link href="<?php echo base_url(); ?>assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
        <!-- Custom box css -->
        <link href="<?php echo base_url(); ?>assets/libs/custombox/custombox.min.css" rel="stylesheet">

        <!-- App css -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
        
        <!-- -->
        <style type="text/css">
            #results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
        </style>

    </head>

    <body class="authentication-bg authentication-bg-pattern">
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">Loading...</div>
            </div>
        </div>
        <!-- End Preloader-->

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="" id="am">
                                        <span><img src="<?php echo base_url(); ?>assets/images/logo-light.png" alt="" height="80"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3"></p>
                                </div>

                                <form action="#" id="attend">
                                    <div class="form-group mb-3 text-center">
                                        <div id="my_camera" style="margin: auto;"></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="prener_id">ID</label>
                                        <input class="form-control" type="text" id="prener_id" name="prener_id" required="" placeholder="Enter your ID" autocomplete="off">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <img id="snap_image" style="display: none;">
                                        <button class="ladda-button btn btn-primary btn-block" id="submit-form" type="submit" data-style="expand-right"> Submit </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <div id="con-close-modal" class="modal contentscale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="Custombox.modal.close();">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <form action="#" id="login">

                                <div class="form-group mb-3">
                                    <label for="emailaddress">User ID</label>
                                    <input class="form-control" type="text" id="userid" name="userid" required="" placeholder="Enter your User ID" autocomplete="off">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password"  autocomplete="off">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->


        <footer class="footer footer-alt">
            2019 &copy; IT Specialist DBO
        </footer>

        <!-- Vendor js -->
        <script src="<?php echo base_url(); ?>assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>

        <!-- Sweet Alerts js -->
        <script src="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <!-- Sweet alert init js-->
        <script src="<?php echo base_url(); ?>assets/js/pages/sweet-alerts.init.js"></script>
        <!-- Loading buttons js -->
        <script src="<?php echo base_url(); ?>assets/libs/ladda/spin.js"></script>
        <script src="<?php echo base_url(); ?>assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="<?php echo base_url(); ?>assets/js/pages/loading-btn.init.js"></script>

        <!-- Modal-Effect -->
        <script src="<?php echo base_url(); ?>assets/libs/custombox/custombox.min.js"></script>

        <!-- Webcam -->
        <!-- First, include the Webcam.js JavaScript Library -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/webcam/webcam.min.js"></script>
        <script type="text/javascript">
            var vClicked = 0;
            Webcam.set({
                // live preview size
                width: 480,
                height: 360,
                
                // device capture size
                dest_width: 640,
                dest_height: 480,
                
                // final cropped size
                crop_width: 480,
                crop_height: 480,

                // Mirror
                flip_horiz: true,
                
                // format and quality
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            
            Webcam.attach( '#my_camera' );
            function take_snapshot() {
                // take snapshot and get image data
                Webcam.snap( function(data_uri) {
                    document.getElementById("snap_image").src = data_uri;
                } );
            }
        </script>
        <script type="text/javascript">
            function clear_input() {
                $('#attend').trigger("reset");
            }
            $("#attend").submit(function(){
                event.preventDefault();
                var l = Ladda.create( document.querySelector( '#submit-form' ) );
                l.start();
                take_snapshot();
                var input = $( this ).serializeArray();
                var prener_id_val = input[0]['value'];
                var snap_image_val =  document.getElementById("snap_image").src;
                /*var formdata = new FormData();
                formdata.append("snap_image", snap_image);
                formdata.append("prener_id", prener_id);*/
                $.ajax({    
                    type:"POST",
                    url:"<?php echo base_url(); ?>Attendance/attend",
                    data:{prener_id: prener_id_val, snap_image: snap_image_val},
                    success:function(msg){
                        var results = JSON.parse(msg);
                        l.stop();
                        if (results.length > 0) {
                            var imgurl = '<?php echo base_url(); ?>' + results[0]["image_icon"];   
                            Swal.fire({
                              //title: 'Sweet!!',
                              html: results[0]["c_message"],
                              timer: 3000,
                              imageUrl: imgurl,
                              imageWidth: 320,
                              imageHeight: 300,
                              imageAlt: 'Custom gif',
                              animation: true
                            });
                        }
                        else{
                            Swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Something went wrong! (1)'
                            })
                        }
                        clear_input();
                    },
                    error:function(msg) {
                        l.stop();
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!'
                        })
                    }
                }).done(function(msg){

                })
            });

            $("#am").click(function() { 
                event.preventDefault();
                vClicked++;
                if (vClicked > 2) {
                    // Instantiate new modal
                    var modal = new Custombox.modal({
                      content: {
                        effect: 'contentscale',
                        target: '#con-close-modal'
                      }
                    });

                    // Open
                    modal.open();
                    vClicked = 0;
                }
            }); 

            $("#login").submit(function(){
                event.preventDefault();
                $.ajax({    
                    type:"POST",
                    url:"<?php echo base_url(); ?>Attendance/auth",
                    data: $( this ).serialize(),
                    success:function(msg){
                    },
                    error:function(msg) {
                        Swal.fire({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!'
                        })
                    }
                }).done(function(msg){
                    results = JSON.parse(msg);
                    Custombox.modal.close();
                    Swal.fire({
                      type: results["type"],
                      html: results["message"]
                    });
                    if (typeof(results["redirected_page"]) != "undefined" && results["redirected_page"] !== null) {
                        setTimeout(function() {location.href = "<?php echo base_url(); ?>" + results["redirected_page"]}, 5000);
                    }
                });
            });
        </script>
    </body>
</html>