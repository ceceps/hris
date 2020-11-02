<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobLevelRequest;
use App\Interfaces\JobLevelInterface;
use Illuminate\Http\Request;

class JobLevelController extends Controller
{
    protected $jobLevelInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(JobLevelInterface $jobLevelInterface)
    {
        $this->jobLevelInterface = $jobLevelInterface;
    }

    public function index()
    {
        return $this->jobLevelInterface->getAllJobLevels();
    }

    public function json()
    {
        return $this->jobLevelInterface->jobLevelJson();
    }

    public function store(JobLevelRequest $request)
    {
        return $this->jobLevelInterface->requestJobLevel($request);
    }

    public function show($id)
    {
        return $this->jobLevelInterface->getJobLevelById($id);
    }

    public function destroy(Request $request)
    {
        return $this->jobLevelInterface->deleteJobLevel($request);
    }

    public function update(JobLevelRequest $request, $id)
    {
        return $this->jobLevelInterface->requestJobLevel($request, $id);
    }

}
