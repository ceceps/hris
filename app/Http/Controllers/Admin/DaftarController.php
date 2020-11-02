<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;

class DaftarController extends Controller
{
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'      => 'required|max:100',
            'email'     => 'required|max:100|unique:users',
            'password'  => 'required|min:8|max:100',
        ]);

        $result = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'level'     => 2
        ]);

        $arr = array('msg' => 'Terjadi kesalahan saat penginputan sialahkan coba lagi beberapa menit kemudian','status' => false);
        if($result){
            Session::put('email',$request->email);
            $judul = 'Pendaftaran Admin';
            $nama = $request->name;
            $message = 'Pendaftaran sebagai admin atas nama'.$request->name;
            $arr = array('msg' => 'Data User berhasil di tambahkan, silahkan hubungi administrator untuk aktivasi akun', 'session' => session('email'), 'status' => true );
        }

        return \Response::json($arr);
    }
}
