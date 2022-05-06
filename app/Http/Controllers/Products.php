<?php

namespace App\Http\Controllers;

use App\Models\Asepet;
use App\Models\Aurun;
use App\Models\Aurun_kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Products extends Controller
{
    public function products(Request $request){
        $data['title'] = "Ürünler";
        if($request->k){$k = $request->k;}
        else{$k=1;}
        $data['kategoriler'] = Aurun_kategori::get();
        $data['urunler'] = Aurun::where('kategori_kodu',$k)->get();
        return view('layouts.products',$data);
    }
    public function product(Request $request){
        $data['title'] = "Ürün Detayı";
        $data['urun'] = Aurun::where('urun_kodu',$request->urunKodu)->first();
        return view('layouts.product',$data);
    }
//{return redirect('/')->withErrors(['msg' => 'Lütfen giriş yapın! ','alert'=>'alert-warning']);}
    public function productP(Request $request){
        if($request->urunId && !empty(Session::get('musteri_no')) ){
            $sepet = Asepet::where("urun_kodu",$request->urunId)->where("musteri_no",Session::get('musteri_no'))->first();
            if($sepet){
                $sepeteEkle = $sepet->adet = $sepet->adet+$request->urunAdet;
                $sepet->save();
                if ($sepeteEkle) {
                    return true;
                }
                else{return 0;}
            }
            elseif(empty($sepet)){
                $sepeteEkle = Asepet::create([
                    'musteri_no'=>Session::get('musteri_no'),
                    'urun_kodu'=>$request->urunId,
                    'adet'=>$request->urunAdet,
                ]);
                if ($sepeteEkle) {
                    return true;
                }
                else{return 0;}
            }
            else{return 0;}
        }
        elseif(Session::get('durum') != 1){return 0;}
    }
}
