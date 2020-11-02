<?php

namespace App\Interfaces;

use App\Http\Requests\WorkplanRequest;
use Illuminate\Http\Request;

interface WorkplanInterface
{
    public function getAllWorkplans();
    public function WorkplanJson();
    public function getWorkplanById($id);
    public function requestWorkplan(WorkplanRequest $request, $id = null);
    public function deleteWorkplan(Request $request);

}
