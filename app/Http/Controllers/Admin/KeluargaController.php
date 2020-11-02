<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeluargaRequest;
use App\Interfaces\KeluargaInterface;

class KeluargaController extends Controller
{
    protected $keluargaInterface;

    public function __construct(KeluargaInterface $keluargaInterface)
    {
        $this->keluargaInterface = $keluargaInterface;
    }

    public function index()
    {
        $judul = 'Data Keluarga';
        return view('keluargas.keluargas', compact('judul'));
    }

    public function destroy($id)
    {
        return $this->keluargaInterface->deleteKeluarga($id);
    }

}
