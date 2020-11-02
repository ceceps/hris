<?php

namespace App\Interfaces;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

interface JobInterface
{
    /**
     * Get all Jobs
     *
     * @method  GET api/jobs
     * @access  public
     */
    public function getAllJobs();

    public function jobJson();



    /**
     * Get Job By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/Jobs/{id}
     * @access  public
     */
    public function getJobById($id);

    /**
     * Create | Update Job
     *
     * @param   \App\Http\Requests\JobRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/Jobs       For Create
     * @method  PUT     api/Jobs/{id}  For Update
     * @access  public
     */
    public function requestJob(JobRequest $request, $id = null);

    /**
     * Delete Job
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/Jobs/{id}
     * @access  public
     */
    public function deleteJob(Request $request);
}
