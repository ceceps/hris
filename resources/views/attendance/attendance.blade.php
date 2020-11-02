@extends('layouts.app')
@section('pagestyle')
<link rel="stylesheet" href="{{ asset('assets/js/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css') }}">

@endsection
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
            <form id="formAttendance" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Upload File Attendace <span>*</span></label>
                    <div class="col-sm-9">
                        <input type="file" name="file" class="form-control" id="customFile">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0" id="tambah_offer">
                            <i class="feather icon-save"></i> UPLOAD
                        </button>
                        <a class="btn btn-info" style="color:white" id="cancel">BATAL</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-sm-12" style="display:none;" id="form_tambah_manual">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $judul.' Input Manual'??'' }}</h5>
            <span></span>
        </div>
        <div class="card-block">
            <div id="res_message"></div>
            <form id="formAttendanceManual" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="form-group row">
                    <input type="hidden" name="id" id="id">
                    <label class="col-sm-2 col-form-label">Nama Pegawai <span>*</span></label>
                    <div class="col-sm-5">
                        <input type="text" name="name" class="form-control basicAutoComplete" id="name"
                            autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Department <span>*</span></label>
                    <div class="col-sm-5">
                        <input type="text" name="departement" id="departement" class="form-control" readonly>
                        <input type="hidden" name="person_id" id="person_id">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tgl <span>*</span></label>
                    <div class="col-sm-2">
                        <div class='input-group date' id='tgl' >
                            <input type="text" name="date" class="form-control " id="date"  data-date-format="DD-MM-YYYY">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-sm-1 col-form-label">Masuk <span>*</span></label>
                    <div class="col-sm-2">
                        <div class='input-group time' id='time1'>
                            <input type='text' class="form-control" name="checkin" id="checkin"/>
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                         </div>
                    </div>
                    <label class="col-sm-1 col-form-label">Keluar <span>*</span></label>
                    <div class="col-sm-2">
                        <div class='input-group time' id='time2'>
                            <input type='text' class="form-control" name="checkout" id="checkout" />
                            <span class="input-group-addon">
                                <span class="fa fa-clock-o"></span>
                            </span>
                         </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Absen</label>
                    <div class="col-sm-2">
                        <select name="leave_type" id="leave_type" class="form-control select2" data-placeholder="Jenis Absen">
                            <option value=""></option>
                            <option value="ijin">Ijin</option>
                            <option value="alpha">Alpha</option>
                            <option value="sakit">Sakit</option>
                            <option value="sdp">SDP</option>
                            <option value="cuti">Cuti</option>
                            <option value="half">Half Day</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0" id="tambah_offer_manual">
                            <i class="feather icon-save"></i> SIMPAN
                        </button>
                        <a class="btn btn-info" style="color:white" id="cancel_manual">BATAL</a>
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
            <input type="button" class="btn btn-success" id="show_form" value="UPLOAD">
            <input type="button" class="btn btn-primary" id="show_form_manual" value="TAMBAH MANUAL">
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
                <table id="tableAttendace" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Check</th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Departement</th>
                            <th>Shift</th>
                            <th>Date</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Absen Type</th>
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
@include('attendance.scriptattendace')
@endsection
