<script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/jquery.inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/autoNumeric.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/form-mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/bower_components/switchery/js/switchery.min.js') }}"></script>

<script>
    //halaman Unit
    $('.select2').select2();

    function loadSelect() {
        loadOptionParent('api/departements', 'departement_id');
        loadOptionParent('api/jobs', 'job_id');
        loadOptionParent('api/joblevels', 'job_level_id');
        loadOptionParent('api/categories', 'category_id');
        loadOptionParent('api/banks', 'bank_id');

    }


    $('#foto').on('change', function() {
        filePreview(this, 'imgfoto', '128px');
    });
    $('#foto_ktp').on('change', function() {
        filePreview(this, 'imgpreview', '250px');
    });

    // $('.date').datepicker({
    //     format: 'dd-mm-yyyy'
    // });

    $('#tgl').datetimepicker({
        icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
    });

    $('#tgl_join').datetimepicker({
        icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
    });
    $('#tgl_resign').datetimepicker({
        icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
    });
    $('#form_tambah').hide();

    $('#tableEmployee').DataTable({
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
            'url': "{{ url('api/employeejson') }}",
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
            name: 'check',
            width: '20px'
        }, {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        }, {
            data: 'foto',
            name: 'foto',
            render: function(data, type, row) {
                return "<img src='" + row.foto + "' width='50' height='50'/>";
            }
        }, {
            data: 'nik',
            name: 'nik'
        }, {
            data: 'name',
            name: 'name'
        }, {
            data: 'job',
            name: 'job'
        }, {
            data: 'joblevel',
            name: 'joblevel'
        }, {
            data: 'departement',
            name: 'departement'
        }, {
            data: 'link',
            name: 'link'
        }, ],
        "columnDefs": [
            // membuat tidak dapat di search dan sorting
            {
                "searchable": false,
                "orderable": false,
                "targets": [0, 1, 2, 3, 9]
            },
        ],
    });

    //select chain

    let city = $('#city_id').select2({
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
        clearFormEmployee();
        loadSelect();
        loadOptionParent('api/province', 'province_id');
        $('#form_tambah').slideToggle();

    });


    function clearFormEmployee() {
        $('input:hidden').val('');
        $('input:file').val('');
        $('#email').val('');
        $('input:text').val('');
        $('#pria').val('M');
        $('#wanita').val('F');
        $('select').val('').trigger('change');
        let imgdumy = "{!! asset('assets/images/noimage.png') !!}";
        $('img#imgfoto').attr('src', imgdumy).attr('width', '128px');
        $('img#imgpreview').attr('src', imgdumy).attr('width', '128px');
    }

    //Tombol Cancel
    $('#cancel').click(function() {
        clearFormEmployee();
    });

    // Sintak Menampilkan Data Untuk Edit
    $(document).on('click', '.editoffer', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        $('#form_tambah').slideDown();
        $('#tambah_offer').attr('id', 'edit_offer').text('UPDATE');

        var ids = $(this).data('ids');
        var alamat_house_id = $(this).data('alamat_house_id');
        var foto = $(this).data('foto');
        var fotoktp = $(this).data('fotoktp');

        console.log(fotoktp);

        $('#id').val(ids);
        $('#alamat_house_id').val(alamat_house_id);
        $('#imgfoto').attr('src', foto).attr('width', '128px');
        $('#imgpreview').attr('src', fotoktp).attr('width', '250px');
        $.get('api/employees/' + ids, function(data) {

            $('#name').val(data.results.name);
            $('#nik').val(data.results.nik);
            $('#noktp').val(data.results.noktp);
            $('#bank_account').val(data.results.bank_account);
            $('#birthday').val(data.results.birthday);
            $('#place_birth').val(data.results.place_birth);
            $('#bpjs_kesehatan').val(data.results.bpjs_kesehatan);
            $('#bpjs_tenagakerja').val(data.results.bpjs_tenagakerja);

            $('#education').val(data.results.education).trigger('change');
            $('#email').val(data.results.email);

            if (data.results.gender == 'M') {
                $('#pria').prop('checked', true);
            } else {
                $('#wanita').prop('checked', true);
            }

            $('#grade').val(data.results.grade);
            $('#is_wafat').val(data.results.is_wafat);
            $('#jurnal_id').val(data.results.jurnal_id);
            $('#join_date').val(data.results.join_date);
            $('#resign_date').val(data.results.resign_date);
            $('#marital').val(data.results.marital).trigger('change');
            $('#mobile_phone').val(data.results.mobile_phone);
            $('#work_phone').val(data.results.work_phone);
            $('#ptkp_id').val(data.results.naptkp_idme);
            $('#salary_role').val(data.results.salary_role);
            $('#address').val(data.results.address_home.address);
            $('#postalcode').val(data.results.address_home.postalcode);
            $('#attendance_id').val(data.results.attendance_id);

            $('#religion').val(data.results.religion).trigger('change');
            $('#status').val(data.results.status).trigger('change');
            $('#bank_id').val(data.results.bank_id).trigger('change');

            let idprov = data.results.address_home.province_id;
            let idcity = data.results.address_home.city_id;
            let iddistrict = data.results.address_home.district_id;
            let idvillage = data.results.address_home.village_id;

            let catId = data.results.category_id;
            let depId = data.results.departement_id;
            let jobId = data.results.job_id;
            let jobLevelId = data.results.job_level_id;

            loadOptionParent('api/banks', 'bank_id', data.results.bank_id);
            loadOptionParent('api/jobs', 'job_id', jobId);
            loadOptionParent('api/joblevels', 'job_level_id', jobLevelId);
            loadOptionParent('api/departements', 'departement_id', depId);
            loadOptionParent('api/categories', 'category_id', catId);

            loadOptionParent('api/province', 'province_id', idprov);
            loadOptionParent('api/cities/' + idprov, 'city_id', idcity);
            loadOptionParent('api/districts/' + idcity, 'district_id', iddistrict);
            loadOptionParent('api/villages/' + iddistrict, 'village_id', idvillage);

        });
    });

    // Sintak Update
    $(document).on('click', '#edit_offer', function(e) {
        e.preventDefault();
        var form = $('form')[0];
        var formData = new FormData(form);
        formData.push = {
            _method: 'PUT'
        };
        var ids = $('#id').val();
        $('.progress').fadeIn();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH'
            },
            url: '/employees/' + ids,
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
                    $('#form_tambah').fadeOut();
                    clearFormEmployee();
                    $('#tableEmployee').DataTable().ajax.reload();
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
    function uploadDataEmployee(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', progress, false);
                }
                return myXhr;
            },
            type: "POST",
            url: "{{ url('employees') }}",
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
                    clearFormEmployee();
                    $('#tableEmployee').DataTable().ajax.reload();
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
                console.log(errors.errors.length);
                var errorsHtml = '';
                if (typeof errors.errors === 'object') {
                    $.each(errors.errors, function(key, value) {
                        errorsHtml += value[0] + '\n';
                    });
                } else {
                    errorsHtml += errors.errors;
                }

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
    $("#formEmployee").validate({
        rules: {
            nik: {
                required: true,
                maxlength: 20
            },
            noktp: {
                required: true,
                maxlength: 20
            },
            attendance_id: {
                required: true,
            },
            province_id: {
                required: true,
            },
            city_id: {
                required: true,
            },
            district_id: {
                required: true,
            },
            category_id: {
                required: true,
            },
            grade: {
                required: true,
            },
            job_id: {
                required: true,
            },
            job_level_id: {
                required: true,
            },
            name: {
                required: true,
                maxlength: 255,
            },
            birthday: {
                required: true
            },
            place_birth: {
                required: true
            },
            postalcode: {
                required: true
            },
            address: {
                required: true
            },

        },
        messages: {
            name: {
                required: "Error! Nama Employee tidak boleh kosong",
                maxlength: "Error! max 255 character"
            },
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            uploadDataEmployee(formData);
            return false;
        }
    });
</script>
</script>
