<script type="text/javascript" src="{{ asset('assets/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        //halaman Unit
        $('.select2').select2();

        $('.date').datepicker({
            format: 'dd-mm-yyyy'
        });

        $('#form_tambah').hide();

        $('#tableKeluarga').DataTable({
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
                'url': "{{ url('api/keluargajson') }}",
                'error': function(resp) {
                    console.log(resp);
                }
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
                data: 'nokk',
                name: 'nokk'
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
        let provinceSelect = function(province_id) {
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
                }).val(province_id).trigger('change');

            }
            //load Province
        provinceSelect();


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
                    let range = [];

                    for (let i = 0; i < response.length; i++) {
                        let option = {
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
                    let range = [];

                    for (let i = 0; i < response.length; i++) {
                        let option = {
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
                    let range = [];

                    for (let i = 0; i < response.length; i++) {
                        let option = {
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
                    let range = [];
                    for (let i = 0; i < response.length; i++) {
                        let option = {
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


        function clearFormKeluarga() {
            $('#id').val('');
            $('#unit_id').val('');
            $('#name').val('');
            $('#parent_id').val('').trigger('change');
            $('#tgl_dibentuk').val('');
        }

        //Tombol Cancel
        $('#cancel').click(function() {
            clearFormKeluarga();
        });

        // Sintak Menampilkan Data Untuk Edit
        $(document).on('click', '.editoffer', function() {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            $('#form_tambah').slideDown();
            $('#tambah_unit').attr('id', 'edit_offer').text('UPDATE');

            let ids = $(this).data('ids');
            $('#id').val(ids);

            $.get('api/keluargas/' + ids, function(res) {
                let data = res.results;
                $('#nokk').val(data.nokk);
                $('#jk').val(data.jk);
                $('#noktp').val(data.noktp);
                $('#tgl_keluar').val(data.tgl_keluar);
                $('#tempat_lahir').val(data.tempat_lahir);
                $('#tgl_lahir').val(data.tgl_lahir);
                $('#name').val(data.name);
                $('#unit_id').val(data.unit_id);
                $('#alamat').val(data.alamat);
                $('#rt').val(data.rt);
                $('#rw').val(data.rw);
                $('#kodepos').val(data.kodepos);
                $('#status_nikah').val(data.status_nikah).trigger('change');
                $('#agama').val(data.agama).trigger('change');

                // provinceSelect(res.province_id);
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
                }).val(data.province_id).trigger('change');

                $('#jk').prop('checked',data.jk);
                // $('#district_id').val(data.district_id);
                // $('#village_id').val(data.village_id);
                $('#imgpreview').attr('src', 'storage/' +
                    data.fotokk).attr('width', '250px');
            });
        });

        // Sintak Update
        $(document).on('click', '#edit_offer', function(e) {
            e.preventDefault();
            let form = $('form')[0];
            let formData = new FormData(form);
            let ids = $('#id').val();
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
                        clearFormKeluarga();
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
                    let errors = data.responseJSON;

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

        // Sintak Untuk Tambah Data
        function uploadDataKeluarga(formdata) {
            $('.progress').fadeIn();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                xhr: function() {
                    let myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
                        myXhr.upload.addEventListener('progress', progress, false);
                    }
                    return myXhr;
                },
                type: "POST",
                url: "{{ url('api/keluargas') }}",
                dataType: "json",
                async: true,
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
                        clearFormKeluarga();
                        $('#tableKeluarga').DataTable().ajax.reload();
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
                    console.log(data);
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
        //VALIDATE USER EMAIL
        $(':input[name="uAcc"]').rules("add", {
            "remote": {
                url: 'validateEmail.php',
                type: "post",
                data: {
                    emails: function() {
                        return $('#register-form :input[name="email"]').val();
                    }
                }
            }
        });

        $('#fotokk').on('change', function() {
            filePreview(this, 'imgpreview', '250px');
        });

        $("#formKeluarga").validate({
            rules: {
                nokk: {
                    required: true,
                    maxlength: 255,

                },
                tempat_lahir: {
                    required: true,
                },
                tgl_lahir: {
                    required: true
                },
                alamat: {
                    required: true,
                },
                noktp: {
                    required: true,
                },
                name: {
                    required: true,
                    maxlength: 255,
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
                tgl_keluar: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Error! Nama Kepala Keluarga tidak boleh kosong",
                    maxlength: "Error! max 255 character"
                },
            },
            submitHandler: function(form) {
                let formData = new FormData(form);
                uploadDataKeluarga(formData);
                return false;
            }
        });
    });
</script>
