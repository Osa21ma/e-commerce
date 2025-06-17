@extends('user.home')
@section('body')
    <div class="latest-products">
        <div class="container">
        <div class="row">
                <div class="product-item d-flex">
                        <a><img src="{{asset("storage/$product->image")}}" width="400" height="600" alt=""></a>
                        <div class="down-content">
                            <a><h4>{{$product->name}}</h4></a>
                            <h6>${{round($product->price)}}</h6>
                            <p>{{$product->description}}</p>
                            
                        </div>
                </div>
        </div>

        </div>
        </div>
    </div>

@endsection
