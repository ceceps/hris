<?php

namespace App\Repositories;

use App\Http\Requests\JobRequest;
use App\Interfaces\JobInterface;
use App\Traits\ResponseAPI;
use App\Models\Job;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobRepository implements JobInterface
{
    use ResponseAPI;

    public function getAllJobs()
    {
        $Job = Job::get();
        return $this->success('All Job', $Job);
    }

    public function jobJson()
    {
        $Job = Job::orderBy('id');
        return DataTables::of($Job)
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

    public function getJobById($id, $withchild = false)
    {
        try {
            $job = Job::find($id);
            if (!$job) return $this->error("No Job with ID " . $id, 404);

            return $this->success("Job Detail", $job);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestJob(JobRequest $request, $id = null)
    {

        DB::beginTransaction();
        try {
            // If Employee exists when we find it
            // Then update the Employee
            // Else create the new one.
            $job = $id ? Job::find($id) : new Job;

            // Check the Employee
            if ($id && !$job) return $this->error("No Job with ID " . $id, 404);
            $job->name = $request->name;
            $job->save();

            DB::commit();

            return $this->success(
                $id ? "Job Berhasil Diupdate"
                : "Job Berhasil Disimpan",
                 $job,
                 $id ? 200 : 201
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage(), 500);
        }
    }

    public function deleteJob(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->id;
            //$offer = Job::whereIn('id',explode(",",$ids))->get();
            // foreach ($offer as $offer) {
            //     $gambar = explode(",",$offer->qr_image);
            //     $count = count($gambar)-1;
            //     for($x=0;$x<=$count;$x++){
            //         $files = "assets/images/upload/customer/".$gambar[$x];
            //         $fileArr = array($files);
            //         //print_r($fileArr);
            //         File::delete($fileArr);
            //     }
            // }
            Job::whereIn('id', explode(",", $ids))->delete();
            DB::commit();
            return response()->json(['status' => true, 'message' => "Data Job Berhasil di Hapus."]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), 421);
        }
    }
}
