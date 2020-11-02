<?php

namespace App\Repositories;

use App\Http\Requests\JobLevelRequest;
use App\Interfaces\JobLevelInterface;
use App\Traits\ResponseAPI;
use App\Models\JobLevel;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobLevelRepository implements JobLevelInterface
{
    use ResponseAPI;

    public function getAllJobLevels()
    {
        $job = JobLevel::get();
        return $this->success('All Job Level', $job);
    }

    public function jobLevelJson()
    {
        $job = JobLevel::orderBy('id');
        return DataTables::of($job)
            ->addColumn('check', function ($row) {
                return '<input type="checkbox" name="cb_element[]" id="cb_element" class="cb_element" value="' . $row->id . '" />';
            })
            ->addColumn('link', function ($row) {
                return '<a class="btn editoffer"
                     data-ids = "' . $row->id . '"
                     data-name = "' . $row->name . '" >
                     <i class="feather icon-edit f-20 text-c-black"></i></a>';
            })
            ->rawColumns(['check', 'link'])
            ->addIndexColumn()
            ->make(true);
    }

    public function getJobLevelById($id, $withchild = false)
    {
        try {
            $job = JobLevel::find($id);
            if (!$job) return $this->error("No Job with ID " . $id, 404);

            return $this->success("Job Detail", $job);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestJobLevel(JobLevelRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            // If Employee exists when we find it
            // Then update the Employee
            // Else create the new one.
            $job = $id ? JobLevel::find($id) : new JobLevel;

            // Check the Employee
            if ($id && !$job) return $this->error("No Job with ID " . $id, 404);
            $job->name = $request->name;
            $job->save();

            DB::commit();

            return $this->success(
                'Job Level Success Saved',
                [],
                200
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteJobLevel(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->id;
            JobLevel::whereIn('id',explode(",",$ids))->delete();
            DB::commit();
            return $this->success("Job Level  deleted",[]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(),421);
        }
    }
}
