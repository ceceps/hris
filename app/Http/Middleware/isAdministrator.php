<?php

namespace App\Http\Middleware;

use Closure;

class isAdministrator
{
    public function handle($request, Closure $next)
    {
        $email = session('email');
        $status = session('status');
        if($email == Null){
            $request->session()->flash('error','<span class="btn btn-danger">Failed! You`re not Sign in</span>');
            return redirect('/');
        }

        if($status=="ADMIN"){
            return $next($request);
        }

        return redirect('/logout');
    }
}
