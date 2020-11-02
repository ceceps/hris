<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use DataTables;
use Validator,Redirect,Response;
use Carbon\Carbon;
use Image;
use File;
use QrCode;
use Hash;


class CustomerListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $judul = "Customer List";
        return view('customerlist.customerlist',compact('judul'));
    }

    public function getdata()
    {
        $posts = Anggota::select('*');
        return Datatables::of($posts)
        ->addColumn('check', function($row)
        {
            return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="'. $row->id .'" />';
        })
        ->addColumn('status', function($row){
            if($row->status=="REGULER"){
                $statusColor    = "success";
                $label          = "REGULER";
            }else if($row->status=="INSIDER"){
                $statusColor = "primary";
                $label       = "INSIDER";
            }else if($row->status=="ELITE"){
                $statusColor = "warning";
                $label       = "ELITE";
            }
            else if($row->status=="CORPORATE"){
                $statusColor = "info";
                $label       = "CORPORATE";
            }else{
                $statusColor = "primary";
                $label       = "-";
            }
            return '<a class="btn btn-'.$statusColor.' btn-sm" style="color:white;" >'.$label.'</a>';
        })
        ->addColumn('link', function($row){
            return '<a class="btn btn-warning btn-sm editoffer"
            data-ids = "'. $row->id .'"
            data-fullname = "'. $row->fullname .'"
            data-id_type = "'. $row->id_type .'"
            data-no_id = "'.$row->no_id.'"
            data-email = "'.$row->email.'"
            data-phone = "'.$row->phone.'"
            data-username = "'.$row->username.'"
            data-status = "'.$row->status.'"
            >
            <i class="feather icon-edit f-20 text-c-black"></i></a>';
        })
        ->rawColumns(['status','check','link'])
        ->addIndexColumn()
        ->make(true);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required || unique:customer_lists',
          ];
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            $hash = Hash::make($request->password);
            $result = Anggota::create([
                'fullname'  => $request->fullname,
                'id_type'   => $request->id_type,
                'no_id'     => $request->no_id,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'username'  => $request->username,
                'password'  => $hash,
                'qr_image'  => $request->username.'.png',
                'status'    => $request->status
            ]);
            if ($result) {
                QrCode::format('png')->size(500)->generate($request->username,'assets/images/upload/customer/'
                .$request->username.'.png');
            }
            $arr = array('msg' => 'Customer And Qr Code Has Created', 'status' => true );
            return \Response::json($arr);
        }else {
            $arr = array('msg' => 'Error email already exists', 'status' => false );
            return \Response::json($arr);
        }
    }

    public function update(Request $request)
    {
        if($request->password != "")
        {
        $hash = Hash::make($request->password);
        $result = Anggota::where('id',$request->id)->update([
            'fullname'  => $request->fullname,
            'id_type'   => $request->id_type,
            'no_id'     => $request->no_id,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'username'  => $request->username,
            'password'  => $hash,
            'qr_image'  => $request->username.'.png',
            'status'    => $request->status
        ]);
        if ($result) {
            QrCode::format('png')->size(500)->generate($request->username,'assets/images/upload/customer/'
            .$request->username.'.png');
        }
        return response()->json(['status'=>true,'message'=>'Data Store updated']);
        }else{
        $result = Anggota::where('id',$request->id)->update([
           'fullname'  => $request->fullname,
            'id_type'   => $request->id_type,
            'no_id'     => $request->no_id,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'username'  => $request->username,
            'qr_image'  => $request->username.'.png',
            'status'    => $request->status
        ]);
        if ($result) {
            QrCode::format('png')->size(500)->generate($request->username,'assets/images/upload/customer/'
            .$request->username.'.png');
        }
        return response()->json(['status'=>true,'message'=>'Data Store updated']);
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->ids;
        $offer = Anggota::whereIn('id',explode(",",$ids))->get();
        foreach ($offer as $offer) {
            $gambar = explode(",",$offer->qr_image);
            $count = count($gambar)-1;
            for($x=0;$x<=$count;$x++){
                $files = "assets/images/upload/customer/".$gambar[$x];
                $fileArr = array($files);
                //print_r($fileArr);
                File::delete($fileArr);
            }
        }
        Anggota::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Data User Berhasil di Hapus."]);
    }
}
