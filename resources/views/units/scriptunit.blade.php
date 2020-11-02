<script type="text/javascript"
    src="{{ asset('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    //halaman Unit

    $('.date').datepicker({format:'dd-mm-yyyy'});
    $("#parent_id").select2();

    $("#parent_id2").select2({
      ajax: {
        url: "{!! url('/api/unit-option') !!}",
        type: "get",
        dataType: 'json',
        delay: 250,
        data: function (params) {
           return {
              searchTerm: params.term // search term
           };
        },
        processResults: function (response) {
           return {
              results: response
           };
        },
        placeholder: "Induk Unit",
        cache: true
      }
   });
    $('#form_tambah').hide();

    $('#tableUnit').DataTable({
        responsive: {
            details: {
                type: 'column'
            }
        },
        'paging'      	: true,
        'scrollX'       : true,
        'lengthChange'	: true,
        'searching'   	: true,
        'ordering'    	: false,
        'info'        	: true,
        'autoWidth'   	: true,
        'processing'	: true, //Feature control the processing indicator.
        'serverSide'	: true, //Feature control DataTables' server-side processing mode.
        'order': [], //Initial no order.
        // Load data for the table's content from an Ajax source
        'ajax': {
            'url': "{{ url('api/unitsjson') }}",
        },
        'oLanguage': {'sProcessing': "Tunggu ya....!"},
        //Set column definition initialisation properties.
        'columns': [
            {className:'control', defaultContent:''},
            {data:'check', name:'check'},
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data:'kode_unit', name:'kode_unit'},
            {data:'name', name:'name'},
            {data:'parent', name:'parent'},
            {data:'tgl_dibentuk', name:'tgl_dibentuk'},
            {data:'link', name:'link'},
        ],
        "columnDefs":[
            // membuat tidak dapat di search dan sorting
            {"searchable": false, "orderable": false, "targets": [0,1,2,7]},
        ],
    });
//Sintak ADD
$('#show_form_unit').click(function(){
	$('#edit_offer').attr('id','tambah_offer').text('Add');
	$('#form_tambah').slideToggle();
});



function clearFormUnit()
{
    $('#id').val('');
    $('#kode_unit').val('');
	$('#name').val('');
	$('#parent_id').val('').trigger('change');
	$('#tgl_dibentuk').val('');
}

//Tombol Cancel
$('#cancel').click(function(){
    clearFormUnit();
});

// Sintak Menampilkan Data Untuk Edit
$(document).on('click','.editoffer',function(){
	$('html, body').animate({scrollTop : 0},500);
	$('#form_tambah').slideDown();
	$('#tambah_unit').attr('id','edit_offer').text('UPDATE');

	var ids 		    = $(this).data('ids');
	var name 		    = $(this).data('name');
	var kode_unit 		= $(this).data('kode_unit');
	var parent_id 		= $(this).data('parent_id');
	var tgl_dibentuk	= $(this).data('tgl_dibentuk');

	$('#id').val(ids);
	$('#kode_unit').val(kode_unit);
	$('#name').val(name);

	if(parent_id!=0){
        $('#parent_id').val(parent_id);
        $('#parent_id').select2().trigger('change');
    }else{
        $('#parent_id').val('');
        $('#parent_id').select2().trigger('change');
    }
    $('#tgl_dibentuk').val(tgl_dibentuk);
});

// Sintak Update
$(document).on('click','#edit_offer',function(e){
	e.preventDefault();
	var form = $('form')[0];
	var formData = new FormData(form);
	var ids =$('#id').val();
	$('.progress').fadeIn();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url : '/edit-unit/'+ids,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache:false,
        dataType:"json",
        success: function(data) {
            if(data.status==true){
                $('.progress').fadeOut();
                swal("Sukses!", data.msg, {
                    icon : "success",
                    buttons: {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                    timer : 2000
                });
                $('#form_tambah').slideUp();
                clearFormUnit();
                $('#tableUsers').DataTable().ajax.reload();
            }else{
                swal("Gagal!", data['message'], {
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

// Sintak Untuk Tambah Data
function uploadDataUnit(formdata){
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		// xhr: function() {
		// 	var myXhr = $.ajaxSettings.xhr();
		// 	if(myXhr.upload){
		// 		myXhr.upload.addEventListener('progress',progress, false);
		// 	}
		// 	return myXhr;
		// },
		type: "POST",
		url : "{{ url('units') }}",
		dataType:"json",
		data: formdata,
		cache: false,
		processData: false,
		contentType: false,
		success: function(data) {
			if(data.status==true){
				$('.progress').fadeOut();
				swal("Success!", data.msg, {
					icon : "success",
					buttons: {
						confirm: {
							className : 'btn btn-success'
						}
					},
					timer: 2000
				});
				$('#form_tambah').fadeOut();
                clearFormUnit();
				$('#tableUnit').DataTable().ajax.reload();
			}else{
				swal("Error!", data.msg, {
					icon : "error",
					buttons: {
						confirm: {
							className : 'btn btn-danger'
						}
					}
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
}

// Sintak Validasi
$("#formUnit").validate({
	rules: {
		kode_unit : {
			required: true,
			maxlength: 255
		},
        name: {
            required: true,
            maxlength: 255,
        },
        tgl_keluar:{
            required: true
        }
	},
	messages : {
		name : {
			required : "Error! Nama Unit tidak boleh kosong",
			maxlength : "Error! max 255 character"
		},
	},
	submitHandler: function(form) {
		var formData = new FormData(form);
		uploadDataUnit(formData);
		return false;
	}
});
</script>
