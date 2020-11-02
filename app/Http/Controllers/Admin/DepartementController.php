<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DepartementController extends Controller
{
    public function index()
    {
        $judul = 'Data Departement';
        return view('departements.departement', compact('judul'));
    }
}
