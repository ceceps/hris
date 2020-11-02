<script>
    loadOptionParent('api/departements', 'parent_id');

    $('#tableDepartement').DataTable({
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
            'url': "{{ url('api/departementjson') }}",
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
            data: 'parent',
            name: 'parent'
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

    function clearformDepartement() {
        $('#id').val('');
        $('#kode').val('');
        $('#name').val('');
        $('#parent_id').val('');
    }

    //Tombol Cancel
    $('#cancel').click(function() {
        clearformDepartement();
    });

    //Sintak ADD
    $('#show_form_dept').click(function() {
        $('#edit_offer').attr('id', 'tambah_offer').text('TAMBAH');
        $('#form_tambah').slideToggle();
    });

    function uploadData(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ url('api/departements') }}",
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
                    clearformDepartement();
                    loadOptionParent('api/departements', 'parent_id');
                    $('#tableDepartement').DataTable().ajax.reload();
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
                let errors = data.responseJSON;
                console.log(errors);
                let errorsHtml = '';
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
    $("#formDepartement").validate({
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
    $(document).on('click', '.editoffer', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        $('#form_tambah').slideDown();
        $('#tambah_offer').attr('id', 'edit_offer').text('UPDATE');
        let ids = $(this).data('ids');
        let name = $(this).data('name');
        let kode = $(this).data('kode');
        let parent_id = $(this).data('parent_id');

        $('#id').val(ids);
        $('#name').val(name);
        $('#kode').val(kode);
        $('#parent_id').val(parent_id);
    });

    // Sintak Update
    $(document).on('click', '#edit_offer', function(e) {
        e.preventDefault();
        let form = $('form')[0];
        let formData = new FormData(form);
        formData.push = {
            _method: 'PUT'
        };
        let ids = $('#id').val();
        //let $fileUpload = $("input[type='file']");
        $('.progress').fadeIn();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH'
            },
            url: 'api/departements/' + ids,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function(data) {
                if (data.status == true) {
                    $('.progress').fadeOut();
                    swal("Sukses!", data['msg'], {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                        timer: 2000
                    });
                    clearformDepartement();
                    loadOptionParent('api/departements', 'parent_id');
                    $('#form_tambah').slideUp();
                    $('#tableDepartement').DataTable().ajax.reload();
                } else {
                    swal("Gagal!", data['msg'], {
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
                let errors = data.responseJSON;
                console.log(errors);
                let errorsHtml = '';
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
</script>
</script>