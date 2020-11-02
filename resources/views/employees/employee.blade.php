@extends('layouts.app')
@section('pagestyle')
<link rel="stylesheet" href="{{ asset('assets/bower_components/switchery/css/switchery.min.css') }}" />
@endsection

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
            <form id="formEmployee" novalidate="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="address_house_id" name="address_house_id">

                            <label class="col-sm-3 col-form-label">NO KTP <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control @error('noktp') is-invalid @enderror" id="noktp"
                                    name="noktp" placeholder="Masukkan No KTP" maxlength="30">
                                <span id="text-danger">{{ $errors->first('noktp') }}</span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control autokk @error('nik') is-invalid @enderror" id="nik"
                                    name="nik" placeholder="Masukkan NIK" maxlength="100">
                                <span id="text-danger">{{ $errors->first('nik') }}</span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ID Attendance <span>*</span></label>
                            <div class="col-sm-2">
                                <input type="text" name="attendance_id" id="attendance_id" placeholder="Isi ID sesuai Mesin Attendance" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Pegawai <span>*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="Masukkan Nama Pegawai" maxlength="100">
                                <span id="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat & Tgl Lahir<span>*</span></label>
                            <div class="col-sm-5">
                                <input type="tetx" maxlength="100"
                                    class="form-control @error('place_birth') is-invalid @enderror" id="place_birth"
                                    name="place_birth" placeholder="Isi Tempat Lahir" data-mask="99-99-9999">
                                <span id="text-danger">{{ $errors->first('place_birth') }}</span>
                            </div>
                            <div class="col-sm-4">
                                <div class='input-group date' id='tgl'>
                                    <input type="text" name="birthday" class="form-control" id="birthday"
                                        data-date-format="DD-MM-YYYY">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar-check-o"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin<span>*</span></label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender"  value="M" checked id="pria">
                                    Pria
                                  </label>
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender"  value="F" id="wanita">
                                    Wanita
                                  </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <input type="file" name="foto" id="foto"><br><br>
                        <img src="{{ asset('assets/images/noimage.jpg') }}" alt="Foto Profile" id="imgfoto">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat<span>*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" placeholder="Masukkan Alamat" maxlength="255" rows="5">
                        <span id="text-danger">{{ $errors->first('address') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="form-inline">
                            <input type="text" name="rt" id="rt" placeholder="RT" class="form-control col-sm-1">
                            <input type="text" name="rw" id="rw" placeholder="RW" class="form-control col-sm-1">
                            <input type="text" name="postalcode" id="postalcode" class="form-control col-sm-2"
                                placeholder="Postal Code">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <select name="province_id" id="province_id" data-placeholder="Provinsi"
                            class="form-control select2">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="city_id" id="city_id" data-placeholder="Kota"
                            class="form-control select2">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select name="district_id" id="district_id" data-placeholder="Kecamatan"
                            class="form-control select2">
                            <option value=""></option>
                        </select>
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
                    <label class="col-sm-2 col-form-label">Departement <span>*</span></label>
                    <div class="col-sm-3">
                        <select name="departement_id" id="departement_id" data-placeholder="Departement"
                            class="form-control select2">
                            <option value=""></option>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Pekerjaan <span>*</span></label>
                    <div class="col-sm-2">
                        <select name="job_id" id="job_id" data-placeholder="Jabatan"
                            class="form-control select2">
                            <option value=""></option>
                        </select>
                    </div>
                    <label class="col-sm-1 col-form-label">Level <span>*</span></label>
                    <div class="col-sm-2">
                        <select name="job_level_id" id="job_level_id" data-placeholder="Level" class="form-control select2">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Grade <span>*</span></label>
                    <div class="col-sm-2">
                        <input type="text" name="grade" id="grade" class="form-control" placeholder="Grade">
                    </div>
                    <label class="col-sm-1 col-form-label">Gaji <span>*</span></label>
                    <div class="col-sm-2">
                        <input type="text" name="salary_role" id="salary_role" class="form-control autonumber" data-a-sep="." data-a-dec="," placeholder="Gaji">

                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori <span>*</span></label>
                    <div class="col-sm-2">
                       <select name="category_id" id="category_id" class="form-control select2" data-placeholder="Kategory">
                           <option value=""></option>
                       </select>
                    </div>
                    <label class="col-sm-1 col-form-label">Status <span>*</span></label>
                    <div class="col-sm-2">
                       <select name="status" id="status" class="form-control select2" data-placeholder="Status Kerja">
                           <option value=""></option>
                           <option value="probetion">Percobaan</option>
                           <option value="contract">Kontrak</option>
                           <option value="permanent">Tetap</option>
                       </select>
                    </div>
                    <label class="col-sm-1 col-form-label">Agama</label>
                    <div class="col-sm-2">
                       <select name="religion" id="religion" class="form-control select2" data-placeholder="Agama">
                           <option value=""></option>
                           <option value="islam">Islam</option>
                           <option value="kristen">Kristen</option>
                           <option value="hindu">Hindu</option>
                           <option value="budha">Budha</option>
                       </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Perkawinan</label>
                    <div class="col-sm-2">
                        <select name="marital" id="marital" class="form-control select2" data-placeholder="Perkawinan">
                            <option value=""></option>
                            <option value="Single">Single</option>
                            <option value="Marriage">Menikah</option>
                            <option value="Widow">Janda</option>
                            <option value="Widower">Duda</option>
                        </select>
                    </div>
                    <label class="col-sm-2 col-form-label">Pendidikan <span>*</span></label>
                    <div class="col-sm-2">
                        <select name="education" id="education" class="form-control select2" data-placeholder="Pendidikan">
                            <option value=""></option>
                            <option value="S3">S3</option>
                            <option value="S2">S2</option>
                            <option value="S1">S1</option>
                            <option value="D4">D4</option>
                            <option value="D3">D3</option>
                            <option value="D1">D1</option>
                            <option value="SMU">SMU</option>
                            <option value="SMP">SMP</option>
                            <option value="SD">SD</option>
                            <option value="TAK SEKOLAH">TAK SEKOLAH</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email <span>*</span></label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Isi Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Work Phone</label>
                    <div class="col-sm-2">
                        <input type="text" name="work_phone" id="work_phone" class="form-control" data-mask="999999999999999">
                    </div>
                    <label class="col-sm-2 col-form-label">Mobile Phone</label>
                    <div class="col-sm-2">
                        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control" data-mask="999999999999999">
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. PTKP</label>
                    <div class="col-sm-2">
                        <input type="text" name="ptkp_id" id="ptkp_id" class="form-control">
                    </div>
                    <label class="col-sm-2 col-form-label">No. BPJS Tenaga Kerja</label>
                    <div class="col-sm-2">
                        <input type="text" name="bpjs_tenagakerja" id="bpjs_tenagakerja" class="form-control">
                    </div>
                    <label class="col-sm-2 col-form-label">No. BPJS Kesehatan</label>
                    <div class="col-sm-2">
                        <input type="text" name="bpjs_kesehatan" id="bpjs_kesehatan" class="form-control" >
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. Jurnal</label>
                    <div class="col-sm-2">
                        <input type="text" name="jurnal_id" id="jurnal_id" class="form-control">
                    </div>
                    <label class="col-sm-2 col-form-label">Nama Bank <span>*</span></label>
                    <div class="col-sm-2">
                        <select name="bank_id" id="bank_id" class="form-control select2" data-placeholder="Jenis Bank">
                            <option value=""></option>
                        </select>
                    </div>
                    <label class="col-sm-1 col-form-label">No. Rek <span>*</span></label>
                    <div class="col-sm-3">
                        <input type="text" name="bank_account" id="bank_account" class="form-control" placeholder="No. Rekening">
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tgl Gabung <span>*</span></label>
                    <div class="col-sm-2">
                        <div class='input-group date' id='tgl_join'>
                            <input type="text" name="join_date" class="form-control" id="join_date"
                                data-date-format="DD-MM-YYYY">
                            <span class="input-group-addon">
                                <span class="fa fa-calendar-check-o"></span>
                            </span>
                        </div>
                   </div>
                   <label class="col-sm-2 col-form-label">Tgl Resign</label>
                   <div class="col-sm-2">
                       <div class='input-group date' id='tgl_resign'>
                           <input type="text" name="resign_date" class="form-control" id="resign_date"
                               data-date-format="DD-MM-YYYY">
                           <span class="input-group-addon">
                               <span class="fa fa-calendar-check-o"></span>
                           </span>
                       </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto KTP</label>
                    <div class="col-sm-3">
                        <input type="file" name="foto_ktp" id="foto_ktp"><br><br>
                        <img src="{{ asset('assets/images/noimage.jpg') }}" alt="Foto KTP" id="imgpreview">
                    </div>
                    <label class="col-sm-1 col-form-label">Is Wafat</label>
                    <div class="col-sm-2">
                        <input type="checkbox" name="is_wafat" id="is_wafat" class="js-switch"  />
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
            <input type="button" class="btn btn-success" id="show_form_keluarga" value="TAMBAH">
        </div>
    </div>
</div>

<div class="col-sm-12">
    <!-- Zero config.table start -->
    <div class="card">
        <div class="card-header">
            <h5>{{ $judul??'' }}</h5>
            <span></span>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="tableEmployee" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>#</th>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIK</th>
                            <th>Nama Pegawai</th>
                            <th>Pekerjaan</th>
                            <th>Level</th>
                            <th>Dept</th>
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
@include('employees.scriptemployee')
@endsection
