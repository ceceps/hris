<script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    //halaman Unit
    $('.select2').select2();
    $('#jabatan_unit_id').select2({
        ajax: {
            url: "{!! url('/api/jabatan-unit') !!}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            placeholder: "Pilih Jabatan",
            cache: true
        }
    });

    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });

    $('#form_tambah').hide();

    $('#tableAnggota').DataTable({
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
            'url': "{{ url('api/anggotajson') }}",
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
            data: 'noktp',
            name: 'noktp'
        }, {
            data: 'name',
            name: 'name'
        }, {
            data: 'alamat',
            name: 'alamat'
        }, {
            data: 'link',
            name: 'link'
        }, ],
        "columnDefs": [
            // membuat tidak dapat di search dan sorting
            {
                "searchable": false,
                "orderable": false,
                "targets": [0, 1, 2, 6]
            },
        ],
    });

    //select chain

    $('#province_id').select2({
        ajax: {
            url: "{!! url('/api/province') !!}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            placeholder: "Provinsi",
            cache: true
        }
    });

    $('#city_id').select2({
        ajax: {
            url: "{!! url('/api/city') !!}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    id: $("#province_id").val(), // search term
                    q: params.term
                };
            },
            processResults: function(response) {
                var range = [];

                for (var i = 0; i < response.length; i++) {
                    var option = {
                        id: response[i].id,
                        text: response[i].text
                    };

                    range.push(option);
                }
                return {
                    results: range
                };
            },
            placeholder: "Kota",
            cache: true
        }
    });

    $('#district_id').select2({
        ajax: {
            url: "{!! url('/api/district') !!}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    id: $("#city_id").val(), // search term
                    q: params.term
                };
            },
            processResults: function(response) {
                var range = [];

                for (var i = 0; i < response.length; i++) {
                    var option = {
                        id: response[i].id,
                        text: response[i].text
                    };
                    range.push(option);
                }
                return {
                    results: range
                };
            },
            placeholder: "Kecamatan",
            cache: true
        }
    });

    $('#village_id').select2({
        ajax: {
            url: "{!! url('/api/village') !!}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    id: $("#district_id").val(), // search term
                    q: params.term
                };
            },
            processResults: function(response) {
                var range = [];

                for (var i = 0; i < response.length; i++) {
                    var option = {
                        id: response[i].id,
                        text: response[i].text
                    };
                    range.push(option);
                }
                return {
                    results: range
                };
            },
            placeholder: "Kelurahan",
            cache: true
        }
    });

    $('#unit_id').select2({
        ajax: {
            url: "{!! url('/api/unit-option2') !!}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(response) {
                var range = [];
                for (var i = 0; i < response.length; i++) {
                    var option = {
                        id: response[i].id,
                        text: response[i].text
                    };
                    range.push(option);
                }
                return {
                    results: range
                };
            },
            placeholder: "Kelurahan",
            cache: true
        }
    });


    //Sintak ADD
    $('#show_form_keluarga').click(function() {
        $('#edit_offer').attr('id', 'tambah_offer').text('Add');
        $('#form_tambah').slideToggle();

    });


    function clearFormUnit() {
        $('#id').val('');
        $('#kode_unit').val('');
        $('#name').val('');
        $('#parent_id').val('').trigger('change');
        $('#tgl_dibentuk').val('');
    }

    //Tombol Cancel
    $('#cancel').click(function() {
        clearFormUnit();
    });

    // Sintak Menampilkan Data Untuk Edit
    $(document).on('click', '.editoffer', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        $('#form_tambah').slideDown();
        $('#tambah_unit').attr('id', 'edit_offer').text('UPDATE');

        var ids = $(this).data('ids');
        var name = $(this).data('name');
        var kode_unit = $(this).data('kode_unit');
        var parent_id = $(this).data('parent_id');
        var tgl_dibentuk = $(this).data('tgl_dibentuk');

        $('#id').val(ids);
        $('#kode_unit').val(kode_unit);
        $('#name').val(name);

        if (parent_id != 0) {
            $('#parent_id').val(parent_id).trigger('change');
        } else {
            $('#parent_id').val('').trigger('change');
        }
        $('#tgl_dibentuk').val(tgl_dibentuk);
    });

    // Sintak Update
    $(document).on('click', '#edit_offer', function(e) {
        e.preventDefault();
        var form = $('form')[0];
        var formData = new FormData(form);
        var ids = $('#id').val();
        $('.progress').fadeIn();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/edit-keluarga/' + ids,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('.progress').fadeOut();
                    swal("Sukses!", data.msg, {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                        timer: 2000
                    });
                    $('#form_tambah').slideUp();
                    clearFormUnit();
                    $('#tableUsers').DataTable().ajax.reload();
                } else {
                    swal("Gagal!", data['message'], {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                        timer: 2000
                    });
                }
            },
            error: function(data) {
                var errors = data.responseJSON;

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
    });

    // Sintak Untuk Tambah Data
    function uploadDataUnit(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // xhr: function() {
            // 	var myXhr = $.ajaxSettings.xhr();
            // 	if(myXhr.upload){
            // 		myXhr.upload.addEventListener('progress',progress, false);
            // 	}
            // 	return myXhr;
            // },
            type: "POST",
            url: "{{ url('keluargas') }}",
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
                    clearFormUnit();
                    $('#tableUnit').DataTable().ajax.reload();
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
    $("#formKeluarga").validate({
        rules: {
            kode_unit: {
                required: true,
                maxlength: 255
            },
            name: {
                required: true,
                maxlength: 255,
            },
            tgl_keluar: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Error! Nama Unit tidak boleh kosong",
                maxlength: "Error! max 255 character"
            },
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            uploadDataUnit(formData);
            return false;
        }
    });
</script>