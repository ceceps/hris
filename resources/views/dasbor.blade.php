@extends('layouts.app')
@section('konten')
<!-- statustic-card start -->
<div class="row">
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5"> Total Pegawai</p>
                        <h4 class="m-b-0">{{ $totPegawai??0 }}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-users f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-green text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Total Pegawai Baru</p>
                        <h4 class="m-b-0">{{ $totPegawaiBaru??0 }}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-user-plus f-50 text-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-blue text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Total Pegawai Probetion</p>
                        <h4 class="m-b-0">{{ $totPegawaiProbetion??0 }}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-users f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-blue text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Total Pegawai Kontrak</p>
                        <h4 class="m-b-0">{{ $totPegawaiKontrak??0 }}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-users f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Total Pegawai Tetap</p>
                        <h4 class="m-b-0">{{ $totPegawaiTetap??0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-green text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Total User</p>
                        <h4 class="m-b-0">{{ $userTotal??0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Employee Habis Kontrak</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nama Pegawai</th>
                                <th>Department</th>
                                <th>Tgl Habis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label class="label label-success">open</label></td>
                                <td>Website down for one week</td>
                                <td>Support</td>
                                <td>Today 2:00</td>
                            </tr>
                            <tr>
                                <td><label class="label label-primary">progress</label></td>
                                <td>Loosing control on server</td>
                                <td>Support</td>
                                <td>Yesterday</td>
                            </tr>
                            <tr>
                                <td><label class="label label-danger">closed</label></td>
                                <td>Authorizations keys</td>
                                <td>Support</td>
                                <td>27, Aug</td>
                            </tr>
                            <tr>
                                <td><label class="label label-success">open</label></td>
                                <td>Restoring default settings</td>
                                <td>Support</td>
                                <td>Today 9:00</td>
                            </tr>
                            <tr>
                                <td><label class="label label-primary">progress</label></td>
                                <td>Loosing control on server</td>
                                <td>Support</td>
                                <td>Yesterday</td>
                            </tr>
                            <tr>
                                <td><label class="label label-success">open</label></td>
                                <td>Restoring default settings</td>
                                <td>Support</td>
                                <td>Today 9:00</td>
                            </tr>
                            <tr>
                                <td><label class="label label-danger">closed</label></td>
                                <td>Authorizations keys</td>
                                <td>Support</td>
                                <td>27, Aug</td>
                            </tr>
                            <tr>
                                <td><label class="label label-success">open</label></td>
                                <td>Restoring default settings</td>
                                <td>Support</td>
                                <td>Today 9:00</td>
                            </tr>
                            <tr>
                                <td><label class="label label-primary">progress</label></td>
                                <td>Loosing control on server</td>
                                <td>Support</td>
                                <td>Yesterday</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right m-r-20">
                        <a href="#!" class=" b-b-primary text-primary">Lihat Semua Karyawan Habis Kontrak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
