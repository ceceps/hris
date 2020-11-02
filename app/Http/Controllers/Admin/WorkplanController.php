<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkplanRequest;
use App\Interfaces\WorkplanInterface;
use App\Models\WorkPlan;
use Illuminate\Http\Request;

class WorkplanController extends Controller
{
    private $workplanInterface;

    public function __construct(WorkplanInterface $workplanInterface)
    {
      $this->workplanInterface = $workplanInterface;
    }

    public function index()
    {
        $judul = 'Data Workplan';
        $workplans = WorkPlan::get();
        return view('workplan.workplan', ['judul' => $judul, 'workplans' => $workplans]);
    }

    public function store(WorkplanRequest $request)
    {
        return $this->workplanInterface->requestWorkplan($request);
    }

    public function show()
    {
    }

    public function ajaxUpdate(Request $request)
    {
        $appointment = WorkPlan::with('client')->findOrFail($request->appointment_id);
        $appointment->update($request->all());

        return response()->json(['appointment' => $appointment]);
    }

    public function update(Request $request,$id)
    {
        return $this->workplanInterface->requestWorkplan($request,$id);
    }

    public function destroy(Request $request)
    {
    }
}
