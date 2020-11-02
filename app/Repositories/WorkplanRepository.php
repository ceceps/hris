<?php

namespace App\Repositories;

use App\Helpers\Helpers;
use App\Http\Requests\WorkplanRequest;
use App\Interfaces\WorkplanInterface;
use App\Models\WorkPlan;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class WorkplanRepository implements WorkplanInterface
{
    use ResponseAPI;

    public function getAllWorkplans()
    {
        $workplan = WorkPlan::orderBy('id')->get();
        return $this->success('All Workplan', $workplan);
    }

    public function WorkplanJson()
    {
    }

    public function getWorkplanById($id)
    {
        $workplan = WorkPlan::find($id);
        return $this->success('Detil Workplan', $workplan);
    }

    public function requestWorkplan(WorkplanRequest $request, $id = null)
    {
        DB::beginTransaction();
        try {
            $workplan = $request->id ? WorkPlan::find($request->id) : new WorkPlan;

            // Check the user
            if ($request->id && !$workplan) return $this->error("No Workplan with ID" . $request->id, 404);

            $workplan->plan_name = $request->plan_name;
            $workplan->employee_id = $request->employee_id;
            $workplan->worktodo = $request->worktodo;
            $workplan->from = Carbon::parse($request->from);
            $workplan->to = Carbon::parse($request->to);
            $workplan->update_by = auth()->user()->id;

            // Save the Workplan
            $workplan->save();

            DB::commit();
            return $this->success(
                $request->id ? "Data Workplan berhasil diupdate"
                    : "Data Workplan berhasil di tambahkan",
                $workplan,
                $request->id  ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 422);
        }
    }

    public function deleteWorkplan($id)
    {
        DB::beginTransaction();
        try {
            $workplan = WorkPlan::find($id);
            if ($id && !$workplan) return $this->error("No Workplan with ID" . $id, 404);

            $workplan->delete();
            DB::commit();
            return $this->success('Data Workplan Sukses dihapus', []);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 422);
        }
    }
}
