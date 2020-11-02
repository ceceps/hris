<?php

namespace App\Repositories;

use App\Helpers\Helpers;
use App\Http\Requests\CekKeluargaRequest;
use App\Http\Requests\KeluargaRequest;
use App\Interfaces\KeluargaInterface;
use App\Models\Anggota;
use App\Models\KartuKeluarga;
use App\Models\Keluarga;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use DataTables;
use DB;
use Illuminate\Support\Facades\Storage;

class KeluargaRepository implements KeluargaInterface
{
    // Use ResponseAPI Trait in this repository
    use ResponseAPI;

    public function getAllKeluargas()
    {
        try {
            $keluargas = Keluarga::with('kartuKeluarga')->paginate(10);
            if ($keluargas->isEmpty()) return $this->error('Data Keluarga Kosong', 404);

            return $this->success("All Keluarga", $keluargas);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function keluargaJson()
    {
        $units = Keluarga::with('kartuKeluarga')->orderBy('id');
        return DataTables::of($units)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })
            ->addColumn('link', function ($row) {
               $fotokk = ($row->kartuKeluarga!=null)?$row->kartuKeluarga->fotokk:'';

                return '<a class="btn editoffer"
            data-ids = "' . $row->id . '"
            data-fotokk = "' .  $fotokk . '"
            >
            <i class="feather icon-edit f-20 text-c-black"></i></a>';
            })->addColumn('alamat', function ($row) {
                $province =  $row->province != null ? 'Prov. '. $row->province->name: '';
                $city =  $row->city!=null ? ' '.$row->city->name:'';
                $district = $row->district!=null ? ' Kec. '.$row->district->name:'';
                return $district.$city;
            })->addColumn('nokk', function ($row) {
                return $row->kartuKeluarga != null ? $row->kartuKeluarga->nokk : '';
            })->rawColumns(['check', 'link', 'nokkW', 'alamat'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getKeluargaById($id)
    {
        try {
            $keluarga = Keluarga::with(['kartuKeluarga'])->find($id);
            // return $this->success("Kartu Keluarga Detail", $keluarga->kartuKeluarga);
            // Check the user
            if (!$keluarga) return $this->error("No Keluarga with ID ".$id, 404);
            $anggota = Anggota::where('keluarga_id',$keluarga->id)->where('jabatan_keluarga','Kepala Keluarga')->first();
            $keluarga = [
                'id' => $keluarga->id,
                'nokk' => ($keluarga->kartuKeluarga != null) ? $keluarga->kartuKeluarga->nokk : '',
                'tgl_keluar' => ($keluarga->kartuKeluarga != null) ? Helpers::dateDmy($keluarga->kartuKeluarga->tgl_keluar) : '',
                'fotokk' => ($keluarga->kartuKeluarga != null) ? $keluarga->kartuKeluarga->fotokk : 'images/noimage.jpg',
                'noktp' => $keluarga->noktp,
                'kode_kel' => $keluarga->kode_kel,
                'kartu_keluarga_id' => $keluarga->kartu_keluarga_id,
                'status_nikah' => $anggota->status_nikah,
                'agama' => $anggota->agama,
                'name' => $keluarga->name,
                'jk' => $keluarga->jk,
                'alamat' => $keluarga->alamat,
                'rt' => $keluarga->rt,
                'rw' => $keluarga->rw,
                'kodepos' => $keluarga->kodepos,
                'tempat_lahir' => $keluarga->tempat_lahir,
                'tgl_lahir' => Helpers::dateDmy($keluarga->tgl_lahir),
                'province_id' => $keluarga->province_id,
                'city_id' => $keluarga->city_id,
                'district_id' => $keluarga->district_id,
                'village' => $keluarga->village_id,
                'jabatan_keluarga' => $keluarga->jabatan_keluarga,
            ];
            return $this->success("Kartu Keluarga Detail", $keluarga);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function cekNoKk(CekKeluargaRequest $request)
    {
        $noKK = $request->nokk;
        return response()->json($noKK);
    }

    public function requestKeluarga(KeluargaRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            // Check the user
            $keluarga = $id ? Keluarga::find($id) : new Keluarga;
            if ($id && !$keluarga) return $this->error("Keluarga dg ID $id Tidak Ada", 404);

            //simpan kartu keluarga
            if (@$request->file('fotokk')) {
                $fotokk = Helpers::uploadImage($request, 'keluarga/', 'fotokk', $request->nokk);
            }


            // simpan Kartu Keluarga
            if ($request->kartu_keluarga_id) {
                $kartuKeluarga = KartuKeluarga::find($request->kartu_keluarga_id);
                $dataKartuKeluarga = $request->dataKartuKeluarga();
                if (isset($fotokk)) {
                    $dataKartuKeluarga['fotokk'] =  $fotokk;
                }
                $storeKK = $kartuKeluarga->update($dataKartuKeluarga);
                $idKartuKeluarga = $request->kartu_keluarga_id;
            } else {
                $dataKartuKeluarga = $request->dataKartuKeluarga();
                $dataKartuKeluarga['fotokk'] =  $fotokk;
                $storeKK  = KartuKeluarga::create($dataKartuKeluarga);
                $idKartuKeluarga = $storeKK->id;
            }

            //simpan Keluarga
            $dataKeluarga = $request->dataKeluarga();

            $dataKeluarga['kartu_keluarga_id'] =  $idKartuKeluarga;

            if ($id>0) {
                $idKeluarga = $keluarga->update($dataKeluarga);
            } else {
                $idKeluarga = Keluarga::create($dataKeluarga);
            }
            //simpan Anggota
            $dataAnggota = $request->dataAnggota();
            $dataAnggota['keluarga_id'] =  $id ?? $idKeluarga->id;

            if ($id == null) {
                $anggota = Anggota::create($dataAnggota);
            }else{
                $anggota = Anggota::where('keluarga_id',$id)->where('jabatan_keluarga','Kepala Keluarga')->first();
                $dtAnggota = $anggota->update($dataAnggota);
            }

            DB::commit();
            return $this->success(
                $id ? "Data Keluarga updated"
                    : "Data Keluarga Telah Dibuat",
                [],
                $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollBack();
           Storage::disk('public')->delete($fotokk);
           dd($e->getMessage());
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteKeluarga($id)
    {
        DB::beginTransaction();
        try {
            $keluarga = Keluarga::find($id);

            // Check the Keluarga
            if (!$keluarga) return $this->error("Tidak ada Kartu Keluarga dg ID $id", 404);

            // Delete the user
            $keluarga->delete();

            DB::commit();
            return $this->success("Kartu Keluarga deleted", $keluarga);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
