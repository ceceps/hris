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
            <form id="formAnggota" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NO KTP <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('noktp') is-invalid @enderror" id="noktp"
                                    name="noktp" placeholder="Masukkan No KTP" maxlength="30">
                                <span id="text-danger">{{ $errors->first('noktp') }}</span>
                            </div>
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="keluarga_id" name="keluarga_id">
                            <input type="hidden" id="kartu_keluarga_id" name="kartu_keluarga_id">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No KK <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control autokk @error('nokk') is-invalid @enderror" id="nokk"
                                    name="nokk" placeholder="Masukkan No KK" maxlength="100">
                                <span id="text-danger">{{ $errors->first('nokk') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">No Anggota </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('noanggota') is-invalid @enderror" id="noanggota"
                                    name="noanggota" placeholder="Optional No Anggota" maxlength="30" disabled>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Anggota <span>*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama_kk"
                                    name="name" placeholder="Masukkan Nama Anggota" maxlength="100">
                                <span id="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <input type="file" name="foto" id="foto"><br><br>
                        <img src="{{ asset('assets/images/noimage.png') }}" alt="Foto Profile" id="imgpreview">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat & Tgl Lahir<span>*</span></label>
                    <div class="col-sm-4">
                        <input type="tetx" maxlength="100"
                            class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                            name="tempat_lahir" placeholder="Isi Tempat Lahir">
                        <span id="text-danger">{{ $errors->first('tempat_lahir') }}</span>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" maxlength="100"
                            class="form-control date @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                            name="tgl_lahir" placeholder="Isi Tgl Lahir">
                        <span id="text-danger">{{ $errors->first('tgl_lahir') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat <span>*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('noktp') is-invalid @enderror" id="alamat"
                            name="alamat" placeholder="Masukkan Alamat" maxlength="255" rows="5">
                        <span id="text-danger">{{ $errors->first('alamat') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <input type="text" name="rt" id="rt" placeholder="RT" class="form-control col-sm-1">
                            <input type="text" name="rw" id="rw" placeholder="RW" class="form-control col-sm-1">
                            <input type="text" name="kodepos" id="kodepos" class="form-control col-sm-2"
                                placeholder="Kodepos">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <select name="province_id" id="province_id" data-placeholder="Provinsi"
                            class="form-control select2"></select>
                    </div>
                    <div class="col-sm-4">
                        <select name="city_id" id="city_id" data-placeholder="Kota"
                            class="form-control select2"></select>
                    </div>
                    <div class="col-sm-3">
                        <select name="district_id" id="district_id" data-placeholder="Kecamatan"
                            class="form-control select2"></select>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-2"></label>
                    <div class="col-sm-3">
                        <select name="village_id" id="village_id" data-placeholder="Kelurahan"
                            class="form-control select2"></select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jabatan Keluarga <span>*</span></label>
                    <div class="col-sm-3">
                        <select name="jabatan_keluarga" id="jabatan_keluarga" data-placeholder="Jabatan"
                            class="form-control select2">
                            <option value=""></option>
                            <option value="kepala keluarga">Kepala Keluarga</option>
                            <option value="bapak">Bapak</option>
                            <option value="ibu">Ibu</option>
                            <option value="anak">Anak</option>
                        </select>
                    </div>
                    <label class="col-sm-1 col-form-label">Jabatan Unit <span>*</span></label>
                    <div class="col-sm-2">
                        <select name="jabatan_unit_id" id="jabatan_unit_id" data-placeholder="Jabatan Unit"
                            class="form-control select2">
                        </select>
                    </div>
                    <label class="col-sm-1 col-form-label">Unit <span>*</span></label>
                    <div class="col-sm-3">
                        <select name="unit_id" id="unit_id" data-placeholder="Unit" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto KTP & KK</label>
                    <div class="col-sm-3">
                        <input type="file" name="fotoktp" id="fotoktp"><br><br>
                        <img src="{{ asset('assets/images/noimage.png') }}" alt="Foto KTP" id="imgpreview">
                    </div>
                    <div class="col-sm-4">
                        <input type="file" name="fotokk" id="fotokk"><br><br>
                        <img src="{{ asset('assets/images/noimage.png') }}" alt="Foto kk" id="imgpreview">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0" id="tambah_offer">
                            <i class="feather icon-save"></i> SIMPAN
                        </button>
                        <a class="remove btn btn-danger text-default" style="display:none;">RESET FILE</a>
                        <a class="btn btn-info" style="color:white" id="cancel">Cancel</a>
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
            <input type="button" class="btn btn-success" id="show_form_keluarga" value="TAMBAH">
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
                <table id="tableAnggota" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Check</th>
                            <th>No</th>
                            <th>No KK</th>
                            <th>Nama Kepala Keluarga</th>
                            <th>Alamat</th>
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
@include('anggotas.scriptanggota')
@endsection
