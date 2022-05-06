<?php

namespace App\Http\Controllers;

use App\Models\Amusteri;
use App\Models\Asepet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Cart extends Controller
{
    public function cart(){
        $data['title'] = "Sepetim";
        $data['musteri'] = Amusteri::where("musteri_no",Session::get('musteri_no'))->first();
        return view('layouts.cart',$data);
    }
    public function cartPost(Request $request){
        $data['title'] = "Sepetim";
        $data['musteri'] = Amusteri::where("musteri_no",Session::get('musteri_no'))->first();
        if($request->has('eksi')){
            $sepet = Amusteri::where("mail",Session::get('mail'))->first()->sepet()->where("urun_kodu",$request->urun_kodu)->first();
            $eksilt = $sepet->adet = $sepet->adet-1;
            $sepet->save();
            if ($eksilt) {
                return redirect('/sepet')->withErrors(['msg' => 'İşlem tamamlandı!','alert'=>'alert-warning']);
            }
        }
        elseif($request->has('arti')){
            $sepet = Amusteri::where("mail",Session::get('mail'))->first()->sepet()->where("urun_kodu",$request->urun_kodu)->first();
            $arttir = $sepet->adet = $sepet->adet+1;
            $sepet->save();
            if ($arttir) {
                return redirect('/sepet')->withErrors(['msg' => 'İşlem tamamlandı!','alert'=>'alert-warning']);
            }
        }
        else{return view('layouts.cart',$data);}
    }
}
