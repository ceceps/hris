<?php

namespace App\Interfaces;

use App\Http\Requests\DepartementRequest;
use Illuminate\Http\Request;

interface DepartementInterface
{
    /**
     * Get all Departements
     *
     * @method  GET api/Departements
     * @access  public
     */
    public function getAllDepartements($nested=false);

    public function getOptionDepartement();
    public function getOptionDepartement2();

    public function toUL(array $array, $level = 1);

    public function toOption(array $array, $level = 0);

    public function toOption2(array $array, $level = 0);

    public function departementJson();

    /**
     * Get Departement By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/Departements/{id}
     * @access  public
     */
    public function getDepartementById($id);

    /**
     * Create | Update Departement
     *
     * @param   \App\Http\Requests\DepartementRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/Departements       For Create
     * @method  PUT     api/Departements/{id}  For Update
     * @access  public
     */
    public function requestDepartement(DepartementRequest $request, $id = null);

    /**
     * Delete Departement
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/Departements/{id}
     * @access  public
     */
    public function deleteDepartement(Request $request);
}
