<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUs extends Controller
{
    public function aboutUs(){
        $data['title'] = "Hakkımızda";
        return view('layouts.aboutUs',$data);
    }
}
