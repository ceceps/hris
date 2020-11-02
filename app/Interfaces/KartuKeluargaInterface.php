<?php

namespace App\Interfaces;

use App\Http\Requests\KartuKeluargaRequest;

interface KartuKeluargaInterface
{
    /**
     * Get all KartuKeluargas
     *
     * @method  GET api/KartuKeluargas
     * @access  public
     */
    public function getAllKartuKeluargas();

    /**
     * Get KartuKeluarga By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/kartukeluargas/{id}
     * @access  public
     */
    public function getKartuKeluargaById($id);

    /**
     * Create | Update KartuKeluarga
     *
     * @param   \App\Http\Requests\KartuKeluargaRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/kartukeluargas       For Create
     * @method  PUT     api/kartukeluargas/{id}  For Update
     * @access  public
     */
    public function requestKartuKeluarga(KartuKeluargaRequest $request, $id = null);

    /**
     * Delete KartuKeluarga
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/kartukeluargas/{id}
     * @access  public
     */
    public function deleteKartuKeluarga($id);
}
