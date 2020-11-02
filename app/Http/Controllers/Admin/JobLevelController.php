<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class JobLevelController extends Controller
{

    public function index()
    {
        $judul = 'Data Job Level';
        return view('joblevels.joblevels', compact('judul'));
    }
}
