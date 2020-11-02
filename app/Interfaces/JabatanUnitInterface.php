<?php

namespace App\Interfaces;

use App\Http\Requests\JabatanUnitRequest;

interface JabatanUnitInterface
{
    public function getAllJabatanUnits();
    public function jabatanUnitJson();
    public function getJabatanUnitById($id);
    public function requestJabatanUnit(JabatanUnitRequest $request, $id = null);
    public function deleteJabatanUnit($id);
}
