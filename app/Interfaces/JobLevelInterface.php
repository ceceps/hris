<?php

namespace App\Interfaces;

use App\Http\Requests\JobLevelRequest;
use Illuminate\Http\Request;

interface JobLevelInterface
{
    /**
     * Get all JobLevels
     *
     * @method  GET api/joblevels
     * @access  public
     */
    public function getAllJobLevels();

    public function jobLevelJson();


    /**
     * Get JobLevel By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/JobLevels/{id}
     * @access  public
     */
    public function getJobLevelById($id);

    /**
     * Create | Update JobLevel
     *
     * @param   \App\Http\Requests\JobLevelRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/joblevels       For Create
     * @method  PUT     api/joblevels/{id}  For Update
     * @access  public
     */
    public function requestJobLevel(JobLevelRequest $request, $id = null);

    /**
     * Delete JobLevel
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/joblevels/{id}
     * @access  public
     */
    public function deleteJobLevel(Request $request);
}
