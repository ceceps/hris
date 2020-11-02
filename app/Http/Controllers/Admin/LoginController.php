<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(empty(Auth::user())){
            return view('login');
        }else{
            return redirect('/dasbor');
        }
    }

    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $email = $request->email;
        $password = $request->password;

        $data = User::select('email,password')->where('email',$email)->count();
        if($data>0){ //apakah email tersebut ada atau tidak
            $data = User::where('email',$email)->first();
            if ($data->active == 1) {
                $credentials = request(['email', 'password']);

                if (Auth::attempt($credentials)){
                    Session::put('name',$data->name);
                    Session::put('email',$data->email);
                    Session::put('user_id',$data->id);
                    Session::put('status',$data->status);
                    Session::put('login',TRUE);
                    $arr = array('msg' => 'Login Success,...',
                    'redirect' => url('/dasbor'),'status' => true);
                }
                else{
                    $arr = array('msg' => 'Failed Login ! Email or Password is wrong','status' => false);
                }
            } else {
                $arr = array('msg' => 'Failed Login ! Your Account Is Not Active','status' => false);
            }
        }else{
            $arr = array('msg' => 'Gagal! Email belum terdaftar','status' => false);
        }

        return response()->json($arr);
    }
    public function destroy(Request $request)
    {
        Session::forget('name');
        Session::forget('email');
        Session::forget('login');
        Auth::logout();
        return redirect('/');

    }
}
