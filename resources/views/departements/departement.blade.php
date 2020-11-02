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
        <form id="formDepartement" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="form-group row">
                    <input type="hidden" name="id" id="id">
                    <label class="col-sm-2 col-form-label">Kode <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                            name="kode" id="kode"  placeholder="Isikan Kode" maxlength="20">
                        <span id="text-danger">{{ $errors->first('kode') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Departement <span>*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" id="name"  placeholder="Nama Departement" maxlength="100">
                        <span id="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Induk ke<span>*</span></label>
                    <div class="col-sm-4">
                        <select name="parent_id" id="parent_id" data-placeholder="Induk Departement" class="form-control">
                            <option value="">--Pilih Departement--</option>
                        </select>

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
            <input type="button" class="btn btn-success" id="show_form_dept" value="TAMBAH">
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
                <table id="tableDepartement" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Check</th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Induk</th>
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
@include('departements.scriptdepartement')
@endsection
