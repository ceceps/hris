<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $judul??'' }}</title>
    @include('layouts.link')
    @yield('pagestyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Pre-loader start -->
    @include('layouts.loader')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('layouts.header')
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('layouts.sidebar')
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper full-calender">
                                    @yield('page-header')
                                    @yield('konten')
                                    <div class="page-error">
                                        <div class="card text-center">
                                            <div class="card-block">
                                                <div class="m-t-10">
                                                    <i class="icofont icofont-warning text-white bg-c-yellow"></i>
                                                    <h4 class="f-w-600 m-t-25">Not supported</h4>
                                                    <p class="text-muted m-b-0">Full Calender not supported in this device
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.scripts')
    {{-- @include('globalscript.scriptfirebase') --}}
    @include('globalscript.scriptsdelete')
    @include('globalscript.scriptcsrftoken')
    @include('globalscript.scriptcheckall')
    @include('globalscript.scriptcancel')
    {{-- @include('user.scriptsusers') --}}
    {{-- @include('offer.scriptsoffer')
    @include('offer.scriptsslider')
    @include('redeem.scriptsredeem') --}}
    {{-- @include('customerlist.scriptcustomerlist') --}}
    {{-- @include('rewardoption.scriptrewardoption')
    @include('rebateoption.scriptrebate')
    @include('rewardoption.scriptextrapoint')
    @include('rebateoption.scriptdiscount') --}}
    @include('globalscript.scriptstatus')
    @include('layouts.scriptsfunction')
    @yield('pagescript')
</body>

</html>
