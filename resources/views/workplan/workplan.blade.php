@extends('layouts.app-fullcalendar')

@section('page-header')
<!-- Page-header start -->

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>{{ $judul??'' }}</h4>
                    <span></span>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}"> <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Workplan</a> </li>
                </ul>
            </div>
        </div> --}}
    </div>
</div>
<!-- Page-header end -->
@endsection

@section('pagestyle')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/fullcalendar/css/fullcalendar.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/bower_components/fullcalendar/css/fullcalendar.print.css') }}" media='print'>
<style>
    /* .fc-time,
    .fc-title {
        color: black !important;
    } */

    #calendar-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .fc-header-toolbar {

        /*the calendar will be butting up against the edges,
    but let's scoot in the header's buttons
    */
        padding-top: 1em;
        padding-left: 1em;
        padding-right: 1em;
    }
</style>
@endsection @section('konten')

<div class="page-body">
    <div class="card">
        <div class="card-header">
            <button id="add_workplan" class="btn btn-primary waves-effect md-trigger"  data-backdrop="static" data-keyboard="false">Tambah Workplan</button>
{{-- data-toggle="modal" data-target="#editModal" --}}
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="feather icon-maximize full-card"></i></li>
                    <li><i class="feather icon-minus minimize-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('workplan.modal')
@endsection
@section('pagescript')
@include('workplan.scriptworkplan')
@endsection
