<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartementRequest;
use App\Interfaces\DepartementInterface;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    protected $departementInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(DepartementInterface $departementInterface)
    {
        $this->departementInterface = $departementInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->departementInterface->getAllDepartements(true);
    }

    public function json()
    {
        return $this->departementInterface->departementJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartementRequest $request)
    {
        return $this->departementInterface->requestDepartement($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->departementInterface->getDepartementById($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(DepartementRequest $request, $id)
    {
        return $this->departementInterface->requestDepartement($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->departementInterface->deleteDepartement($request);
    }
}
