@extends('index')
@section('body')
    <!-- Product Details Area Start -->
    <div class="single-product-area section-padding-100 clearfix">
        <div class="container-fluid">

                <div id="alertStyle" style="display: none;width: 350px;text-align: center; margin: auto; margin-top: -50px!important; margin-bottom: 50px!important;"
                     class="alert alert-dismissible text-white text-center" role="alert">
                    <span id="alertText" class="text-sm"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url({{asset($urun['resim1'])}});">
                                </li>
                                <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url({{asset($urun['resim1'])}});">
                                </li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a class="gallery_img" href="{{asset($urun['resim1'])}}">
                                        <img class="d-block w-100" src="{{asset($urun['resim1'])}}" alt="First slide">
                                    </a>
                                </div>
                                <div class="carousel-item">
                                    <a class="gallery_img" href="{{asset($urun['resim1'])}}">
                                        <img class="d-block w-100" src="{{asset($urun['resim1'])}}" alt="Second slide">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="single_product_desc">
                        <!-- Product Meta Data -->
                        <div class="product-meta-data">
                            <div class="line"></div>
                            <p class="product-price">{{$urun['fiyat']."₺"}}</p>
                            <a><h6>{{$urun['ad']}}</h6></a>
                            <!-- Ratings & Review -->
                            <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                            <!-- Avaiable -->
                            <p class="{{$urun['stok']>=20?"avaibility":"less-avaibility"}}"><i class="fa fa-circle"></i> Stok: {{$urun['stok']}}</p>
                        </div>

                        <div class="short_overview my-5">
                            <p>{{$urun['aciklama']}}</p>
                        </div>

                        <!-- Add to Cart Form -->
                        <form class="cart clearfix" method="post">
                            <div class="cart-btn d-flex mb-50">
                                <p>Adet</p>
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="adet" value="1">
                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <button  type="button" name="addtocart" urunId="{{$urun['urun_kodu']}}" value="5" class="amado-btn">Sepete Ekle</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
    <script>
        $(document).ready(function (){
            $('button[name=addtocart]').click(function (){
                var urunId = $(this).attr('urunId');
                var urunAdet = $('input[name=adet]').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    url: '',
                    type: 'post',
                    data: {'urunId': urunId,'urunAdet':urunAdet},
                    dataType: 'json',
                    success: function (resp){
                        if(resp == false){
                            $("#alertStyle").addClass("alert-warning");
                            $("#alertStyle").css("display","block");
                            $('#alertText').html('<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Lütfen giriş yapın!'+resp);
                        }
                        else if(resp == true) {
                            $("#alertStyle").addClass("alert-success");
                            $("#alertStyle").css("display","block");
                            $('#alertText').html('<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;'+urunAdet+' adet ürün sepete eklendi!'+resp);
                        }
                        if(resp == false){
                            $("#alertStyle").addClass("bg-warning");
                            $("#alertStyle").css("display","block");
                            $('#alertText').html('<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Lütfen giriş yapın!'+resp);
                        }
                    }
                });
            });


        });
    </script>
    <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

@endsection

