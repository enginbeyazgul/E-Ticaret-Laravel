<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{$title}}</title>

        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
        <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{asset('admin/assets/plugins/toaster/toastr.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/assets/plugins/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/assets/plugins/ladda/ladda.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />

        <!-- Popper js -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


        <!-- Bootstrap -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="{{asset('admin/assets/css/sleek.css')}}" />

        <!-- FAVICON -->
        <link rel="icon" href="{{asset('img/core-img/favicon.ico')}}"/>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <script src="{{asset('admin/assets/plugins/nprogress/nprogress.js')}}"></script>
    </head>

</head>
<body class="bg-light-gray sidebar-dark header-dark" id="body">

<!-- Profile Area Start -->
<div style="height: 35vh!important;" class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTopProfile" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="m-auto" id="offcanvasTopLabel">Profil Bilgileri</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body m-auto">
        <form method="post" action="{{route('adminpageorders')}}" class="row g-3 d-flex justify-content-center">
            @csrf
            <div class="col-md-3">
                <label for="inputEmail4" class="form-label">E-mail</label>
                <input name="mail" type="email" class="form-control" id="inputEmail4" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==2?\Illuminate\Support\Facades\Session::get('mail'):false}}">
            </div>
            <div class="col-md-2">
                <label for="inputPassword4" class="form-label">Şifre</label>
                <input name="sifre" type="password" class="form-control" id="inputPassword4" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==2?\Illuminate\Support\Facades\Session::get('sifre'):false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Ad</label>
                <input name="ad" type="text" class="form-control" id="inputZip" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==2?\Illuminate\Support\Facades\Session::get('ad'):false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Soyad</label>
                <input name="soyad" type="text" class="form-control" id="inputZip" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==2?\Illuminate\Support\Facades\Session::get('soyad'):false}}">
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Telefon</label>
                <input name="telefon" type="text" class="form-control" id="inputZip" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==2?\Illuminate\Support\Facades\Session::get('telefon'):false}}">
            </div>
{{--            <div class="col-md-9">--}}
{{--                <label for="inputAddress" class="form-label">Adres</label>--}}
{{--                <input name="adres" type="text" class="form-control" id="inputAddress" value="{{(\Illuminate\Support\Facades\Session::get('durum'))==2?$amusteri['adres']:false}}">--}}
{{--            </div>--}}
{{--            <div class="col-md-2">--}}
{{--                <label for="inputZip" class="form-label">Hesap durumu</label>--}}
{{--                <select class="form-control" name="durum" id="">--}}
{{--                    <option value="1">aktif</option>--}}
{{--                    <option value="0">pasif</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <button name="form3" type="submit" class="btn btn-warning">Güncelle</button>
            </div>
            <div class="col-md-4"></div>
        </form>
    </div>
</div>

@yield('body')


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
<script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/toaster/toastr.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/charts/Chart.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/ladda/spin.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/ladda/ladda.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jquery-mask-input/jquery.mask.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
<script src="{{asset('admin/assets/plugins/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugins/jekyll-search.min.js')}}"></script>
<script src="{{asset('admin/assets/js/sleek.js')}}"></script>
<script src="{{asset('admin/assets/js/chart.js')}}"></script>
<script src="{{asset('admin/assets/js/date-range.js')}}"></script>
<script src="{{asset('admin/assets/js/map.js')}}"></script>
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
<!-- özel js -->
<script src="{{asset('js/sc.js')}}"></script>

</body>
</html>
