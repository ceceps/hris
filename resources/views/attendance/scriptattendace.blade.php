<script type="text/javascript" src="{{ asset('assets/pages/bootstrap-autocomplete.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/jquery.inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/autoNumeric.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/form-mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script>
    $('.select2').select2();

    $('#time1').datetimepicker({
        format: 'HH:mm',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    $('#time2').datetimepicker({
        format: 'HH:mm',
        useCurrent: false, //Important! See issue #1075
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar-check-o",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    $('#tgl').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar-check-o",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"

        }
    });

    $('.basicAutoComplete').autoComplete({
        resolver: 'custom',
        events: {
            search: function(qry, callback) {
                // let's do a custom ajax call
                $.ajax("/api/employees", {
                        data: {
                            'q': qry
                        }
                    }
                ).done(function(res) {
                    callback(res.results);
                });
            }
        },
        minLength: 1
    });

    $('.basicAutoComplete').on('autocomplete.select', function(evt, item) {
        $('#departement').val(item.departement);
        $('#person_id').val(item.person_id);
    });

    function onSelectItem(item, element) {
        $('#output').html(
            'Element <b>' + $(element).attr('id') + '</b> was selected<br/>' +
            '<b>Value:</b> ' + item.value + ' - <b>Label:</b> ' + item.label
        );
    }

    $('#tableAttendace').DataTable({
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
            'url': "{{ url('api/attendancesjson') }}",
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
            data: 'departement',
            name: 'departement'
        }, {
            data: 'shift',
            name: 'shift'
        }, {
            data: 'date',
            name: 'date'
        }, {
            data: 'checkin',
            name: 'checkin'
        }, {
            data: 'checkout',
            name: 'checkout'
        }, {
            data: 'leave_type',
            name: 'leave_type'
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

    function clearFormAttendance() {
        $('#id').val('');
        $('#name').val('');
        $('#person_id').val('');
        $('#departement').val('');
        $('#date').val('');
        $('#checkin').val('');
        $('#checkout').val('');
        $('#leave_type').val('').trigger('change');
    }

    //Tombol Cancel
    $('#cancel').click(function() {
        clearFormAttendance();
        $('#form_tambah').slideUp();
    });
    $('#cancel_manual').click(function() {
        clearFormAttendance();
        $('#form_tambah_manual').slideUp();
    });

    //Sintak ADD
    $('#show_form').click(function() {
        $('#edit_offer').attr('id', 'tambah_offer').text('Add');
        $('#form_tambah').slideDown();
        $('#form_tambah_manual').slideUp();
    });

    $('#show_form_manual').click(function() {
        $('#edit_offer_manual').attr('id', 'tambah_offer_manual').text('SIMPAN');
        $('#form_tambah').slideUp();
        $('#form_tambah_manual').slideDown();
    });

    function uploadData(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ url('attendances-import') }}",
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
                                className: 'btn btn-sm btn-success'
                            }
                        },
                        timer: 2000
                    });
                    $('#form_tambah').fadeOut();
                    clearFormAttendance();
                    $('#tableAttendace').DataTable().ajax.reload();
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

    function uploadDataManual(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ url('attendances') }}",
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
                                className: 'btn btn-sm btn-success'
                            }
                        },
                        timer: 2000
                    });
                    $('#form_tambah_manual').fadeOut();
                    clearFormAttendance();
                    $('#tableAttendace').DataTable().ajax.reload();
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
    $("#formAttendance").validate({
        rules: {
            file: {
                required: true,
            },
        },
        submitHandler: function(form) {
            let formData = new FormData(form);
            uploadData(formData);
            return false;
        }
    });

    $("#formAttendanceManual").validate({
        rules: {
            name: {
                required: true,
            },
            date: {
                required: true,
            },
            checkin: {
                required: true,
            },
            checkout: {
                required: true,
            },

        },
        submitHandler: function(form) {
            let formData = new FormData(form);

            uploadDataManual(formData);
            return false;
        }
    });

    // Sintak Menampilkan Data Untuk Edit
    $(document).on('click', '.editoffer', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        $('#form_tambah_manual').slideDown();
        $('#form_tambah').slideUp();
        $('#tambah_offer_manual').attr('id', 'edit_offer_manual').text('UPDATE');
        var ids = $(this).data('ids');

        $('#id').val(ids);

        $.get('attendances/' + ids, function(res) {
            if (typeof res === 'object') {
                $('#person_id').val(res.results.person_id);
                $('#name').val(res.results.name);
                $('#departement').val(res.results.departement);
                $('#date').val(res.results.date);
                $('#checkin').val(res.results.checkin);
                $('#checkout').val(res.results.checkout);
                $('#leave_type').val(res.results.leave_type).trigger('change');
            }

        });

    });

    // Sintak Update
    $(document).on('click', '#edit_offer_manual', function(e) {
        e.preventDefault();
        var form = $('form#formAttendanceManual')[0];
        var formData = new FormData(form);
        formData.push = {
            _method: 'PUT'
        };

        var ids = $('#id').val();
        //var $fileUpload = $("input[type='file']");
        $('.progress').fadeIn();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH'
            },
            url: 'attendances/' + ids,
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
                    clearFormAttendance();
                    $('#form_tambah_manual').slideUp();
                    $('#tableAttendace').DataTable().ajax.reload();
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
    });
</script>
