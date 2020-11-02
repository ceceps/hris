<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseAPI;
use Laravolt\Indonesia\Models\District;
use DB;

class DistrictController extends Controller
{
    use ResponseAPI;
    public function index()
    {
        if (request()->id AND request()->q){
            $districts = District::where('city_id', request()->id)
                         ->where(DB::raw("lower(name)"), "LIKE", "%".strtolower(request()->q)."%")
                         ->get();
        } else if (request()->id) {
            $districts = District::where('city_id', request()->id)->get();
        }else {
            return response()->json([]);
        }

        $districts->transform(function ($district) {
            return ['id' => $district->id, 'text' => $district->name];
        });
        return response()->json($districts);
    }

    public function districts($cityId)
    {
        $districts = District::where('city_id', $cityId)->get();
        return $this->success('All District',$districts);
    }
}
