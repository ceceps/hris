<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Interfaces\JobInterface;

class JObController extends Controller
{
    protected $jobInterface;

    public function __construct(JobInterface $jobInterface)
    {
        $this->jobInterface = $jobInterface;
    }

    public function index()
    {
        $judul = 'Data  Job';
        return view('jobs.jobs', compact('judul'));
    }

}
