<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use DB;
class ProvinceController extends Controller
{
    use ResponseAPI;

    public function index(Request $request)
    {
        if(!empty(request()->q)){
            $provinces = Province::where(DB::raw("lower(name)"), "LIKE", "%".strtolower($request->q)."%")->get();
        }else{
            $provinces = Province::all();
        }

       return $this->success('All Province',$provinces);
    }
}
