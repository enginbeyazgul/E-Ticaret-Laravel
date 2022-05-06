<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title  -->
    <title>{{$title}}</title>
    <!-- Favicon  -->
    <link rel="icon" href="{{asset('img/core-img/favicon.ico')}}">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>

<div style="display: flex;position: relative; width: 100%; height: 40px; border-bottom: 1px solid #fbb710; justify-content: space-evenly;" class="topnavbar cart-fav-search">

    @if((\Illuminate\Support\Facades\Session::get('durum'))!=1)
        <a style="display: block;
    text-transform: uppercase;
    font-size: 15px;
    padding: 5px 0;
    color: #131212;
    line-height: 1;" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" class="cart-nav hover-sari"><img style="height: 30px; margin-left: -3px" src="{{asset('img/core-img/login.png')}}" alt=""> Giriş Yap </a>
    @else
        <div style="width: 250px; display: inline-flex">
            <span style="display: block;
        text-transform: uppercase;
        font-size: 15px;
        padding: 5px 0;
        color: #131212;
        line-height: 1;" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopProfile" aria-controls="offcanvasTop" class="cart-nav hover-sari"><img style="height: 30px; margin-left: -3px" src="{{asset('img/core-img/login.png')}}" alt=""> {{\Illuminate\Support\Facades\Session::get('adsoyad')}}&nbsp;
            </span>
            <a  href="{{route('logout')}}"><i style="color: crimson; font-size: 17px; padding: 5px; margin-top: 5px;" class="far fa-sign-out cikis"></i></a>
        </div>
    @endif
    <a style="display: block;
    text-transform: uppercase;
    font-size: 15px;
    padding: 5px 0;
    color: #131212;
    line-height: 1;" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop2" aria-controls="offcanvasTop" class="cart-nav hover-sari"><img style="height: 30px; margin-left: -3px" src="{{asset('img/core-img/login.png')}}" alt=""> Kayıt ol</a>
    <div style=" padding:5px; float: right;" class="hava"><i style="opacity: 0.4;" class="fas fa-temperature-low"></i> {{hissedilen()}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i style="opacity: 0.4;" class="fas fa-temperature-low"></i>{{api()}}</div>
</div>
@if($errors->any())
    <div style="width: 350px;margin: 5px auto;align-self: center;" class="alert {{$errors->first('alert')}} alert-dismissible text-white" role="alert">
        <span class="text-sm text-muted"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</span>
        <button type="button" class="btn-close text-lg py-3 opacity-5 hover-sari" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div>
@endif

<!-- Search Wrapper Area Start -->
<div class="search-wrapper section-padding-50">
    <div class="search-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-content">
                    <form action="#" method="get">
                        <input type="search" name="search" id="search" placeholder="Type your keyword...">
                        <button type="submit"><img src="{{asset('img/core-img/search.png')}}" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Wrapper Area End -->

<!-- Şifremi Unuttum Area Start -->
<div style="height: 35vh!important;" class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTopSifre" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="m-auto" id="offcanvasTopLabel">Şifremi Sıfırla</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body m-auto">
        <form method="post" action="{{route('login')}}" class="row g-3 d-flex justify-content-center">
            @csrf
            <div class="row text-center">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">E-mail</label>
                    <input name="mail" type="email" class="form-control" id="inputEmail4">
                    <input name="gecici" type="hidden" value="{{rand(99999,999999)}}" class="form-control" id="inputEmail4">
                </div>
            </div>
            <div class="row mt-2 text-center">
                <div class="col-md-12">
                    <button name="sifre" type="submit"  class="btn btn-warning">Şifremi Sıfırla</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Login Area Start -->
<div style="height: 30vh!important;" class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header ">
        <h5 class="m-auto" id="offcanvasTopLabel ">Giriş Yap</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body m-auto">
        <form method="post" action="{{route('login')}}" class="row g-3">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <input name="mail" type="email" class="form-control" id="staticEmail2" placeholder="E-mail">
                </div>
                <div class="col-auto">
                    <input name="sifre" type="password" class="form-control" id="inputPassword2" placeholder="Şifre">
                </div>
                <div class="col-auto">
                    <button name="form1" type="submit" class="btn btn-warning mb-3">Giriş</button>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <p><a data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopSifre" aria-controls="offcanvasTop" class="text-blue" href="#">Şifremi Unuttum!</a></p>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Login Area End -->

<!-- Sign-in Area Start -->
<div style="height: 50vh!important;" class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop2" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="m-auto" id="offcanvasTopLabel">Kayıt Ol</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body m-auto">
        <form method="post" action="{{route('login')}}" class="row g-3 d-flex justify-content-center">
            @csrf
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">E-mail</label>
                <input name="mail" type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" class="form-label">Şifre</label>
                <input name="sifre" type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Ad</label>
                <input name="ad" type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Soyad</label>
                <input name="soyad" type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Telefon</label>
                <input name="telefon" type="text" class="form-control" id="inputZip">
            </div>
            <div class="col-md-11">
                <label for="inputAddress" class="form-label">Adres</label>
                <input name="adres" type="text" class="form-control" id="inputAddress" >
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <button name="form2" type="submit" class="btn btn-warning">Kaydol</button>
            </div>
            <div class="col-md-4"></div>
        </form>
    </div>
</div>
<!-- Sign-in Area End -->

<!-- Profile Area Start -->
<div style="height: 55vh!important;" class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTopProfile" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="m-auto" id="offcanvasTopLabel">Profil Bilgileri</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body m-auto">
        @php
            $amusteri = \App\Models\Amusteri::where("mail",\Illuminate\Support\Facades\Session::get('mail'))->first();
        @endphp
        <form method="post" action="{{route('login')}}" class="row g-3 d-flex justify-content-center">
            @csrf
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">E-mail</label>
                <input name="mail" type="email" class="form-control" id="inputEmail4" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==1?$amusteri['mail']:false}}">
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" class="form-label">Şifre</label>
                <input name="sifre" type="password" class="form-control" id="inputPassword4" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==1?$amusteri['sifre']:false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Ad</label>
                <input name="ad" type="text" class="form-control" id="inputZip" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==1?$amusteri['ad']:false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Soyad</label>
                <input name="soyad" type="text" class="form-control" id="inputZip" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==1?$amusteri['soyad']:false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Telefon</label>
                <input name="telefon" type="text" class="form-control" id="inputZip" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==1?$amusteri['telefon']:false}}">
            </div>
            <div class="col-md-9">
                <label for="inputAddress" class="form-label">Adres</label>
                <input name="adres" type="text" class="form-control" id="inputAddress" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==1?$amusteri['adres']:false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Hesap durumu</label>
                <select class="form-control" name="durum" id="">
                    <option value="1">aktif</option>
                    <option value="0">pasif</option>
                </select>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <button name="form3" type="submit" class="btn btn-warning">Güncelle</button>
            </div>
            <div class="col-md-4"></div>
        </form>
    </div>
