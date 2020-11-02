@extends('layouts.app')

@section('konten')
<div class="col-sm-12" style="display:none;" id="form_tambah">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $judul }}</h5>
            <span></span>
        </div>
        <div class="card-block">
            <div id="res_message"></div>
            <form id="formUser" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <label class="col-sm-2 col-form-label">Nama <span>*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Masukkan Nama Pengguna" maxlength="100">
                        <span id="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email<span>*</span></label>
                    <div class="col-sm-10">
                        <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" maxlength="100"
                            class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            placeholder="Masukkan Email">
                        <span id="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password<span>*</span></label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Buat Password Anda">
                        <span id="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="col-sm-5">
                        <input type="password" class="form-control @error('confirm') is-invalid @enderror"
                            id="confirm" name="confirm" placeholder="Confirm Password Anda">
                        <span id="text-danger">{{ $errors->first('confirm') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status <span>*</span></label>
                    <div class="col-sm-3">
                        <input type="checkbox" name="active" class="js-switch" checked />
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0" id="tambah_offer">
                            <i class="feather icon-save"></i> SIMPAN
                        </button>
                        <a class="remove btn btn-danger text-default" style="display:none;">RESET FILE</a>
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
            <input type="button" class="btn btn-success" id="show_form_user" value="TAMBAH">
            <button id="status_tolak" class="btn btn-warning" value="false">Not Active</button>
            <button id="status_aktiv" class="btn btn-primary" value="true">Active</button>

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
                <table id="tableUsers" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Check</th>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
@include('user.scriptsusers')
@endsection
