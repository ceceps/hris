@extends('layouts.app')
@section('konten')
<div class="col-sm-12" style="display:none;" id="form_tambah">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $judul??'' }}</h5>
            <span></span>
        </div>
        <div class="card-block">
            <div id="res_message"></div>
            <form id="formPayroll" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="form-group row">
                    <input type="hidden" name="id" id="id">
                    <label class="col-sm-2 col-form-label">Nama Pegawai <span>*</span></label>
                    <div class="col-sm-3">
                        <input type="hidden" name="employee_id"  id="employee_id" >
                        <input type="text" class="form-control basicAutoComplete"
                            name="name" id="name"  placeholder="Cari Nama Pegawai" maxlength="100">
                        <span id="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <label class="col-sm-1 col-form-label">Jabatan</label>
                    <div class="col-sm-2">
                        <input type="hidden" name="job_id" id="job_id">
                        <input type="hidden" name="uang_pokok" id="uang_pokok">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="job_name" id="job_name"  readonly>
                    </div>
                    <label class="col-sm-1 col-form-label">Level </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="job_level" id="job_level"  readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Grade </label>
                    <div class="col-sm-2">
                        <input type="text" name="grade" id="grade" class="form-control" readonly>
                    </div>
                    <label class="col-sm-2 col-form-label">Salary Role</label>
                    <div class="col-sm-2">
                        <input type="text" name="salary_role" id="salary_role" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Periode Payroll </label>
                    <div class="col-sm-2">
                        <div class='input-group date' id='tgl_from'>
                            <input type="text" name="periode_from" class="form-control " id="periode_from"  data-date-format="DD-MM-YYYY">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-sm-1 col-form-label">s/d </label>
                    <div class="col-sm-2">
                        <div class='input-group date' id='tgl_to'>
                            <input type="text" name="periode_to" class="form-control " id="periode_to"  data-date-format="DD-MM-YYYY">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                        </div>
                    </div>
                    {{-- <label class="col-sm-2 col-form-label">Kehadiran </label>
                    <div class="col-sm-2">
                        <input type="text" name="jum_hadir" id="jum_hadir" class="form-control" readonly>
                    </div> --}}
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Tunjangan Keluarga</label>
                    <div class="col-sm-4">
                        <input type="text" name="tunj_keluarga" id="tunj_keluarga" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                    </div>
                    <label class="col-sm-2">Tunjangan Hari Tua</label>
                    <div class="col-sm-4">
                        <input type="text" name="tunj_haritua" id="tunj_haritua" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Tunjangan Kesehatan</label>
                    <div class="col-sm-4">
                        <input type="text" name="tunj_kesehatan" id="tunj_kesehatan" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                    </div>
                    <label class="col-sm-2">Tunjangan Keselamatan</label>
                    <div class="col-sm-4">
                        <input type="text" name="tunj_keselamatan" id="tunj_keselamatan" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Tunjangan Kecelakaan</label>
                    <div class="col-sm-4">
                        <input type="text" name="tunj_kecelakaan" id="tunj_kecelakaan" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                    </div>
                    <label class="col-sm-2">Tunjangan Hari Raya</label>
                    <div class="col-sm-4">
                        <input type="text" name="tunj_hari_raya" id="tunj_hari_raya" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Bonus</label>
                    <div class="col-sm-4">
                        <input type="text" name="bonus" id="bonus" class="form-control autonumber"  data-a-sep="." data-a-dec=",">
                    </div>
                    <label class="col-sm-2">Potongan Listrik</label>
                    <div class="col-sm-4">
                        <input type="text" name="potongan_listrik" id="potongan_listrik" class="form-control autonumber"  data-a-sep="." data-a-dec=",">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Potongan Belanja</label>
                    <div class="col-sm-4">
                        <input type="text" name="potongan_belanja" id="potongan_belanja" class="form-control autonumber"  data-a-sep="." data-a-dec=",">
                    </div>
                    <label class="col-sm-2">Potongan Koperasi</label>
                    <div class="col-sm-4">
                        <input type="text" name="potongan_koperasi" id="potongan_koperasi" class="form-control autonumber"  data-a-sep="." data-a-dec=",">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Potongan Lain-lain</label>
                    <div class="col-sm-4">
                        <input type="text" name="potongan_lain" id="potongan_lain" class="form-control autonumber"  data-a-sep="." data-a-dec=",">
                    </div>
                    <label class="col-sm-2">Gaji Kotor</label>
                    <div class="col-sm-4">
                        <input type="text" name="gaji_kotor" id="gaji_kotor" class="form-control autonumber"  data-a-sep="." data-a-dec="," readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2">Total Gaji</label>
                    <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon2">Rp.</span>
                        <input type="text" name="total_upah" id="total_upah" class="form-control autonumber"  data-a-sep="." data-a-dec="," readonly>
                    </div>
                        

                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0" id="tambah_offer">
                            <i class="feather icon-save"></i> SIMPAN
                        </button>
                        <a class="btn btn-info" style="color:white" id="cancel">BATAL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-block">
            Check All
            <input type="checkbox" class="form-controll" name="checkAll" id="checkAll" />
            &nbsp;
            <input type="submit" class="btn btn-danger" id="hapus_data" value="HAPUS">
            <input type="button" class="btn btn-success" id="show_form_payroll" value="TAMBAH">
        </div>
    </div>
</div>

<div class="col-sm-12">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $judul }}</h5>
            <span></span>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="tablePayroll" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Check</th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Periode</th>
                            <th>Total Gaji</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
   @include('payrolls.scriptpayroll')
@endsection
