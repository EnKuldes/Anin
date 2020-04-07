	<div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
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
	var calendar = $('#calendar').fullCalendar({
	    weekends: true, // will hide Saturdays and Sundays
        slotDuration: "01:00:00",
        minTime: "06:00:00",
        maxTime: "23:00:00",
        defaultView: "month",
        header: {
            // left: "prev,next today",
            // center: "title",
            // right: "month,agendaWeek,agendaDay"
            left: "title",
            right: false
        },
        eventSources: [

        // your event source
        {
          url: '<?php echo base_url(); ?>/Agent/get_roster',
          type: 'GET',
          /*data: {
            custom_param1: 'something',
            custom_param2: 'somethingelse'
          },*/
          error: function() {
            notificationScript('error', 'ERROR!', 'There is problem while fetching data');
          },
          success: function(response) {
            // Instead of returning the raw response, return only the data 
            // element Fullcalendar wants
            console.log(response)
            return response.data; 
          },
          className: "bg-primary" // a non-ajax option
        }
        // any other sources...
        ],
        editable: 0,
        droppable: 0,
        eventLimit: 0,
        selectable: 0,
	});
</script>
