@extends('index')
@section('body')
    <div class="cart-table-area section-padding-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="cart-title mt-50">
                        <h2>Sepet</h2>
                    </div>
                    <div class="cart-table clearfix">
                        <table class="table table-responsive text-center">
                            <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Ad</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $toplam =0; @endphp
                            @if(\Illuminate\Support\Facades\Session::get('durum') == 1)
                                @foreach($musteri->sepet as $eleman)
                                @php
                                    $urun = \App\Models\Aurun::where("urun_kodu",$eleman['urun_kodu'])->first();
                                    $toplam = ($urun['fiyat']*$eleman['adet'])+$toplam;
                                @endphp

                            <tr>
                                <td class="cart_product_img">
                                    <a href="#"><img src="{{asset($urun['resim1'])}}" alt="Product"></a>
                                </td>
                                <td class="cart_product_desc">
                                    <h5>{{$urun['ad']}}</h5>
                                </td>
                                <td class="price">
                                    <span>{{$urun['fiyat']*$eleman['adet']}} ₺</span>
                                </td>
                                <td class="qty">
                                    <div class="qty-btn d-flex justify-content-center">
                                        <div class="quantity">
                                            <form action="{{route('cart')}}" method="post">
                                                @csrf
                                                <button name="eksi" style="right: 70px!important; background-color: transparent; border: none;" class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                <input name="urun_kodu" type="hidden" value="{{$urun['urun_kodu']}}">
                                            </form>
                                            <input disabled style="width: 100px; padding-left: 15px" type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="{{$eleman['adet']}}">
                                            <form action="{{route('cart')}}" method="post">
                                                @csrf

                                                <button name="arti" style="right: 5px; background-color: transparent; border: none;" class="qty-plus" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                <input name="urun_kodu" type="hidden" value="{{$urun['urun_kodu']}}">
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                @php $toplam =0; @endphp
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Sepet Toplam</h5>
                        <ul class="summary-table">
                            <li><span>Ara Toplam:</span> <span>{{$toplam}} ₺</span></li>
                            <li><span>Kargo:</span> <span>Bedava</span></li>
                            <li><span>Toplam:</span> <span>{{$toplam}} ₺</span></li>
                        </ul>
                        <div class="cart-btn mt-50">
                            <a style="text-align: center" href="{{route('payment')}}" class="amado-btn w-100">Satın Al</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
