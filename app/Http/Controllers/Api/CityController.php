<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseAPI;
use Laravolt\Indonesia\Models\City;
use DB;

class CityController extends Controller
{
    use ResponseAPI;

    public function index()
    {
        if (request()->id and request()->q) {
            $cities = City::where('province_id', request()->id)->where(DB::raw("lower(name)"), "LIKE", "%" . strtolower(request()->q) . "%")->get();
        } else if (request()->id) {
            $cities = City::where('province_id', request()->id)->get();
        } else {
            return response()->json([]);
        }

        $cities->transform(function ($city) {
            return ['id' => $city->id, 'text' => $city->name];
        });
        return response()->json($cities);
    }

    public function cities($provid)
    {
        $cities = City::where('province_id', $provid)->get();
        $cities->transform(function ($city) {
            return ['id' => $city->id, 'name' => $city->name];
        });
        return $this->success('All Cities', $cities);
    }
}
