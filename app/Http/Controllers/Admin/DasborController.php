<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\InformasiUserHelper;
use App\Models\Employee;
use Carbon\Carbon;

class DasborController extends Controller
{

    public function index()
    {
        $judul = "Dasbor";

        return view('dasbor', compact('judul'));
    }

    public function dasbor()
    {
        $totPegawai = Employee::where('is_wafat', '=', false)->count();
        $totPegawaiBaru = Employee::whereMonth('join_date', date('m'))->whereYear('join_date', date('Y'))->count();
        $totPegawaiProbetion = Employee::where('status', '=', 'probetion')->where('is_wafat', '=', false)->count();
        $totPegawaiKontrak = Employee::where('status', '=', 'contract')->where('is_wafat', '=', false)->count();
        $totPegawaiTetap = Employee::where('status', '=', 'permanent')->where('is_wafat', '=', false)->count();
        $userTotal = User::count();
        $row_user = User::where('email', auth()->user()->email)->first();
        if (auth()->user()->hasRole('admin')) {
            $judul = "Dasbor Admin";
            return view('dasbor', compact('judul', 'totPegawai', 'totPegawaiBaru', 'totPegawaiProbetion', 'totPegawaiKontrak', 'totPegawaiTetap', 'userTotal'));
        } else if (auth()->user()->hasRole('hrd')) {
            $judul = "Dasbor HRD";
            return view('dasbor_hrd', compact('judul'));
        } else if (auth()->user()->hasRole('bendahara')) {
            $judul = "Dasbor Bendahara";
            return view('dasbor_bendahara', compact('judul'));
        } else {
            return redirect(404);
        }
    }

    public function jsonHabisKontrak()
    {
        $now = Carbon::now();
        $data = Employee::select('join_date')->first();
        $finishTime = Carbon::parse($data->join_date);

        $totalDuration = $finishTime->diffInMonths($now);

        dd($totalDuration);
    }
}
