<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Logout extends Controller
{
    public function logout(){
        Session::flush();
        return redirect('/')->withErrors(['msg' => 'Çıkış yapıldı.','alert'=>'alert-warning']);
    }
    public function logouta(){
        Session::flush();
        return redirect('/admin-paneli')->withErrors(['msg' => 'Çıkış yapıldı.','alert'=>'alert-warning']);
    }
}
