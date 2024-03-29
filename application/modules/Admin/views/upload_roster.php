	
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="upload_roster" method="POST">
                        <h4 class="header-title">Upload Roster</h4>
                        <p class="sub-header">
                            
                        </p>

                        <input type="file" class="dropify" name="file" id="file" data-height="100" data-allowed-file-extensions="xlsx" />
                    </form>
                    <div class="clearfix text-right mt-3">
                        <button type="button" class="btn btn-primary" id="btn-format-upload"> <i class="mdi mdi-file-document mr-1"></i> Contoh Format Upload</button>
                        <button type="button" class="btn btn-danger" id="btn-rollback"> <i class="mdi mdi-backup-restore mr-1"></i> Rollback</button>
                        <button class="ladda-button btn btn-success" data-style="expand-right" form="upload_roster" id="btn-submit"><span class="ladda-label"> <i class="mdi mdi-send mr-1"></i> Submit</span><span class="ladda-spinner"></span></button>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->
    </div>
    <!-- end row --> 

<!-- Plugins js -->
<script src="<?php echo base_url(); ?>assets/libs/dropify/dropify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //notificationScript("info", "TES", "Tes");
    });
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        }
    });
    $('#btn-rollback').on('click', function(e){
        e.preventDefault();
        notificationScript('warning', 'Warning!', 'Masih dalam tahap development');
    });
    $('#btn-format-upload').on('click', function(e){
        e.preventDefault();
        //notificationScript('warning', 'Warning!', 'Masih dalam tahap development');
        var form = document.createElement("form");
        form.setAttribute("method", 'post');
        form.setAttribute("action", '<?php echo base_url(); ?>Admin/download_format_upload');
        document.body.appendChild(form);
        form.submit();
    });
    $('#upload_roster').on('submit', function(e){
        e.preventDefault();
        if( document.getElementById("file").files.length == 0 ){
            console.log("no files selected");
            notificationScript("warning", "Warning!", "Tidak ada files yang di unggah!");
        }
        else{
            var l = Ladda.create(document.querySelector('#btn-submit'));
            l.start();
            var input = $(this).serialize();
            
            $.ajax({
               type:"post",
               url:'<?php echo base_url(); ?>Upload_data/upload_roster',
               data:  new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
               success: function(data){
                var data = JSON.parse(data);
                notificationScript(data['alert-class'], data['alert-title'], data['message']);
                l.stop();
                $('.dropify-clear').click();
               },
                error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error ' + jqXhr.status + ': ' + errorThrown + '</div>';
                notificationScript("error", "Error " + jqXhr.status, errorThrown);
                $.each(errors['errors'], function (index, value) {
                    errorsHtml += '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + value + '</div>';
                    notificationScript("error", "Error Field", value);
                    l.stop();
                });

            }
         }).done(function(){

             });
        }

    });
    
</script>
