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
                                            <h3><span data-plugin="counterup" id="counter_hk"></span></h3>
                                            <p class="text-muted font-15 mb-0">Total HK</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-home text-success mdi-24px"></i>
                                            <h3><span data-plugin="counterup" id="counter_libur"></span></h3>
                                            <p class="text-muted font-15 mb-0">Total Libur</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-user-check text-blue mdi-24px"></i>
                                            <h3><span data-plugin="counterup" id="counter_kehadiran"></span></h3>
                                            <p class="text-muted font-15 mb-0">Kehadiran</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xl-3">
                                        <div class="p-2 text-center">
                                            <i class="fas fa-user-times text-danger mdi-24px"></i>
                                            <h3><span data-plugin="counterup" id="counter_ketidakhadiran"></span></h3>
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

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Detail Absensi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<!-- plugin js -->
<script src="<?php echo base_url(); ?>assets/libs/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/fullcalendar/fullcalendar.min.js"></script>

<!-- Calendar init 
<script src="assets/js/pages/calendar.init.js"></script>
-->
<script type="text/javascript">
    var span_summary = ['counter_hk', 'counter_libur', 'counter_kehadiran', 'counter_ketidakhadiran'];
    function f_get_roster_summary() {
        $.ajax({
         type:"post",
         url:'<?php echo base_url(); ?>/Agent/get_roster_summary',
             //data: {},
             success: function(data){
                var result = JSON.parse(data);
                for (var i = 0; i < span_summary.length; i++) {
                    $('#'+span_summary[i]).html(result[0][span_summary[i]])
                }
            },
            error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error ' + jqXhr.status + ': ' + errorThrown + '</div>';
                notificationScript("error", "Error " + jqXhr.status, errorThrown);
                $.each(errors['errors'], function (index, value) {
                    errorsHtml += '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + value + '</div>';
                    notificationScript("error", "Error Field", value);
                });

            }
         }).done(function(){

          });
    }
	$('#calendar').fullCalendar({
	    weekends: true, // will hide Saturdays and Sundays
        slotDuration: "01:00:00",
        minTime: "06:00:00",
        maxTime: "23:00:00",
        defaultView: "month",
        aspectRatio: 3.5,
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
            return response.data; 
          },
          className: "bg-primary" // a non-ajax option
        }
        // any other sources...
        ],
        eventRender: function(eventObj, $el) {
            var content = 'Jadwal Jam masuk: ' + eventObj.waktu_masuk + '\nJadwal Jam keluar: ' + eventObj.waktu_keluar;
            $el.popover({
              title: eventObj.title,
              content: content,
              trigger: 'hover',
              placement: 'top',
              container: 'body'
            });
          },
        eventClick: function(eventObj, jsEvent, view) {
            var content = '<div class="row"><div class="col-sm-6"><img src="<?php echo base_url(); ?>uploads/attendance/'+ eventObj.perner +'_'+ moment(eventObj.absensi_masuk).format('YYYYMMDD_HHmmss') +'_login.png" alt="login_snap" class="img-fluid rounded" width="200">';
            content += '<p class="mb-0">Absensi masuk: ' + eventObj.absensi_masuk +'</p></div>';
            content += '<div class="col-sm-6"><img src="<?php echo base_url(); ?>uploads/attendance/'+ eventObj.perner +'_'+ moment(eventObj.absensi_keluar).format('YYYYMMDD_HHmmss') +'_logout.png" alt="logout_snap" class="img-fluid rounded" width="200">';
            content += '<p class="mb-0">Absensi keluar: ' + eventObj.absensi_keluar +'</p></div></div>';
            $('#myModal .modal-dialog .modal-content .modal-body').html(content);
            $('#myModal').modal('show');

          },
        editable: 0,
        droppable: 0,
        eventLimit: 0,
        selectable: 0,
	});

    $(document).ready(function() {
        f_get_roster_summary();
    });
</script>
