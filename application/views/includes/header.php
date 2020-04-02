<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

        <!-- Plugins css -->
        <link href="<?php echo base_url(); ?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <!-- Vendor js -->
        <script src="<?php echo base_url(); ?>assets/js/vendor.min.js"></script>

        <!-- Plugins js 
        JS at Body -->
        
        <!-- App js-->
        <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>

    </head>
    <body>

        <!-- Navigation Bar-->
        <header id="topnav">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $this->session->userdata('user_avatar');?>.jpg" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    <?php echo $this->session->userdata('user_name');?> <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="<?php echo base_url(); ?>Admin/logoff" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="<?php echo base_url(); ?>" class="logo text-center">
                            <span class="logo-lg">
                                <img src="<?php echo base_url(); ?>assets/images/logo-light.png" alt="" height="40">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">U</span> -->
                                <img src="<?php echo base_url(); ?>assets/images/logo-sm.png" alt="" height="33">
                            </span>
                        </a>
                    </div>
                </div> <!-- end container-fluid-->
            </div>
            <!-- end Topbar -->