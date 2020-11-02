<script>
    $('#tableJobLevel').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        'paging': true,
        'scrollX': true,
        'lengthChange': true,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true,
        'processing': true, //Feature control the processing indicator.
        'serverSide': true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': "{{ url('api/joblevelsjson') }}",
        },
        'oLanguage': {
            'sProcessing': "Tunggu ya....!"
        },
        //Set column definition initialisation properties.
        'columns': [{
            className: 'control',
            defaultContent: ''
        }, {
            data: 'check',
            name: 'check'
        }, {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        }, {
            data: 'name',
            name: 'name'
        }, {
            data: 'link',
            name: 'link'
        }, ],
        "columnDefs": [
            // membuat tidak dapat di search dan sorting
            {
                "searchable": false,
                "orderable": false,
                "targets": [0, 1, 2, 4]
            },
        ],
    });
    function clearFormJobLevel() {
        $('#id').val('');
        $('#name').val('');
    }

    //Tombol Cancel
    $('#cancel').click(function() {
        clearFormJobLevel();
    });

    //Sintak ADD
    $('#show_form_job').click(function() {
        $('#edit_offer').attr('id', 'tambah_offer').text('Add');
        $('#form_tambah').slideToggle();
    });

     function uploadData(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ url('api/joblevels') }}",
            dataType: "json",
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == true) {
                    $('.progress').fadeOut();
                    swal("Success!", data.msg, {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                        timer: 2000
                    });
                    $('#form_tambah').fadeOut();
                    clearFormJobLevel();
                    $('#tableJobLevel').DataTable().ajax.reload();
                } else {
                    swal("Error!", data.msg, {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        }
                    });
                }
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
                var errorsHtml = '';
                $.each(errors.errors, function(key, value) {
                    errorsHtml += value[0] + '\n';
                });

                swal('Gagal!', errorsHtml, {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    }
                });
            }
        });
    }

     // Sintak Validasi
     $("#formJobLevel").validate({
        rules: {

            name: {
                required: true,
                maxlength: 255,
            },

        },
        messages: {
            name: {
                required: "Error! Nama Pekerjaan tidak boleh kosong",
                maxlength: "Error! max 255 character"
            },
        },
        submitHandler: function(form) {
            let formData = new FormData(form);
            uploadData(formData);
            return false;
        }
    });

    // Sintak Menampilkan Data Untuk Edit
$(document).on('click','.editoffer',function(){
	$('html, body').animate({scrollTop : 0},500);
	$('#form_tambah').slideDown();
	$('#tambah_offer').attr('id','edit_offer').text('UPDATE');
	var ids 		= $(this).data('ids');
	var name 		= $(this).data('name');
	var email		= $(this).data('email');
    var active 		= $(this).data('active');

	$('#id').val(ids);
	$('#name').val(name);
	$('#email').val(email);
    $('#active').val(active);
});

// Sintak Update
$(document).on('click','#edit_offer',function(e){
	e.preventDefault();
	var form = $('form')[0];
    var formData = new FormData(form);
    formData.push = {_method:'PUT'};
	var ids =$('#id').val();
	//var $fileUpload = $("input[type='file']");
	$('.progress').fadeIn();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'X-HTTP-Method-Override': 'PATCH' },
        // xhr: function() {
        //     var myXhr = $.ajaxSettings.xhr();
        //     if(myXhr.upload){
        //         myXhr.upload.addEventListener('progress',progress, false);
        //     }
        //     return myXhr;
        // },
        url : 'api/joblevels/'+ids,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache:false,
        dataType:"json",
        success: function(data) {
            if(data.status==true){
                $('.progress').fadeOut();
                swal("Sukses!", data['msg'], {
                    icon : "success",
                    buttons: {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                    timer : 2000
                });
                clearFormJobLevel();
                $('#form_tambah').slideUp();
                $('#tableJobLevel').DataTable().ajax.reload();
            }else{
                swal("Gagal!", data['msg'], {
                    icon : "error",
                    buttons: {
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                    timer : 2000
                });
            }
        },
        error: function(data) {
            var errors = data.responseJSON;
            console.log(errors);
            var errorsHtml = '';
            $.each(errors.errors, function( key, value ) {
                errorsHtml +=  value[0]+'\n';
            });

            swal('Gagal!',errorsHtml,{
                icon : "error",
                    buttons: {
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    }
            });
        }
    });
});

</script>
