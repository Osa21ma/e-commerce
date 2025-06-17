@extends('user.home')
@section('body')
    <div class="latest-products">

        @if (session('success'))
        <div class="bg-success">{{ session('success') }}</div>
    @endif

        <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="section-heading">
                <h2>Latest Products</h2>
                <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
            </div>
            </div>
            @foreach ($products as $product )
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="{{ url("showProduct/{$product->id}") }}"><img src="{{asset("storage/$product->image")}}" width="100" height="300" alt=""></a>
                        <div class="down-content">
                            <a href="#"><h4>{{$product->name}}</h4></a>
                            <h6>${{round($product->price)}}</h6>
                            <p>{{$product->description}}</p>
                            <form action="{{ url("addProduct/$product->id") }}" method="post">
                                @csrf
                                <input type="number" name="qty" class="w-25">
                                <button class="btn">Add</button>
                            </form>
                            <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span>Reviews (24)</span>
                        </div>
                    </div>
                </div>
          @endforeach
            </div>

        </div>
        </div>
    </div>

@endsection
