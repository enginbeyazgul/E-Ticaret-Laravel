@extends('index')
@section('body')
    <!-- Product Catagories Area Start -->
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach($urunler as $urun)
            <!-- Single Catagory -->
            <div class="single-products-catagory clearfix">
                <a href="{{route('product')."?urunKodu=".$urun['urun_kodu']}}">
                    <img src="{{asset($urun['resim1'])}}" alt="">
                    <!-- Hover Content -->
                    <div style="background-color: rgba(0, 0, 0, 0.6); border: 1px solid rgba(251, 183, 16, 1); padding: 5px" class="hover-content">
                        <div class="line"></div>
                        <p style="color: aliceblue">{{$urun['fiyat']."₺"}}</p>
                        <h5 style="color: aliceblue">{{substr($urun['ad'],0,20)}}</h5>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection
