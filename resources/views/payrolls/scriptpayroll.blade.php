<script type="text/javascript" src="{{ asset('assets/pages/bootstrap-autocomplete.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/jquery.inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/autoNumeric.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/pages/form-masking/form-mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/accounting.js') }}"></script>
<script>
    //set tgl hari ini
    let date = new Date();
      let dd = date.getDate();
      let mm = date.getMonth()+1; //January is 0!
      let yyyy = date.getFullYear();
      var firstDay =  new Date(date.getFullYear(), date.getMonth(), 1);
      var lastDay =  new Date(date.getFullYear(), date.getMonth() + 1, 0);

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
        $('#employee_id').val(item.id);
        $('#job_id').val(item.job_id);
        $('#job_name').val(item.job_name);
        $('#job_level_id').val(item.job_level_id);
        $('#job_level').val(item.job_level);
        $('#grade').val(item.grade);
        $('#salary_role').val(item.salary_role);
        $('#uang_pokok').val(item.salary_role);
    });

    $('#tgl_from').datetimepicker({
        defaultDate:  firstDay,
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

    $('#tgl_to').datetimepicker({
        defaultDate: lastDay,
        useCurrent: false,
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

    $("#tgl_from").on("dp.change", function (e) {
           $('#tgl_to').data("DateTimePicker").minDate(e.date);
    });

    $("#tgl_to").on("dp.change", function (e) {
           $('#tgl_from').data("DateTimePicker").maxDate(e.date);
    });

    $('#tablePayroll').DataTable({
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
            'url': "{{ url('payrolljson') }}",
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
            data: 'employee.name',
            name: 'employee.name'
        },
        {
            data: 'periode',
            name: 'periode'
        },
        {
            data: 'total_upah',
            name: 'total_upah'
        },
        {
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

    function clearFormPayroll() {
        $('input:hidden').val('');
        $('input:text').val('');
    }

    //Tombol Cancel
    $('#cancel').click(function() {
        clearFormPayroll();
    });

    //Sintak ADD
    $('#show_form_payroll').click(function() {
        $('#edit_offer').attr('id', 'tambah_offer').text('Add');
        $('#form_tambah').slideToggle();
    });

    function uploadData(formdata) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ url('payrolls') }}",
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
                    clearFormPayroll();
                    $('#tableJob').DataTable().ajax.reload();
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

    //menghitung gaji


    function countPayroll(){
      let tunj_keluarga = realNumber($('#tunj_keluarga').val());

      let tunj_haritua = realNumber($('#tunj_haritua').val());
      let tunj_kesehatan = realNumber($('#tunj_kesehatan').val());
      let tunj_keselamatan = realNumber($('#tunj_keselamatan').val());
      let tunj_kecelakaan = realNumber($('#tunj_kecelakaan').val());
      let tunj_hari_raya = realNumber($('#tunj_hari_raya').val());
      let bonus = realNumber($('#bonus').val());

      let potongan_listrik = realNumber($('#potongan_listrik').val());
      let potongan_belanja = realNumber($('#potongan_belanja').val());
      let potongan_koperasi = realNumber($('#potongan_koperasi').val());
      let potongan_lain = realNumber($('#potongan_lain').val());

      let gapok = $('#salary_role').val();
      gapok = gapok.split('.').join("");
      let gaji_kotor = parseInt(gapok) + parseInt(tunj_keluarga) + parseInt(tunj_haritua) + parseInt(tunj_kesehatan) + parseInt(tunj_kecelakaan) + parseInt(tunj_hari_raya) + parseInt(bonus);
      let tot_potongan = parseInt(potongan_listrik) +  parseInt(potongan_belanja) +  parseInt(potongan_koperasi) +  parseInt(potongan_lain);

      let tot_gaji = parseInt(gaji_kotor) - parseInt(tot_potongan);

      let gakot = accounting.formatNumber(gaji_kotor,0,'.');
      let totgaji = accounting.formatNumber(tot_gaji,0,'.');

      $('#uang_pokok').val(gapok);
      $('#gaji_kotor').val(gakot);
      $('#total_upah').val(totgaji);
    }

     $('#tunj_keluarga').on('change',function(){
        countPayroll();
     });

     $('#tunj_haritua').on('change',function(){
        countPayroll();
     });

     $('#tunj_kecelakaan').on('change',function(){
        countPayroll();
     });

     $('#tunj_kesehatan').on('change',function(){
        countPayroll();
     });

     $('#tunj_keselamatan').on('change',function(){
        countPayroll();
     });

     $('#bonus').on('change',function(){
        countPayroll();
     });

     $('#potongan_listrik').on('change',function(){
        countPayroll();
     });

     $('#potongan_belanja').on('change',function(){
        countPayroll();
     });

     $('#potongan_koperasi').on('change',function(){
        countPayroll();
     });

     $('#potongan_lain').on('change',function(){
        countPayroll();
     });


    // Sintak Validasi
    $("#formPayroll").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
            },
        },
        messages: {
            name: {
                required: "Error! Nama Pegawai tidak boleh kosong",
                maxlength: "Error! max 255 character"
            },
        },
        submitHandler: function(form) {
            //
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
        var ids = $(this).data('ids');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var active = $(this).data('active');

        $('#id').val(ids);
        $('#name').val(name);
        $('#email').val(email);
        $('#active').val(active);
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
        //var $fileUpload = $("input[type='file']");
        $('.progress').fadeIn();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PATCH'
            },
            url: 'api/jobs/' + ids,
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
                    clearFormPayroll();
                    $('#form_tambah').slideUp();
                    $('#tableJob').DataTable().ajax.reload();
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
                var errorsHtml = '';
                if(typeof errors.errors == 'object'){
                    $.each(errors.errors, function(key, value) {
                       errorsHtml += value[0] + '\n';
                    });
                }else{
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
    });
</script>
