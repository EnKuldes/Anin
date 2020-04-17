<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="mt-0 mb-0 font-16">Layanan <span id="layanan_desc">Net Promoter Score</span></h4>
                </div>
                <div class="col-lg-4">
                    <form class="form-inline">
                        <div class="form-group mx-sm-3">
                            <label for="layanan-select" class="mr-2">Layanan </label>
                            <select class="custom-select" id="layanan-select">
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                        <i class="mdi mdi-percent font-22 avatar-title text-primary"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup" id="persentasi_kehadiran">0</span>%</h3>
                        <p class="text-muted mb-1 text-truncate">Persentasi Kehadiran</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                        <i class="mdi mdi-worker font-22 avatar-title text-success"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup" id="jmlh_pegawai">0</span></h3>
                        <p class="text-muted mb-1 text-truncate">Jumlah Pegawai</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                        <i class="mdi mdi-account-check font-22 avatar-title text-info"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup" id="jmlh_duty">0</span></h3>
                        <p class="text-muted mb-1 text-truncate">Jumlah Duty</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row">
                <div class="col-6">
                    <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                        <i class="mdi mdi-account-off-outline font-22 avatar-title text-warning"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <h3 class="mt-1"><span data-plugin="counterup" id="jmlh_off_duty">0</span></h3>
                        <p class="text-muted mb-1 text-truncate">Jumlah Off Duty</p>
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-8">
        <!-- Portlet card -->
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-0">Persentasi Kehadiran 7 Hari Kebelakang</h4>

                <div id="cardCollpase1" class="collapse pt-3 show">
                    <div class="text-center">
                        <canvas id="financial-report"></canvas>

                    </div>
                </div> <!-- collapsed end -->
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-0">Kehadiran Hari Ini</h4>

                <div id="cardCollpase2" class="collapse pt-3 show">
                    <div class="row pt-3">
                        <canvas id="pie-chart-example"></canvas>
                    </div>
                </div> <!-- collapsed end -->
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-0">Keterangan Kehadiran</h4>
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- plugin js -->
<script src="<?php echo base_url(); ?>assets/libs/jquery-ui/jquery-ui.min.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url(); ?>assets/libs/chart-js/Chart.bundle.min.js"></script>
<!-- Inisiasi -->
<script type="text/javascript">
    // Grafik/Charts
    var chartBar = document.getElementById("financial-report").getContext("2d");
    chartBar.canvas.width = 1e3;
    var chartPie = document.getElementById("pie-chart-example").getContext("2d");
    chartPie.canvas.height = 290;
    var chartBar_cfg = {
        type: "bar",
        data: {
            labels: ["Senen","Senen","Senen","Senen","Senen",],
            datasets: [{
                label: "Persentasi",
                data: [100,90,98,100,90],
                type: "line",
                pointRadius: 0,
                fill: !(chartBar.canvas.height = 300),
                borderColor: "#39afd1",
                backgroundColor: "rgba(57,175,209,0.2)",
                lineTension: 0,
                borderWidth: 2
            }]
        },
        options: {
            tooltips: {
                backgroundColor: "#dee2e6",
                titleFontColor: "#6658dd",
                bodyFontColor: "#000",
                bodyFontSize: 14,
                displayColors: !1
            },
            scales: {
                xAxes: [{
                    type: "time",
                    time: {
                        unit: 'day'
                    },
                    distribution: "series",
                    ticks: {
                        //source: "labels"
                        source: "auto"
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0
                        , max: 100
                    },
                    scaleLabel: {
                        display: 0,
                        labelString: "Persentasi "
                    }
                }]
            }
        }
    };
    var chartPie_cfg = {
        type: "pie",
        data: {
            labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
            datasets: [{
                data: [300, 135, 48, 154],
                backgroundColor: ["#6658dd", "#fa5c7c", "#4fc6e1", "#525e6b"],
                borderColor: "transparent"
            }]
        },
        options: {
            maintainAspectRatio: !1,
            legend: {
                display: 1
                , position: 'bottom'
            },
            tooltips: {
                backgroundColor: "#dee2e6",
                titleFontColor: "#6658dd",
                bodyFontColor: "#000",
                bodyFontSize: 14,
                displayColors: !1
            }
        }
    };

    bar = new Chart(chartBar, chartBar_cfg);
    pie = new Chart(chartPie, chartPie_cfg);

    // Func-func
    function f_get_list_layanan() {
        $.ajax({
         type:"post",
         url:'<?php echo base_url(); ?>/Admin/get_list_layanan',
             //data: {},
             success: function(data){
                var result = JSON.parse(data);
                //console.log(result)
                var content = '';
                for (var i = 0; i < result.length; i++) {
                    content += '<option value="'+ result[i]['c_layanan'] +'">'+ result[i]['layanan_desc'] +'</option>}'
                }
                $('#layanan-select').html(content)
                $('#layanan-select').trigger('change')
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
    function f_get_roster_information(val_id_layanan) {
        $.ajax({
         type:"post",
         url:'<?php echo base_url(); ?>/Admin/get_roster_information',
             data: {id_layanan: val_id_layanan},
             success: function(data){
                var result = JSON.parse(data);
                // console.log(result)
                $('#jmlh_pegawai').html(result['jumlah_pegawai']);
                $('#jmlh_duty').html(result['duty']);
                $('#jmlh_off_duty').html(result['off_duty']);
                var persentasi_kehadiran = (result['presensi']/result['duty'])*100;
                if (isNaN(persentasi_kehadiran)) {persentasi_kehadiran = 0;}
                $('#persentasi_kehadiran').html(Math.round(persentasi_kehadiran));
                // Popu;ate Chart
                var label = [ 'Presensi', 'Belum Presensi' ];
                var data = [ result['presensi'], result['belum_presensi'] ];
                populate_chart(pie, label, data)
                
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
    function f_get_trend_roster_information(val_id_layanan) {
        $.ajax({
         type:"post",
         url:'<?php echo base_url(); ?>/Admin/get_trend_roster_information',
             data: {id_layanan: val_id_layanan},
             success: function(data){
                var result = JSON.parse(data);
                // console.log(result)
                var label = [];
                var data = [];
                for (var i = 0; i < result.length; i++) {
                    label.push(moment(result[i]['rooster_date'], 'YYYY-MM-DD'));
                    var persentasi_kehadiran = (result[i]['presensi']/result[i]['duty'])*100;
                    if (isNaN(persentasi_kehadiran)) {persentasi_kehadiran = 0;}
                    data.push(Math.round(persentasi_kehadiran));
                }
                populate_chart(bar, label, data)
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
    function f_get_attendance_information(val_id_layanan) {
        $.ajax({
         type:"post",
         url:'<?php echo base_url(); ?>/Admin/get_attendance_information',
             data: {id_layanan: val_id_layanan},
             success: function(data){
                var result = JSON.parse(data);
                //console.log(result)
                var ol_content = '<ol class="carousel-indicators">';
                var div_content = '<div class="carousel-inner" role="listbox">';
                for (var i = 0; i < Math.ceil(result.length/4); i++) {
                    ol_content += '<li data-target="#carouselExampleFade" data-slide-to="'+ i +'" '+ ( (i == 0) ? 'class="active"' : '' ) +'></li>';
                    div_content += '<div class="carousel-item '+ ( (i == 0) ? 'active' : '' ) +'"><div class="row">';
                    for (var j = i*4; j < (i*4)+4; j++) {
                        if (result[j]) {
                            var image_url = '';
                            if ( null !== result[j]['waktu_absensi'] && undefined !== result[j]['waktu_absensi'] ) {
                                var snap_datetime = moment(result[j]['waktu_absensi'], 'YYYY-MM-DD HH:mm:ss').format('YYYYMMDD_HHmmss');
                                image_url = result[j]['no_perner'] + '_' + snap_datetime;
                                if (result[j]['log_status'] != 0) {
                                    image_url += (result[j]['log_status'] == 1) ? '_login' : '_logout';
                                }
                            }
                            div_content += '<div class="col-md-3"><div class="card-box product-box"><div class="product-img-bg"><img src="<?php echo base_url(); ?>uploads/attendance/'+ image_url +'.png" alt="absensi-'+ result[j]['user_name'] + '" class="img-fluid" /></div>';
                            div_content += '<div class="product-info"><div class="row align-items-center"><div class="col"><h5 class="font-16 mt-0 sp-line-1"><a href="ecommerce-prduct-detail.html" class="text-light">'+ result[j]['user_name'] + '</a> </h5>';
                            var keterangan_absensi = 'Belum Absensi';
                            var waktu_absensi = '- (-)';
                            if (result[j]['log_status'] != 0) {
                                keterangan_absensi = (result[j]['log_status'] == 1) ? 'Datang' : 'Pulang';
                                
                                var jadwal_waktu = moment(result[j]['waktu_jadwal'],"HH:mm:ss");
                                var absensi_waktu = moment(result[j]['waktu_absensi'],"YYYY-MM-DD HH:mm:ss");
                                console.log(jadwal_waktu)
                                console.log(absensi_waktu)
                                var duration = moment.duration(jadwal_waktu.diff(absensi_waktu));
                                var minutes = duration.asMinutes();
                                console.log(minutes)
                                if (minutes > 15) { keterangan_absensi += ' Awal' }
                                else if (minutes < -15) { keterangan_absensi += ' Telat' }
                                else { keterangan_absensi += ' Tepat' }
                                keterangan_absensi += ' Waktu.';
                                waktu_absensi = absensi_waktu.format("HH:mm:ss") + ' ('+ Math.ceil(minutes) +' Menit)'
                            }
                            div_content += '<div class="text-warning mb-2 font-13"><h5 class="m-0"> '+ keterangan_absensi +'</h5></div>';
                            div_content += '<h5 class="m-0"> <span class="text-muted"> '+ waktu_absensi +'</span></h5></div>';
                            div_content += '<div class="col-auto"><div class="product-price-tag">'+ result[j]['shift'] +'</div></div></div></div></div></div> '
                        }
                    }
                    div_content += '</div>';
                    div_content += '</div>';
                }
                ol_content += '</ol>';
                div_content += '</div>';
                var content = /*ol_content + */div_content + '<div class="carousel-indicators"><a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';
                $('#carouselExampleFade').html(content);
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
    function populate_chart(chart, label, data) {
        chart.data.labels = label;
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data;
        });
        chart.update();
    }

    // On Change Events
    $("#layanan-select").change(function() {
        var id = $(this).val();
        if (id != "" && id != null)
        {
            // Call Fungsi Inisiasi di sini
            $('#layanan_desc').html($( "#layanan-select option:selected" ).text())
            f_get_roster_information(id)
            f_get_trend_roster_information(id)
            f_get_attendance_information(id)
            //console.log("Henshin!! ID: "+id)
        }
    });
    function init() {
        f_get_list_layanan()
    }
    $(document).ready(function() {
        init();
    });
</script>
