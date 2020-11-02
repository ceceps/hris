<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CekKeluargaRequest;
use App\Http\Requests\KeluargaRequest;
use App\Interfaces\KeluargaInterface;

class KeluargaController extends Controller
{
    protected $keluargaInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(KeluargaInterface $keluargaInterface)
    {
        $this->keluargaInterface = $keluargaInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->keluargaInterface->getAllKeluargas();
    }

    public function cekNokk(CekKeluargaRequest $request)
    {
        return $this->keluargaInterface->cekNoKk($request);
    }

     public function json()
    {
        return $this->keluargaInterface->keluargaJson();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeluargaRequest $request)
    {
        return $this->keluargaInterface->requestKeluarga($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->keluargaInterface->getKeluargaById($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->keluargaInterface->getKeluargaById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(KeluargaRequest $request, $id)
    {
        return $this->keluargaInterface->requestKeluarga($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->keluargaInterface->deleteKeluarga($id);
    }
}
