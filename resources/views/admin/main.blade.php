@extends('admin')
@section('body')


<div class="mobile-sticky-body-overlay"></div>

<div class="wrapper">
    <aside class="left-sidebar bg-sidebar-dark">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div style="background-color: transparent" class="app-brand">
                <a class="justify-content-center p-0" href="{{route('adminpage')}}">
                    <img style="max-width: 150px" src="{{asset('img/core-img/logo-2.png')}}" alt="">
                </a>
            </div>
            <hr style="margin-top:0" class="separator" />
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li class="active">
                        <a class="sidenav-item-link" href="{{route('adminpage')}}">
                            <i class="far fa-shopping-bag"></i>
                            <span class="nav-text">Sİparİşler</span>
                        </a>
                    </li>
                    <li class="" >
                        <a class="sidenav-item-link" href="{{route('adminproducts')}}">
                            <i class="far fa-tag"></i>
                            <span class="nav-text">Ürünler</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="sidenav-item-link" href="{{route('admincustomers')}}">
                            <i class="far fa-user"></i>
                            <span class="nav-text"> Müşteriler</span>
                        </a>
                    </li>
                </ul>
                <hr class="separator" />
            </div>
        </div>
    </aside>



    <div class="page-wrapper">
        <!-- Header -->
        <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg justify-content-end">

                <div class="navbar-right ">
                    <ul class="nav navbar-nav">
                        <!-- User Account -->
                        <li class="dropdown user-menu">
                            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <img src="{{asset('img/core-img/login.png')}}" class="user-image" alt="User Image" />
                                <span class="d-none d-lg-inline-block">{{\Illuminate\Support\Facades\Session::get('adsoyad')}}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <!-- User image -->
                                <li class="dropdown-header">
                                    <img src="{{asset('img/core-img/login.png')}}" class="img-circle" alt="User Image" />
                                    <div class="d-inline-block">
                                        {{\Illuminate\Support\Facades\Session::get('adsoyad')}} <small class="pt-1">{{\Illuminate\Support\Facades\Session::get('mail')}}</small>
                                    </div>
                                </li>

                                <li>
                                    <a data-bs-toggle="offcanvas" aria-controls="offcanvasTop" data-bs-target="#offcanvasTopProfile" href="#"><i class="mdi mdi-account"></i> Profili düzenle</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="{{route('logouta')}}"> <i class="mdi mdi-logout"></i> Çıkış yap</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Modal Sipariş Ayrıntı -->
        <div class="modal fade" id="exampleModallarge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLarge">Müşteri Bilgileri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fname">Adı Soyadı</label>
                                            <input disabled id="ad" name="ad" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lname">Mail</label>
                                            <input disabled id="mail" name="resim1" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="city">Adres</label>
                                            <textarea disabled id="adres" name="aciklama" rows="5" type="text" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="State">Telefon</label>
                                                    <input disabled class="form-control" name="kategori_kodu" id="telefon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Kapat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="content">

                <div class="row">
                    <div class="col-12">
                        <!-- Recent Order Table -->
                        <div class="card card-table-border-none" id="recent-orders">
                            <div class="card-header justify-content-between">
                                <h1>Gelen Siparişler</h1>
                            </div>
                            @if($errors->any())
                                <div style="width: 350px;margin: 5px auto;align-self: center;" class="alert {{$errors->first('alert')}} alert-dismissible text-white" role="alert">
                                    <span class="text-sm text-muted"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</span>
                                    <button type="button" class="btn-close text-sm opacity-5 hover-sari" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                            @endif
                            <div class="card-body pt-0 pb-5">

                                    @foreach($siparisler as $siparis)
                                        @php
                                            $musteri = $siparis->musteriBilgi()->first();
                                        @endphp
                                        <div id="accordion2" class="accordion accordion-shadow">
                                            <div class="card">
                                                <div class="card-header" id="headingFour">
                                                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Sipariş No</th>
                                                                <th>Durum</th>
                                                                <th>İşlem</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr class="text-center">
                                                            <td>
                                                                <button onclick="siparisAyrıntı('{{$siparis['musteri_no']}}','{{$musteri['ad']." ".$musteri['soyad']}}','{{$musteri['mail']}}','{{$musteri['telefon']}}','{{$musteri['adres']}}',)" type="button" data-toggle="modal" data-target="#exampleModallarge" title="Ayrıntılar" style="margin: 10px;padding: 3px 15px;border: 1px solid #aaa" class="text-dark ayrinti" href="">{{$siparis['musteri_no']}}</button>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-{{renk($siparis['durum'])}}">{{$siparis['durum']==0?"Bekliyor":"Kargolandı"}}</span>
                                                            </td>
                                                            <td>
                                                                <form action="{{route('adminpageorders')}}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="siparisNo" value="{{$siparis['siparis_no']}}">
                                                                    <button {{$siparis['durum']==1?"disabled":""}} style="cursor:{{$siparis['durum']==0?'pointer':'no-drop'}};margin: 10px;padding: 5px 10px;" name="siparis" class="{{$siparis['durum']==0?'btn-primary':'btn-secondary'}} btn-sm" type="submit">Gönderildi</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour{{$siparis['musteri_no']}}" aria-expanded="false" aria-controls="collapseFour"></button>

                                                </div>

                                                <div id="collapseFour{{$siparis['musteri_no']}}" class="collapse" aria-labelledby="headingFour" data-parent="#accordion2" style="">
                                                    <div class="card-body">
                                                        <table class="table card-table mt-0 table-striped table-responsive table-responsive-large" style="width:100%">
                                                            <thead>
                                                            <tr class="text-center">
                                                                <th>Müşteri No</th>
                                                                <th>Ürün Adı</th>
                                                                <th>Adet</th>
                                                                <th>Tarih</th>
                                                                <th>Fiyat</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                        @foreach($siparis->detay()->get() as $detay)
                                                            @php
                                                                $musteri = $siparis->musteriBilgi()->first();
                                                                $urun = $detay->urunAd()->first();
                                                            @endphp

                                                                <tr class="text-center">
                                                                    <td><button onclick="siparisAyrıntı('{{$siparis['musteri_no']}}','{{$musteri['ad']." ".$musteri['soyad']}}','{{$musteri['mail']}}','{{$musteri['telefon']}}','{{$musteri['adres']}}',)" type="button" data-toggle="modal" data-target="#exampleModallarge" title="Ayrıntılar" style="padding: 3px 15px;border: 1px solid #aaa" class="text-dark ayrinti" href="">{{$siparis['musteri_no']}}</button></td>
                                                                    <td>{{$urun['ad']}}</td>
                                                                    <td>{{$detay['adet']}}</td>
                                                                    <td>{{$siparis['tarih']}}</td>
                                                                    <td>{{$urun['fiyat']*$detay['adet']}} ₺</td>
                                                                </tr>
                                                        @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



