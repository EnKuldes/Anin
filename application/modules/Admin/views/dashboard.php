	<div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <!--a href="<?php echo base_url(); ?>Admin/download_roster_v2"> Test Download</a-->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box widget-inline">
                                <div class="row">
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-suitcase text-primary mdi-24px"></i>
                                            <h3><span data-plugin="counterup">8954</span></h3>
                                            <p class="text-muted font-15 mb-0">Total HK</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-home text-success mdi-24px"></i>
                                            <h3><span data-plugin="counterup">7841</span></h3>
                                            <p class="text-muted font-15 mb-0">Total Libur</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-user-check text-blue mdi-24px"></i>
                                            <h3><span data-plugin="counterup">6521</span></h3>
                                            <p class="text-muted font-15 mb-0">Kehadiran</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-user-times text-danger mdi-24px"></i>
                                            <h3><span data-plugin="counterup">325</span></h3>
                                            <p class="text-muted font-15 mb-0">Ketidak Hadiran</p>
                                        </div>
                                    </div>

                                </div> <!-- end row -->
                            </div> <!-- end card-box-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="calendar"></div>
                        </div> <!-- end col -->
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->       
        </div>
        <!-- end col-12 -->
    </div> <!-- end row -->

<!-- plugin js -->
<script src="<?php echo base_url(); ?>assets/libs/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/fullcalendar/fullcalendar.min.js"></script>

<!-- Calendar init 
<script src="assets/js/pages/calendar.init.js"></script>
-->
<script type="text/javascript">
	$('#calendar').fullCalendar({
	    weekends: true, // will hide Saturdays and Sundays
	});
</script>
