<?php

namespace App\Interfaces;

use App\Http\Requests\CekKeluargaRequest;
use App\Http\Requests\KeluargaRequest;

interface KeluargaInterface
{
    /**
     * Get all keluargas
     *
     * @method  GET api/keluargas
     * @access  public
     */
    public function getAllkeluargas();

    public function keluargaJson();

    public function cekNoKk(CekKeluargaRequest $request);
    
    /**
     * Get Keluarga By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/keluargas/{id}
     * @access  public
     */
    public function getKeluargaById($id);

    /**
     * Create | Update Keluarga
     *
     * @param   \App\Http\Requests\KeluargaRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/keluargas       For Create
     * @method  PUT     api/keluargas/{id}  For Update
     * @access  public
     */
    public function requestKeluarga(KeluargaRequest $request, $id = null);

    /**
     * Delete Keluarga
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/keluargas/{id}
     * @access  public
     */
    public function deleteKeluarga($id);
}
