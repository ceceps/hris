<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseAPI;
use Laravolt\Indonesia\Models\Village;
use DB;

class VillageController extends Controller
{
    use ResponseAPI;
    public function index()
    {
        if (request()->id AND request()->q){
            $villages = Village::where('district_id', request()->id)
                         ->where(DB::raw("lower(name)"), "LIKE", "%".strtolower(request()->q)."%")
                         ->get();
        } else if (request()->id) {
            $villages = Village::where('district_id', request()->id)->get();
        }else {
            $villages = Village::get();
        }

        $villages->transform(function ($village) {
            return ['id' => $village->id, 'text' => $village->name];
        });
        return response()->json($villages);
    }

    public function villages($districtId)
    {
        $villages = Village::where('district_id', $districtId)->get();
        return $this->success('All Village',$villages);
    }
}
