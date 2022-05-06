<?php

namespace App\Http\Controllers;

use App\Models\Amusteri;
use App\Models\Asepet;
use App\Models\Aurun;
use Mail;
use App\Models\Aurun_kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Home extends Controller
{
    public function index(){
        $data['title'] = "Anasayfa";
        $data['musteri'] = Amusteri::where("mail",Session::get('mail'))->first();
        $data['urunler'] = Aurun::paginate(7);
        return view('layouts.main',$data);
    }
    public function indexLogin(Request $request){
        $data['musteri'] = Amusteri::where("mail",$request->mail)->where("sifre",$request->sifre)->where("durum",1)->first();
        if(!empty($data['musteri']) && $request->has('form1')){
            Session::put('mail',$data['musteri']['mail']);
            Session::put('musteri_no',$data['musteri']['musteri_no']);
            Session::put('ad',$data['musteri']['ad']);
            Session::put('soyad',$data['musteri']['soyad']);
            Session::put('telefon',$data['musteri']['telefon']);
            Session::put('adres',$data['musteri']['adres']);
            Session::put('sifre',$data['musteri']['sifre']);
            Session::put('durum',$data['musteri']['durum']);
            Session::put('adsoyad',$data['musteri']['ad']." ".$data['musteri']['soyad']);
            if (Session::get('durum')){
                return redirect('/')->withErrors(['msg' => 'Hoşgeldin '.Session::get('adsoyad'),'alert'=>'alert-warning']);
            }
            else{return redirect('/')->withErrors(['msg' => 'Kullanıcı adı ya da şifre hatalı! ','alert'=>'alert-warning']);}
        }
        elseif($request->has('form2')){
            $musteriEkle = Amusteri::create([
                'ad'=>$request->ad,
                'soyad'=>$request->soyad,
                'mail'=>$request->mail,
                'sifre'=>$request->sifre,
                'telefon'=>$request->telefon,
                'adres'=>$request->adres,
                'durum'=>"1",
            ]);
            if ($musteriEkle){
                return redirect('/')->withErrors(['msg' => 'Kayıt başarılı!','alert'=>'alert-warning']);
            }
            else{return redirect('/')->withErrors(['msg' => 'Kayıt edilemedi! ','alert'=>'alert-warning']);}
        }
        elseif($request->has('form3')){
            $musteri = Amusteri::where("mail",Session::get('mail'))->first();
            $musteriGuncelle = Amusteri::where("musteri_no",$musteri['musteri_no'])->first()->update([
                'ad' => $request->ad,
                'soyad' => $request->soyad,
                'mail' => $request->mail,
                'sifre' => $request->sifre,
                'telefon' => $request->telefon,
                'adres' => $request->adres,
                'durum' => $request->durum,
            ]);
            $amusteri = Amusteri::where("mail",Session::get('mail'))->first();
            if($musteriGuncelle){
                Session::put('mail',$amusteri['mail']);
                Session::put('musteri_no',$amusteri['musteri_no']);
                Session::put('ad',$amusteri['ad']);
                Session::put('soyad',$amusteri['soyad']);
                Session::put('telefon',$amusteri['telefon']);
                Session::put('adres',$amusteri['adres']);
                Session::put('sifre',$amusteri['sifre']);
                Session::put('durum',$amusteri['durum']);
                Session::put('adsoyad',$amusteri['ad']." ".$amusteri['soyad']);
                return redirect('/')->withErrors(['msg' => 'Bilgileriniz güncellendi!','alert'=>'alert-warning']);
            }
            else{return redirect('/')->withErrors(['msg' => 'Bilgileriniz güncellenirken hata.','alert'=>'alert-warning']);}
        }
        elseif ($request->has('sifre')) {
            $musteri = Amusteri::where("mail", $request->mail)->where("durum", 1)->first();
            if (!empty($musteri)) {
                $sifreSifirla = Amusteri::where("musteri_no", $musteri['musteri_no'])->first()->update([
                    'sifre' => $request->gecici
                ]);
                if ($sifreSifirla) {
                    //mail gönderme
                    $tmail = $request->mail;
                    $array = [
                        'name' => 'Sayın kullanıcı ',
                        'email' => 'Sisteme giriş için E-postanız:' . $request->mail . ' ',
                        'sifre' => 'Geçici şifreniz : ' . $request->gecici . ' ',
                        'mesaj' => "Sisteme giriş bilgileriniz bu şekildedir."
                    ];
                    mail::send('admin.mail', $array, function ($message) use ($tmail) {
                        $message->subject("Sisteme Giriş Bilgileri");
                        $message->to($tmail);
                    });
                    return redirect('/')->withErrors(['msg' => 'Sıfırlama maili gönderildi!', 'alert' => 'alert-success']);
                }
            }
            else{return redirect('/')->withErrors(['msg' => 'Sıfırlama maili gönderilemedi! ','alert'=>'alert-warning']);}
        }
        else{return redirect('/')->withErrors(['msg' => 'Kullanıcı adı ya da şifre hatalı! ','alert'=>'alert-warning']);}
    }
}
