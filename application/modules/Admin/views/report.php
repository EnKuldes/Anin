<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<div class="card-widgets">
				<form class="form-inline">
					<div class="form-group">
						<div class="input-group input-group-sm">
							<select class="form-control custom-select" style="width:100%" id="list_layanan"></select>
						</div>
						<div class="input-group input-group-sm">
							<select class="form-control custom-select" style="width:100%" id="list_year"></select>
						</div>
						<div class="input-group input-group-sm">
							<select class="form-control custom-select" style="width:100%" id="list_month"></select>
						</div>
					</div>
					<a href="javascript: init();" class="btn btn-blue btn-sm ml-2">
						<i class="mdi mdi-autorenew"></i>
					</a>
					<a href="javascript: f_download_data();" class="btn btn-blue btn-sm ml-1">
						<i class="mdi mdi-download"></i>
					</a>
				</form>
			</div>
			<h4 class="header-title">Report Layanan <span id="layanan_desc"></span></h4>
			<p class="sub-header" id="month_year">Bulan dan Tahun</p>

			<div class="table-responsive">
				<table class="table table-dark mb-0" id="report-table">
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Plugins JS -->
<!-- <script src="<?php echo base_url(); ?>assets/libs/select2/select2.min.js"></script> -->
<script type="text/javascript">
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
            $('#list_layanan').html(content)
            $('#list_layanan').trigger('change')
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
	function f_get_list_year(val_id_layanan) {
		$.ajax({
			type:"post",
			url:'<?php echo base_url(); ?>/Admin/get_list_date',
         	data: {id_layanan: val_id_layanan},
         success: function(data){
         	var result = JSON.parse(data);
            //console.log(result)
            var content = '';
            for (var i = 0; i < result.length; i++) {
            	content += '<option value="'+ result[i]['year'] +'">'+ result[i]['year'] +'</option>}'
            }
            $('#list_year').html(content)
            $('#list_year').trigger('change')
            
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
	function f_get_list_month(val_id_layanan, val_year) {
		$.ajax({
			type:"post",
			url:'<?php echo base_url(); ?>/Admin/get_list_date',
         	data: {id_layanan: val_id_layanan, year: val_year},
         success: function(data){
         	var result = JSON.parse(data);
            //console.log(result)
            var content = '';
            var last_id = 0;
            for (var i = 0; i < result.length; i++) {
            	var d = new Date(val_year, result[i]['month']-1, 1);
            	content += '<option value="'+ result[i]['month'] +'">'+ moment(d).format('MMMM') +'</option>}'
            	last_id = result[i]['month'];
            }
            $('#list_month').html(content)
            $('#list_month').val(last_id).trigger('change')
            
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
	function f_get_report(val_id_layanan, val_year, val_month) {
		$.ajax({
			type:"post",
			url:'<?php echo base_url(); ?>/Admin/get_report',
         	data: {id_layanan: val_id_layanan, year: val_year, month: val_month},
         success: function(data){
         	var result = JSON.parse(data);
            // console.log(result)
            var content = '';
            var list_perner = trans_val(result, 'no_perner');
            var list_date = trans_val(result, 'rooster_date');
            var list_kode_shift = trans_val(result, 'kode_shift');
            /*console.log(list_perner);
            console.log(list_date);
            console.log(list_kode_shift.sort());*/

            content += '<thead><tr><th rowspan="3" class="text-center align-middle">Nama</th>'
            content += '<th colspan="'+ list_date.length +'" class="text-center">Date</th>'
            content += '</tr>'
            for (var i = 0; i < 2; i++) {
            	content += '<tr>'
	            for (var j = 0; j < list_date.length; j++) {
	            	var v_date = moment(list_date[j], 'YYYY-MM-DD');
	            	if (i == 0) {
	            		content += '<td>'+ v_date.format('DD') +'</td>'
	            	}
	            	else{content += '<td>'+ v_date.format('ddd') +'</td>'}
	            }
	        	content += '</tr>'
            }
            content += '</thead>'

            content += '<tbody>'
            
            for (var i = 0; i < list_perner.length; i++) {
            	window['data'+list_perner[i]] = []
            	for (var j = 0; j < result.length; j++) {
            		if (list_perner[i] == result[j]['no_perner']) {
            			window['data'+list_perner[i]].push(result[j]);
            		}
            	}
            }

            for (var i = 0; i < list_perner.length; i++) {
            	for (var j = 0; j < window['data'+list_perner[i]].length; j++) {
            		if (j == 0) {content += '<tr><th scope="row">'+ window['data'+list_perner[i]][j]['user_name'] +'</th>'}
            		if (list_date[j] == window['data'+list_perner[i]][j]['rooster_date'] ) {
            			content += '<td class="text-'+ window['data'+list_perner[i]][j]['bg_color'] +'">'+window['data'+list_perner[i]][j]['absensi'];
            			content += '</td>';
            		}
            	}
            	content += '</tr>'; 
            }

            content += '</tbody>'

            $('#report-table').html(content)

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
	function trans_val(data, key) {
		var resArr = [];
		data.filter(function(item){
			var i = resArr.findIndex(x => (x[key] == item[key]));
			if(i <= -1){
				resArr.push(item);
			}
			return null;
		});
		//console.log(resArr)
		var retArr = []
		for (var i = 0; i < resArr.length; i++) {
			retArr.push(resArr[i][key])
		}
		return retArr;
	}
	function f_download_data() {
		notificationScript('warning', 'Warning!', 'Masih dalam tahap development');
        var form = document.createElement("form");
        form.setAttribute("method", 'post');
        form.setAttribute("action", '<?php echo base_url(); ?>Admin/download_report');
        var id_layanan = document.createElement("input"); //input element, text
		id_layanan.setAttribute('type',"text");
		id_layanan.setAttribute('name',"id_layanan");
		id_layanan.setAttribute('value',$('#list_layanan').val());
		form.appendChild(id_layanan);
		var year = document.createElement("input"); //input element, text
		year.setAttribute('type',"text");
		year.setAttribute('name',"year");
		year.setAttribute('value',$('#list_year').val());
		form.appendChild(year);
		var month = document.createElement("input"); //input element, text
		month.setAttribute('type',"text");
		month.setAttribute('name',"month");
		month.setAttribute('value',$('#list_month').val());
		form.appendChild(month);

        document.body.appendChild(form);
        form.submit();
	}
	// On Change Events
    $("#list_layanan").change(function() {
        var id = $(this).val();
        if (id != "" && id != null)
        {
            // Call Fungsi Inisiasi di sini
            //console.log("Henshin!! ID: "+id)
            $('#layanan_desc').html($( "#list_layanan option:selected" ).text())
            f_get_list_year(id)
        }
    });
    $("#list_year").change(function() {
        var id = $(this).val();
        if (id != "" && id != null)
        {
            // Call Fungsi Inisiasi di sini
            f_get_list_month($('#list_layanan').val(), id)
        }
    });
    $("#list_month").change(function() {
        var id = $(this).val();
        if (id != "" && id != null)
        {
            // Call Fungsi Inisiasi di sini
            $('#month_year').html($( "#list_year option:selected" ).text() + ' ' + moment(id, 'MM').format('MMMM'))
            f_get_report($('#list_layanan').val(), $('#list_year').val(), id)
        }
    });
    function init() {
        f_get_list_layanan()
    }
    $(document).ready(function() {
        init();
    });
</script>