{{--                                        @foreach($siparis->detay()->get() as $detay)--}}
{{--                                        @php--}}
{{--                                            $musteri = $siparis->musteriBilgi()->first();--}}
{{--                                            $urun = $detay->urunAd()->first();--}}
{{--                                        @endphp--}}

{{--                                        <tr class="text-center">--}}
{{--                                            <td><button onclick="siparisAyrıntı('{{$siparis['musteri_no']}}','{{$musteri['ad']." ".$musteri['soyad']}}','{{$musteri['mail']}}','{{$musteri['telefon']}}','{{$musteri['adres']}}',)" type="button" data-toggle="modal" data-target="#exampleModallarge" title="Ayrıntılar" style="padding: 3px 15px;border: 1px solid #aaa" class="text-dark ayrinti" href="">{{$siparis['musteri_no']}}</button></td>--}}
{{--                                            <td>{{$urun['ad']}}</td>--}}
{{--                                            <td>{{$detay['adet']}}</td>--}}
{{--                                            <td>{{$siparis['tarih']}}</td>--}}
{{--                                            <td>{{$urun['fiyat']*$detay['adet']}} ₺</td>--}}
{{--                                            <td>--}}
{{--                                                <span class="badge badge-{{renk($siparis['durum'])}}">{{$siparis['durum']==0?"Bekliyor":"Kargolandı"}}</span>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                            <form action="{{route('adminpageorders')}}" method="post">--}}
{{--                                                @csrf--}}
{{--                                                <input type="hidden" name="siparisNo" value="{{$siparis['siparis_no']}}">--}}
{{--                                                <button name="siparis" class="btn btn-primary btn-sm" type="submit">Gönderildi</button>--}}
{{--                                            </form>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        @endforeach--}}
                                    @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer mt-auto">
            <div class="copyright bg-white">
                <p class="text-center">Copyright © 2022 Tüm hakları saklıdır!
                    Engin Beyazgül & Serhat Kaçmaz
                </p>
            </div>
        </footer>

    </div>
</div>
<script>
    function siparisAyrıntı(musteri_no,ad,mail,telefon,adres){
        $("#musteri_no").val(musteri_no);
        $("#ad").val(ad);
        $("#mail").val(mail);
        $("#telefon").val(telefon);
        $("#adres").val(adres);
    }
</script>
@endsection
