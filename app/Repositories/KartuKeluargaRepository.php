<?php

namespace App\Repositories;

use App\Helpers\Helpers;
use App\Http\Requests\KartuKeluargaRequest;
use App\Interfaces\KartuKeluargaInterface;
use App\Models\KartuKeluarga;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use DB;

class KartuKeluargaRepository implements KartuKeluargaInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllKartuKeluargas()
    {
        try {
            $kartuKeluargas = KartuKeluarga::with('user')->paginate(10);
            if($kartuKeluargas->isEmpty()) return $this->error('Data Kartu Keluarga Kosong', 404);

            return $this->success("All Kartu Keluarga", $kartuKeluargas);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getKartuKeluargaById($id)
    {
        try {
            $kartuKeluarga = KartuKeluarga::find($id);

            // Check the user
            if(!$kartuKeluarga) return $this->error("No Kartu Keluarga with ID $id", 404);
            $kartuKeluarga = [
                'id' => $kartuKeluarga->id,
                'nokk' => $kartuKeluarga->name,
                'tgl_keluar' => ($kartuKeluarga->tgl_keluar!=null)?$kartuKeluarga->tgl_keluar->format('d-m-Y'):'',
            ];
            return $this->success("Kartu Keluarga Detail", $kartuKeluarga);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestKartuKeluarga(KartuKeluargaRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $kartuKeluarga = $id ? KartuKeluarga::find($id) : new KartuKeluarga;

            // Check the user
            if($id && !$kartuKeluarga) return $this->error(" Kartu Keluarga dg ID $id Tidak Ada", 404);

            $kartuKeluarga->nokk = $request->nokk;
            $kartuKeluarga->tgl_keluar = Carbon::parse($request->tgl_keluar);
            $kartuKeluarga->update_by = auth()->user()->id;
            // Save the kartuKeluarga
            if(@$request->file('fotokk')){
                $kartuKeluarga->fotokk = Helpers::uploadImage($request,'kartukeluarga/','fotokk',$request->nokk);
            }

            $kartuKeluarga->save();

            DB::commit();
            return $this->success(
                $id ? "Kartu Keluarga updated"
                    : "Kartu Keluarga created",
                $kartuKeluarga, $id ? 200 : 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteKartuKeluarga($id)
    {
        DB::beginTransaction();
        try {
            $kartuKeluarga = KartuKeluarga::find($id);

            // Check the kartuKeluarga
            if(!$kartuKeluarga) return $this->error("Tidak ada Kartu Keluarga dg ID $id", 404);

            // Delete the user
            $kartuKeluarga->delete();

            DB::commit();
            return $this->success("Kartu Keluarga deleted", $kartuKeluarga);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