</div>
<!-- Sign-in Area End -->

<!-- ##### Main Content Wrapper Start ##### -->
<div class="main-content-wrapper d-flex clearfix">

    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
            <a href="{{route('index')}}"><img src="{{asset('img/core-img/logo-1.png')}}" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Header Area Start -->
    <header class="header-area clearfix">
        <!-- Close Icon -->
        <div class="nav-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <!-- Logo -->
        <div class="logo" >
            <a href="{{route('index')}}"><img src="{{asset('img/core-img/logo-1.png')}}" alt=""></a>
        </div>
        <!-- Amado Nav -->
        <nav class="amado-nav" style="border-top: 1px solid #ddd; padding-top: 35px; margin-top: -50px">
            <ul>
                <li class="{{$title == "Anasayfa" ? "active" : ""}}"><a href="{{route('index')}}">Anasayfa</a></li>
                <li class="{{$title == "Ürünler" ? "active" : ""}}"><a href="{{route('products')}}">Ürünler</a></li>
                <li class="{{$title == "Hakkımızda" ? "active" : ""}}"><a href="{{route('aboutus')}}">Hakkımızda</a></li>
            </ul>
        </nav>
        <!-- Cart Menu -->
        <div class="cart-fav-search mb-100">
            <a href="{{route('cart')}}" class="cart-nav"><img src="{{asset('img/core-img/cart.png')}}" alt=""> Sepet <span>
                    @php
                        $adet = 0;
                    if (\Illuminate\Support\Facades\Session::get('durum')==1){
                        $sepet = \App\Models\Amusteri::where("mail",\Illuminate\Support\Facades\Session::get('mail'))->first()->sepet()->get();
                        }
                    @endphp
                    @if(isset($sepet) && \Illuminate\Support\Facades\Session::get('durum')==1)
                        @foreach($sepet as $veri)
                            @php $adet = $adet+$veri['adet']; @endphp
                        @endforeach
                            {{"(".$adet.")"}}
                    @else
                        {{"(".$adet.")"}}
                    @endif
                </span></a>
            <a href="#" class="search-nav"><img src="{{asset('img/core-img/search.png')}}" alt=""> Ara</a>
            </div>
    </header>
    <!-- Header Area End -->

    @yield('body')

<!-- ##### Footer Area Start ##### -->
<footer class="footer_area clearfix">
    <div class="container">
        <div class="row align-items-center">
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-4">
                <div class="single_widget_area">
                    <!-- Logo -->
                    <div class="footer-logo mr-50">
                        <a href="{{route('index')}}"><img src="{{asset('img/core-img/logo-2.png')}}" alt=""></a>
                    </div>
                    <!-- Copywrite Text -->
                    <p class="copywrite">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tüm hakları saklıdır!
                        <br>
                        Engin Beyazgül & Serhat Kaçmaz
                    </p>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-8">
                <div class="single_widget_area">
                    <!-- Footer Menu -->
                    <div class="footer_menu">
                        <nav class="navbar navbar-expand-lg justify-content-end">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                            <div class="collapse navbar-collapse" id="footerNavContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item {{$title == "Anasayfa" ? "active" : ""}}">
                                        <a class="nav-link" href="{{route('index')}}">Anasayfa</a>
                                    </li>
                                    <li class="nav-item {{$title == "Ürünler" ? "active" : ""}}">
                                        <a class="nav-link" href="{{route('products')}}">Ürünler</a>
                                    </li>
                                    <li class="nav-item {{$title == "Hakkımızda" ? "active" : ""}}">
                                        <a class="nav-link" href="{{route('aboutus')}}">Hakkımızda</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ##### Footer Area End ##### -->

<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="{{asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('js/popper.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- Bootstrap js -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- Plugins js -->
<script src="{{asset('js/plugins.js')}}"></script>
<!-- Active js -->
<script src="{{asset('js/active.js')}}"></script>
<!-- özel js -->
<script src="{{asset('js/sc.js')}}"></script>

<script>


</script>
</body>

</html>
