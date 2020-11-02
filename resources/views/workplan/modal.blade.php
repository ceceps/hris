<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form enctype="multipart/form-data" id="form-modal">
            @csrf
        <div class="modal-content">
            <input type="hidden" name="id" id="id"  />
            <input type="hidden" name="employee_id" id="employee_id"  />
            <div class="modal-header">
                <h4><label id="title">Tambah</label> Workplan</h4>
            </div>
            <div class="modal-body">
                <div class="container col-md-12">
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-12">
                              <input type="text" name="plan_name" id="plan_name" class="form-control" placeholder="Nama Plan">
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-md-12">
                              <input type="text" name="name" id="name" class="form-control basicAutoComplete" placeholder="Cari Nama Pegawai">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control" name="from" id="from"/>
                                <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                                </span>
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker7'>
                                   <input type='text' class="form-control" name="to" id="to" />
                                   <span class="input-group-addon">
                                   <span class="fa fa-calendar"></span>
                                   </span>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="worktodo" id="worktodo" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void()" id="workplan_delete">
                     <span class="fa fa-trash"></span>
                </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="button" class="btn btn-primary" id="workplan_add" value="Save">
            </div>
        </div>
        </form>
    </div>
</div>
