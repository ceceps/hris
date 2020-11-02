@extends('layouts.app')
@section('konten')
    <!-- statustic-card start -->
<div class="row">
    <div class="col-xl-4 col-md-8">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Anggota Total Data</p>
                        <h4 class="m-b-0">{{ App\Models\Employee::count() }}</h4>
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
                        <p class="m-b-5">New Anggota Total Data</p>
                        <h4 class="m-b-0">{{ App\Models\Employee::where(['is_wafat' => null])->count() }}</h4>
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
                        <p class="m-b-5">User INSIDER Profile</p>
                        <h4 class="m-b-0">{{ App\Models\Employee::where(['is_wafat' => null])->count() }}</h4>
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
                        <p class="m-b-5">User ELITE Profile</p>
                        <h4 class="m-b-0">{{ App\Models\Employee::where(['is_wafat' => null])->count() }}</h4>
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
                        <p class="m-b-5">User COPORATE Profile</p>
                        <h4 class="m-b-0">{{ App\Models\Employee::where(['is_wafat' => null])->count() }}</h4>
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
                        <p class="m-b-5">TOTAL OFFER DATA</p>
                        <h4 class="m-b-0">{{ App\Models\Employee::count() }}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-box f-50 text-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-xl-4 col-md-8">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Product Total Data</p>
                        <h4 class="m-b-0">{{ App\Produk::count() }}</h4>
                    </div>
                    <div class="col col-auto text-right">
                        <i class="feather icon-box f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

</div>
@endsection
