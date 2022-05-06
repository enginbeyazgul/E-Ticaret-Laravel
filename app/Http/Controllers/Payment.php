<?php

namespace App\Http\Controllers;

use App\Models\Amusteri;
use App\Models\Asepet;
use App\Models\Asiparis;
use App\Models\Asiparis_detay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Payment extends Controller
{
    public function payment(){
        $sepet = Amusteri::where('mail',Session::get('mail'))->first()->sepet()->get();
        $siparisEkle = Asiparis::create([
            'musteri_no'=>Session::get('musteri_no'),
            'durum'=>0,
            'teslimat'=>date("Y-m-d H:i:s",strtotime('+2 day')),
        ]);
        if ($siparisEkle){
            $siparis = Asiparis::where("musteri_no",Session::get('musteri_no'))->first();
            $sepet = Amusteri::where('mail',Session::get('mail'))->first()->sepet()->get();
            foreach ($sepet as $urunler){
                $siparisDetayEkle = Asiparis_detay::create([
                    'siparis_no'=>$siparis['siparis_no'],
                    'urun_kodu'=>$urunler['urun_kodu'],
                    'adet'=>$urunler['adet'],
                ]);
                $urunler->delete();
            }
            return redirect('/sepet')->withErrors(['msg' => 'Sipariş Verildi!','alert'=>'alert-warning']);
        }
    }
}
