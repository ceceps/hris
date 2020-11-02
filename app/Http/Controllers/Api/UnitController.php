<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Interfaces\UnitInterface;
use App\Models\Unit;
use DataTables;
use Carbon\Carbon;

class UnitController extends Controller
{
    protected $unitInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UnitInterface $unitInterface)
    {
        $this->unitInterface = $unitInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->unitInterface->getAllUnits();
    }

    public function json()
    {
        $units = Unit::select('*')->orderBy('id');
        return DataTables::of($units)
        ->addColumn('check', function($row)
        {
            return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="'. $row->id .'" />';
        })
        ->addColumn('link', function($row){
            $tglDibentuk =  $row->tgl_dibentuk!=null? Carbon::createFromFormat('Y-m-d', $row->tgl_dibentuk)->format('d-m-Y'):'';
            return '<a class="btn editoffer"
            data-ids = "'. $row->id .'"
            data-name = "'. $row->name .'"
            data-kode_unit = "'. $row->kode_unit .'"
            data-parent_id = "'. $row->parent_id .'"
            data-tgl_dibentuk = "'.  $tglDibentuk .'" >
            <i class="feather icon-edit f-20 text-c-black"></i></a>';
        })
        ->addColumn('parent', function($row){
            return $row->parent!=null? $row->parent->name:'';
        })
        ->editColumn('name', function($row){
            return $row->parent!=null?'--'.$row->name:$row->name;
        })
        ->editColumn('tgl_dibentuk', function($row){
            return $row->tgl_dibentuk!=null? Carbon::createFromFormat('Y-m-d', $row->tgl_dibentuk)->format('d-m-Y'):'';
        })
        ->rawColumns(['check', 'link','parent'])
        ->addIndexColumn()
        ->make(true);
    }

    public function getOptionUnit()
    {
        return $this->unitInterface->getOptionUnit();
    }

    public function getOptionUnit2()
    {
        return $this->unitInterface->getOptionUnit2();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        return $this->unitInterface->requestUnit($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->unitInterface->getUnitById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UnitRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        return $this->unitInterface->requestUnit($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->unitInterface->deleteUnit($id);
    }
}
