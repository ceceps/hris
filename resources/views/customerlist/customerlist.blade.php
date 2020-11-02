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
                <form id="formCustomer" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <label class="col-sm-2 col-form-label">Full Name<span>*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                            id="fullname" name="fullname" placeholder="Insert Full Name Customer" maxlength="50">
                            <span id="text-danger">{{ $errors->first('fullname') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Type ID<span>*</span></label>
                        <div class="col-sm-10">
                            <select name="id_type" class="form-control @error('id_type') is-invalid
                            @enderror"id="id_type">
                                <option value="ID CARD">ID CARD</option>
                                <option value="LICENSE">LICENSE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No ID<span>*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('no_id') is-invalid @enderror"
                            id="no_id" name="no_id" onkeypress="return (event.which >= 48 && event.which <= 57)
                            || event.which == 8 || event.which == 46" placeholder="Insert No ID" maxlength="25">
                            <span id="text-danger">{{ $errors->first('no_id') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No Phone<span>*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone" onkeypress="return (event.which >= 48 && event.which <= 57)
                            || event.which == 8 || event.which == 46" placeholder="Insert No Phone" maxlength="13">
                            <span id="text-danger">{{ $errors->first('phone') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email<span>*</span></label>
                        <div class="col-sm-10">
                            <input type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" maxlength="100"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" placeholder="Insert Email">
                            <span id="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Username<span>*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username" placeholder="Insert Username" maxlength="100">
                            <span id="text-danger">{{ $errors->first('username') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password<span>*</span></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Insert Password" maxlength="100">
                            <span id="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status<span>*</span></label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control @error('status') is-invalid
                            @enderror"id="status">
                                <option value="REGULER">REGULER</option>
                                <option value="INSIDER">INSIDER</option>
                                <option value="ELITE">ELITE</option>
                                <option value="CORPORATE">CORPORATE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary m-b-0" id="tambah_customer">
                                <i class="feather icon-save"></i> Save
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
                <input type="checkbox" class="form-controll" name="checkAll" id="checkAll"/>
                &nbsp;
                <input type="submit" class="btn btn-danger" id="hapus_data" value="DELETE">
                <input type="button" class="btn btn-success" id="show_form_Customer" value="ADD">
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
                <table id="tableCustomer" class="table table-striped table-bordered nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>No</th>
                            <th>Check</th>
                            <th>QR Code</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Id type</th>
                            <th>No ID</th>
                            <th>Action</th>
                            <th>Phone</th>
                            <th>Username</th>
                            <th>status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
