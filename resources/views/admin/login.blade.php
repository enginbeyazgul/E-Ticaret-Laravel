@extends('admin')
@section('body')

    <!-- Şifremi Unuttum Area Start -->
    <div style="height: 35vh!important;" class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTopSifre" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="m-auto" id="offcanvasTopLabel">Şifremi Sıfırla</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body m-auto">
            <form method="post" action="{{route('loginprocess')}}" class="row g-3 d-flex justify-content-center">
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

<div class="container d-flex flex-column justify-content-between vh-100">
    <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
            <div class="card">
                <div class="card-header bg-transparent text-center">
                    <div>
                        <!-- Navbar Brand -->
                        <div>
                            <a href="{{route('loginpage')}}"><img src="{{asset('img/core-img/logo-1.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">

                    <h4 class="text-dark mb-5">Yönetici Giriş</h4>
                    @if($errors->any())
                        <div style="width: 350px;margin: 5px auto;align-self: center;" class="alert {{$errors->first('alert')}} alert-dismissible text-white" role="alert">
                            <span class="text-sm text-muted"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;{{$errors->first()}}</span>
                            <button type="button" class="btn-close text-sm opacity-5 hover-sari" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif
                    <form action="{{route('loginprocess')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 mb-4">
                                <input name="mail" type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" placeholder="E-mail">
                            </div>
                            <div class="form-group col-md-12 ">
                                <input name="sifre" type="password" class="form-control input-lg" id="password" placeholder="Şifre">
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex my-2 justify-content-between">
                                    <p><a data-bs-toggle="offcanvas" data-bs-target="#offcanvasTopSifre" aria-controls="offcanvasTop" class="text-blue" href="#">Şifremi Unuttum!</a></p>
                                </div>
                                <button name="giris" type="submit" class="btn btn-lg btn-warning btn-block mb-4">Giriş Yap</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright pl-0">
        <p class="text-center">Copyright © 2022 Tüm hakları saklıdır!<br>
            Engin Beyazgül & Serhat Kaçmaz
        </p>
    </div>
</div>
</div>
<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="{{asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
@endsection
