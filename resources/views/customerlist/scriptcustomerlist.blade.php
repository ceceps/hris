<script>
//halaman users
$('#tableCustomer').DataTable({
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
        'url': "{{ url('customergetList') }}",
    },
    'oLanguage': {'sProcessing': "Wait a moment....!"},
    //Set column definition initialisation properties.
    'columns': [
    	{className:'control', defaultContent:''},
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    	{data:'check', name:'check'},
        {data:'qr_image', name:'qr_image',
			render: function(data, type, row){
                return "<img src='{{URL::asset('/assets/images/upload/customer/')}}/"+row.qr_image+
                "' width='50' height='50'/>"
			}
		},
		{data:'fullname', name:'fullname'},
        {data:'email', name:'email'},
        {data:'id_type', name:'id_type'},
        {data:'no_id', name:'no_id'},
        {data:'link', name:'link'},
        {data:'phone', name:'phone'},
        {data:'username', name:'username'},
        {data:'status', name:'status'},
    ],
    "columnDefs":[
        // membuat tidak dapat di search dan sorting
        {"searchable": false, "orderable": false, "targets": [0,1,2,3,6,7,8,9,10,11]},
    ],
});

// Sintak Validasi
$("#formCustomer").validate({
	rules: {
		fullname : {
			required: true,
			maxlength: 50
		},
        email: {
            required: true,
            email: true,
            accept:"[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}"
        },
        password:{
            required: true,
            maxlength: 100
        },
        username : {
			required: true,
        },
        no_id : {
			required: true,
		},
	},
	messages : {
		fullname : {
			required: "Fullname cannot be empty",
		},
        email: {
            required: "Email cannot be empty",
        },
        password:{
            required: "Password cannot be empty",
        },
        username : {
			required: "Username cannot be empty",
        },
        no_id : {
			required: "No ID cannot be empty",
		},

	},
	submitHandler: function(form) {
		var formData = new FormData(form);
		uploadDataCustomer(formData);
		return false;
	}
});

//Sintak ADD
$('#show_form_Customer').click(function(){
	$('#edit_customer').attr('id','tambah_customer').text('SAVE');
	$('#form_tambah').slideToggle();
});

// Sintak Cancel
$('#cancel').click(function(){
    $('#fullname').val('');
	$('#no_id').val('');
    $('#id_type').val('ID CARD');
    $('#email').val('');
	$('#username').val('');
    $('#password').val('');
    $('#status').val('REGULER');
});

// Sintak Menampilkan Data Untuk Edit
$(document).on('click','.editoffer',function(){
	$('html, body').animate({scrollTop : 0},500);
	$('#form_tambah').slideDown();
	$('#tambah_customer').attr('id','edit_customer').text('UPDATE OFFER');
	var ids 		= $(this).data('ids');
	var fullname 	= $(this).data('fullname');
	var no_id		= $(this).data('no_id');
    var id_type 	= $(this).data('id_type');
    var email 		= $(this).data('email');
	var username 	= $(this).data('username');
    var status 		= $(this).data('status');
    var phone 		= $(this).data('phone');

	$('#id').val(ids);
	$('#fullname').val(fullname);
	$('#no_id').val(no_id);
    $('#id_type').val(id_type);
    $('#email').val(email);
	$('#username').val(username);
    $('#status').val(status);
    $('#phone').val(phone);
});

// Sintak Update
$(document).on('click','#edit_customer',function(e){
	e.preventDefault();
	var form = $('form')[0];
	var formData = new FormData(form);
	var ids =$('#id').val();
	$('.progress').fadeIn();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        xhr: function() {
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){
                myXhr.upload.addEventListener('progress',progress, false);
            }
            return myXhr;
        },
        url : 'updateCustomer',
        type: 'post',
        data: formData,
        processData: false,
        contentType: false,
        cache:false,
        dataType:"json",
        success: function(data) {
            if(data.status==true){
                $('.progress').fadeOut();
                swal("Sukses!", data['message'], {
                    icon : "success",
                    buttons: {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                    timer : 2000
                });
                $('#form_tambah').slideUp();
                $('#tableCustomer').DataTable().ajax.reload();
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

// Sintak Untuk Tambah Data
function uploadDataCustomer(formdata){
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		xhr: function() {
			var myXhr = $.ajaxSettings.xhr();
			if(myXhr.upload){
				myXhr.upload.addEventListener('progress',progress, false);
			}
			return myXhr;
		},
		type: "POST",
		url : "{{ url('addCustomer') }}",
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
				$('#tableCustomer').DataTable().ajax.reload();
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
</script>
