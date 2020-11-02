<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $judul = 'Data Category';
        return view('categories.categories', compact('judul'));
    }
}
