<?php

namespace App\Http\Controllers;

use App\Models\Amusteri;
use App\Models\Asiparis;
use App\Models\Asiparis_detay;
use App\Models\Aurun;
use App\Models\Aurun_kategori;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Admin extends Controller
{
    public function loginPage(){
        $data['title'] = "Admin Giriş";
        return view('admin.login',$data);
    }
    public function loginProcess(Request $request){
        $data['title'] = "Admin Giriş";
        $data['admin'] = Amusteri::where("mail",$request->mail)->where("sifre",$request->sifre)->where("durum",2)->first();
        if ($request->has('giris')){
            if(!empty($data['admin'])){
                Session::put('mail',$data['admin']['mail']);
                Session::put('musteri_no',$data['admin']['musteri_no']);
                Session::put('ad',$data['admin']['ad']);
                Session::put('soyad',$data['admin']['soyad']);
                Session::put('musteri_no',$data['admin']['musteri_no']);
                Session::put('telefon',$data['admin']['telefon']);
                Session::put('adres',$data['admin']['adres']);
                Session::put('sifre',$data['admin']['sifre']);
                Session::put('durum',$data['admin']['durum']);
                Session::put('adsoyad',$data['admin']['ad']." ".$data['admin']['soyad']);
                return redirect('/admin-main');
            }
            else{return redirect('/admin-paneli')->withErrors(['msg' => 'Kullanıcı adı ya da şifre hatalı! ','alert'=>'alert-warning']);}
        }
        elseif ($request->has('sifre')){
            $admin = Amusteri::where("mail",$request->mail)->where("durum",2)->first();
            if (!empty($admin)){
                $sifreSifirla = Amusteri::where("musteri_no",$admin['musteri_no'])->first()->update([
                    'sifre'=>$request->gecici
                ]);
                if ($sifreSifirla){
                    //mail gönderme
                    $tmail = $request->mail;
                    $array = [
                        'name'=>'Sayın admin ',
                        'email'=>'Sisteme giriş için E-postanız : '.$request->mail.' ',
                        'sifre'=>'Geçici şifreniz : '.$request->gecici. ' ',
                        'mesaj'=>"Sisteme giriş bilgileriniz bu şekildedir."
                    ];
                    mail::send('admin.mail', $array, function ($message) use ($tmail) {
                        $message->subject("Sisteme Giriş Bilgileri");
                        $message->to($tmail);
                    });
                    return redirect('/admin-paneli')->withErrors(['msg' => 'Sıfırlama maili gönderildi!','alert'=>'alert-success']);
                }
            }
            else{
                return redirect('/admin-paneli')->withErrors(['msg' => 'Bu maille admin bulunamadı','alert'=>'alert-danger']);
            }
        }
    }
    public function adminPage(){
        $data['title'] = "Admin Paneli | Siparişler";
        $data['siparisler'] = Asiparis::get();
        return view('admin.main',$data);
    }
    public function adminPageOrders(Request $request){
        if ($request->has('siparis')){
            $siparisGonder = Asiparis::where("siparis_no",$request->siparisNo)->first()->update([
                'durum'=>1
            ]);
            if ($siparisGonder){
                return redirect('/admin-main')->withErrors(['msg' => 'Sipariş gönderildi!','alert'=>'alert-success']);
            }
            else{
                return redirect('/admin-main')->withErrors(['msg' => 'Sipariş gönderilemedi!','alert'=>'alert-danger']);
            }
        }
        elseif ($request->has('form3')){
            $adminguncelle = Amusteri::where("musteri_no",2)->first()->update([
                'ad'=>$request->ad,
                'soyad'=>$request->soyad,
                'mail'=>$request->mail,
                'sifre'=>$request->sifre,
                'telefon'=>$request->telefon,
                'adres'=>"boş",
                'durum'=>2
            ]);
            if ($adminguncelle){
                $data['admin'] = Amusteri::where("mail",$request->mail)->where("sifre",$request->sifre)->where("durum",2)->first();
                Session::put('mail',$data['admin']['mail']);
                Session::put('musteri_no',$data['admin']['musteri_no']);
                Session::put('ad',$data['admin']['ad']);
                Session::put('soyad',$data['admin']['soyad']);
                Session::put('musteri_no',$data['admin']['musteri_no']);
                Session::put('telefon',$data['admin']['telefon']);
                Session::put('adres',$data['admin']['adres']);
                Session::put('sifre',$data['admin']['sifre']);
                Session::put('durum',$data['admin']['durum']);
                Session::put('adsoyad',$data['admin']['ad']." ".$data['admin']['soyad']);
                return redirect('/admin-main')->withErrors(['msg' => 'Bilgileriniz güncellendi!','alert'=>'alert-success']);
            }
            else{
                return redirect('/admin-main')->withErrors(['msg' => 'Bigileriniz güncellenemedi!','alert'=>'alert-danger']);
            }
        }
    }
    public function products(Request $request){
        $data['title'] = "Admin Paneli | Ürünler";
        $data['kategoriler'] = Aurun_kategori::get();
        $data['urunler'] = Aurun::paginate(5);
        return view('admin.products',$data);
    }
    public function productAdd(Request $request){
        if ($request->has('urunEkle')){
            $isim = $_FILES["resim1"]["name"];
            $dosya = $_FILES["resim1"]["tmp_name"];
            $resim_url = "img/product-img/".$isim ;
            $resimUpload = @copy($dosya, $resim_url);
            if ($resimUpload){
                $urunEkle = Aurun::create([
                    'kategori_kodu'=>$request->kategori_kodu,
                    'stok'=>$request->stok,
                    'fiyat'=>$request->fiyat,
                    'ad'=>$request->ad,
                    'aciklama'=>$request->aciklama,
                    'resim1'=>$resim_url,
                ]);
                if ($urunEkle){
                    return redirect('/admin-main/products')->withErrors(['msg' => 'Ürün eklendi!','alert'=>'alert-success']);
                }
                else{return redirect('/admin-main/products')->withErrors(['msg' => 'Ürün eklenemedi!','alert'=>'alert-warning']);}
            }
        }
        elseif ($request->has('urunSil')){
            $urun = Aurun::where("urun_kodu",$request->urunId)->first();
            $urunSil = $urun->delete();
            if ($urunSil){
                return redirect('/admin-main/products')->withErrors(['msg' => 'Ürün silindi!','alert'=>'alert-success']);
            }
            else{return redirect('/admin-main/products')->withErrors(['msg' => 'Ürün silinemedi!','alert'=>'alert-warning']);}
        }
        elseif ($request->has('urunDuzenle')){
            $isim = $_FILES["resim1"]["name"];
            $dosya = $_FILES["resim1"]["tmp_name"];
            $resim_url = "img/product-img/".$isim ;
            $resimUpload = @copy($dosya, $resim_url);
            if ($resimUpload){
                $urunGuncelle = Aurun::where("urun_kodu",$request->urun_kodu)->first()->update([
                    'kategori_kodu'=>$request->kategori_kodu,
                    'stok'=>$request->stok,
                    'fiyat'=>$request->fiyat,
                    'ad'=>$request->ad,
                    'aciklama'=>$request->aciklama,
                    'resim1'=>$resim_url,
                ]);
                if ($urunGuncelle){
                    return redirect('/admin-main/products')->withErrors(['msg' => 'Ürün güncellendi!','alert'=>'alert-success']);
                }
                else{return redirect('/admin-main/products')->withErrors(['msg' => 'Ürün güncellenemedi!','alert'=>'alert-warning']);}
            }
        }
    }
    public function customers(){
        $data['title'] = "Admin Paneli | Müşteriler";
        $data['musteriler'] = Amusteri::where("durum",1)->orWhere("durum",0)->paginate(4);
        return view('admin.customers',$data);
    }
    public function customerAdd(Request $request){
        if ($request->has('musteriEkle'))
        {
            $musteriEkle = Amusteri::create([
                'ad'=>$request->ad,
                'soyad'=>$request->soyad,
                'mail'=>$request->mail,
                'sifre'=>$request->sifre,
                'telefon'=>$request->telefon,
                'adres'=>$request->adres,
                'durum'=>$request->durum,
            ]);
            if ($musteriEkle){
                return redirect('/admin-main/customers')->withErrors(['msg' => 'Müsteri Eklendi!','alert'=>'alert-success']);
            }
            else{return redirect('/admin-main/customers')->withErrors(['msg' => 'Müşteri Eklenemedi!','alert'=>'alert-warning']);}
        }
        elseif ($request->has('musteriSil')){
            $musteri = Amusteri::where("musteri_no",$request->musteriNo)->first();
            $musteriSil = $musteri->delete();
            if ($musteriSil){
                return redirect('/admin-main/customers')->withErrors(['msg' => 'Müşteri silindi!','alert'=>'alert-success']);
            }
            else{return redirect('/admin-main/customers')->withErrors(['msg' => 'Müşteri silinemedi!','alert'=>'alert-warning']);}
        }
        elseif ($request->has('musteriDuzenle')){
            $musteriGuncelle = Amusteri::where("musteri_no",$request->musteriNo)->first()->update([
                'ad'=>$request->ad,
                'soyad'=>$request->soyad,
                'mail'=>$request->mail,
                'sifre'=>$request->sifre,
                'telefon'=>$request->telefon,
                'adres'=>$request->adres,
                'durum'=>$request->durum,
            ]);
            if ($musteriGuncelle){
                return redirect('/admin-main/customers')->withErrors(['msg' => 'Müşteri güncellendi!','alert'=>'alert-success']);
            }
            else{return redirect('/admin-main/customers')->withErrors(['msg' => 'Müşteri güncellenemedi!','alert'=>'alert-warning']);}
        }
    }
}
