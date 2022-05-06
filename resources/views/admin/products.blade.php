@extends('admin')
@section('body')

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

        <!--
    ====================================
    ——— LEFT SIDEBAR WITH FOOTER
    =====================================
    -->
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
                        <li >
                            <a class="sidenav-item-link" href="{{route('adminpage')}}">
                                <i class="far fa-shopping-bag"></i>
                                <span class="nav-text">Sİparİşler</span>
                            </a>
                        </li>
                        <li class="active" >
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

            <!-- Modal Ürün Ekle -->
            <div class="modal fade" id="exampleModallarge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLarge">Ürün Ekle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('adminproductadd')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fname">Ürün Adı</label>
                                                <input name="ad" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lname">Resim</label>
                                                <input name="resim1" type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="city">Açıklama</label>
                                                <textarea name="aciklama" rows="5" type="text" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="State">Fiyat</label>
                                                        <input name="fiyat" type="text" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Zip">Stok</label>
                                                        <input name="stok" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="State">Ürün Kategorisi</label>
                                                        <select class="form-control" name="kategori_kodu" id="">
                                                            @foreach($kategoriler as $kategori)
                                                                <option value="{{$kategori['kategori_kodu']}}">{{$kategori['ad']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button name="urunEkle" type="submit" class="btn btn-primary btn-pill">Ekle</button>
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">İptal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Ürün Düzenle -->
            <div class="modal fade" id="exampleModallarge1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLarge">Ürün Düzenle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="{{route('adminproductadd')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fname">Ürün Adı</label>
                                                <input id="ad" name="ad" type="text" class="form-control">
                                                <input id="urun_kodu" name="urun_kodu" type="hidden" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lname">Resim</label>
                                                <input id="urun_resmi" name="resim1" type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="city">Açıklama</label>
                                                <textarea id="aciklama" name="aciklama" rows="5" type="text" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="State">Fiyat</label>
                                                        <input id="fiyat" name="fiyat" type="text" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Zip">Stok</label>
                                                        <input id="stok" name="stok" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="State">Ürün Kategorisi</label>
                                                        <select class="form-control" name="kategori_kodu" id="kategori">
                                                            @foreach($kategoriler as $kategori)
                                                                <option value="{{$kategori['kategori_kodu']}}">{{$kategori['ad']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button name="urunDuzenle" type="submit" class="btn btn-primary btn-pill">Güncelle</button>
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">İptal</button>
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
                                    <h1>Ürünler</h1>
                                    <div>
                                        <button type="button" data-toggle="modal" data-target="#exampleModallarge" style="font-size: 30px;border-radius: 50%; padding: 11px 25px" class="btn btn-warning text-white" title="Ekle">+</button>
                                    </div>
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
                                    <table class="table card-table table-striped table-responsive table-responsive-large" style="width:100%">
                                        <thead>
                                        <tr class="text-center">
                                            <th class="p-0 pr-2">Ürün No</th>
                                            <th class="p-0 pr-2">Resim</th>
                                            <th class="p-0 pr-2">Adı</th>
                                            <th class="p-0 pr-2">Açıklama</th>
                                            <th class="p-0 pr-2">Fiyat</th>
                                            <th class="p-0 pr-2">Stok</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($urunler as $urun)
                                        <tr class="text-center p-0">
                                            <td class="p-0 pr-2">{{$urun['urun_kodu']}}</td>
                                            <td class="p-0 pr-2">
                                                <img width="55px" src="{{asset($urun['resim1'])}}" alt="" title="" />
                                            </td>
                                            <td class="p-0 pr-2">{{$urun['ad']}}</td>
                                            <td class="p-0 pr-2">{{substr($urun['aciklama'],0,50)}}</td>
                                            <td class="p-0 pr-2">{{$urun['fiyat']}} ₺</td>
                                            <td class="p-0 pr-2">{{$urun['stok']}} </td>
                                            <td class="p-0 pr-2">
                                                <div class="dropdown show d-inline-block widget-dropdown">
                                                    <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                        <li class="dropdown-item">
                                                            <button onclick="urunDuzenle('{{$urun['urun_kodu']}}','{{$urun['ad']}}','{{$urun['aciklama']}}','{{$urun['fiyat']}}','{{$urun['stok']}}','{{$urun['kategori_kodu']}}','{{$urun['resim1']}}')" data-target="#exampleModallarge1" data-toggle="modal" style="display: flex; padding: 5px 20px; width: 100%; " >Düzenle</button>
                                                        </li>
                                                        <li class="dropdown-item">
                                                            <form action="{{route('adminproductadd')}}" method="post">
                                                                @csrf
                                                                <input name="urunId" value="{{$urun['urun_kodu']}}" type="hidden">
                                                                <button name="urunSil" style="display: flex; padding: 5px 20px; width: 100%; " >Sil</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <span id="navigat" class="text-center">{{$urunler->links()}}</span>
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
        function urunDuzenle(urun_kodu,ad,aciklama,fiyat,stok,kategori,resim){
            $("#urun_kodu").val(urun_kodu);
            $("#ad").val(ad);
            $("#aciklama").val(aciklama);
            $("#fiyat").val(fiyat);
            $("#stok").val(stok);
            $("#kategori").val(kategori);
        }
    </script>
@endsection
