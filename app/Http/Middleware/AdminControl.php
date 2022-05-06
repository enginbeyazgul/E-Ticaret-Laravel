<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminControl
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::get('durum')==2){
            return $next($request);
        }
        else if(Session::get('durum')==1){
            return redirect('admin-paneli')->withErrors(['msg' => 'Yetkisiz Erişim!','alert'=>'alert-warning']);
        }
        else{
            return redirect()->back()->withErrors(['msg' => 'Yetkisiz Erişim!','alert'=>'alert-warning']);
        }
    }
}
