@extends('user.home')
<style>
    body{
    margin-top:20px;
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
</style>
@section('body')

<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Shopping Cart</h2>
        </div>
        @if (empty($cart))
          <p>Your Cart is empty</p>
          @else
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                  </tr>
                </thead>
                <tbody>
                  {{-- {{ dd($cart) }} --}}
                  @foreach ($cart as $id=>$item )
                      
                    <tr>
                      <td class="p-4">
                        <div class="media align-items-center">
                          <img src="{{ asset('storage/'. $item['image']) }}" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                          <div class="media-body">
                            <a href="#" class="d-block text-dark">{{ $item['name'] }}</a>
                          
                          </div>
                        </div>
                      </td>
                      <td class="text-right font-weight-semibold align-middle p-4">{{ round($item['price']) }}</td>
                      <td class="align-middle p-4"><input type="text" class="form-control text-center" value="{{  $item['quantity']  }}"></td>
                      <td class="text-right font-weight-semibold align-middle p-4">{{ round($item['price']) * $item['quantity'] }}</td>
                      <td class="text-center align-middle px-0"><a href="{{ url("removeProduct/$id") }}" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                    </tr>

                  @endforeach
                  
                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->
        
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4">
                <label class="text-muted font-weight-normal">Promocode</label>
                <input type="text" placeholder="ABC" class="form-control">
              </div>
              <div class="d-flex">
                <div class="text-right mt-4 mr-5">
                  <label class="text-muted font-weight-normal m-0">Discount</label>
                  <div class="text-large"><strong>$0</strong></div>
                </div>
                <div class="text-right mt-4">
                  <label class="text-muted font-weight-normal m-0">Total price</label>
                  <div class="text-large"><strong>{{ array_reduce($cart,function ($total,$item) {
                    return $total + ($item['price'] * $item['quantity']);
                  }) }}</strong></div>
                </div>
              </div>
            </div>
        
            <div class="float-right">
              <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">Back to shopping</button>
              <form action="{{ url('placeOrder') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-lg btn-primary mt-2">Checkout</button>
              </form>
            </div>
        
          </div>
        @endif

      </div>
  </div>
  @endsection