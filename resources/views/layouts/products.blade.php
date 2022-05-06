@extends('index')
@section('body')
    <div style="max-height: 250px; margin-top: 25px; background-color: transparent; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; padding:25px" class="shop_sidebar_area">

        <!-- ##### Single Widget ##### -->
        <div class="widget catagory mb-30">
            <!-- Widget Title -->
            <h6 class="widget-title mb-20"><i class="fas fa-list"></i> Kategoriler</h6>

            <!--  Catagories  -->
            <div class="catagories-menu">
                <ul>
                    @foreach($kategoriler as $kategori)
                        <li><a style="font-size: 14px; padding: 6px" href="{{route('products')."?k=".$kategori['kategori_kodu']}}">{{$kategori['ad']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px" class="amado_product_area">
        <div class="container-fluid">
            <div class="row">
                @foreach($urunler as $urun)
                <!-- Single Product Area -->
                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img style="height: 300px; width: 330px" src="{{asset($urun['resim1'])}}" alt="">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="{{asset($urun['resim1'])}}" alt="">
                        </div>

                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">{{$urun['fiyat']."₺"}}</p>
                                <a href="{{route('product')."?urunKodu=".$urun['urun_kodu']}}">
                                    <h6>{{$urun['ad']}}</h6>
                                </a>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination justify-content-end mt-50">
                            <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                            <li class="page-item"><a class="page-link" href="#">02.</a></li>
                            <li class="page-item"><a class="page-link" href="#">03.</a></li>
                            <li class="page-item"><a class="page-link" href="#">04.</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection
