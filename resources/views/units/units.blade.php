@extends('layouts.app')
@section('konten')
<style>
    .highlight {
        padding: 1rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        background-color: #f8f9fa
    }

    .highlight pre {
        padding: 0;
        margin-top: 0;
        margin-bottom: 0;
        background-color: transparent;
        border: 0
    }

    .highlight pre code {
        font-size: inherit
    }
</style>
<div class="col-sm-12" id="form_tambah">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $judul }}</h5>
            <span></span>
        </div>
        <div class="card-block">
            <div id="res_message"></div>
            <form id="formUnit" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <label class="col-sm-2 col-form-label">Kode Unit <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="kode_unit" name="kode_unit"
                            placeholder="Masukkan Kode Unit" maxlength="20"
                            class="form-control @error('kode_unit') is-invalid @enderror">
                        <span id="text-danger">{{ $errors->first('kode_unit') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name Unit <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Masukkan Nama Unit" maxlength="50">
                        <span id="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Unit Induk <span>*</span></label>
                    <div class="col-sm-4">
                        <select name="parent_id" id="parent_id" class="form-control" data-placeholder="Induk Unit">
                        <option value=""></option>
                         {!! $optionUnit !!}
                        </select>
                    </div>
                    <!-- end -->
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tgl Dibentuk </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control date @error('tgl_dibentuk') is-invalid @enderror"
                            id="tgl_dibentuk" name="tgl_dibentuk">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0" id="tambah_unit">
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
            <input type="submit" class="btn btn-danger" id="hapus_data" value="DELETE">
            <input type="button" class="btn btn-success" id="show_form_unit" value="TAMBAH">
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
                <table id="tableUnit" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detil</th>
                            <th>Check</th>
                            <th>No</th>
                            <th>Kode Unit</th>
                            <th>Nama Unit</th>
                            <th>Parent Unit</th>
                            <th>Tgl Dibentuk</th>
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
@include('units.scriptunit')
@endsection
