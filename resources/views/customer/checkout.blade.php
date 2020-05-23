@extends('layouts.customer_dashboard')

@section('content')
<div class="container">
  <center><h3>Check Out</h3></center>
  <div class="row">

    <div class="col-md-6">
      <div class="card-body">
        <table class="show-cart table" id="mytbody">
          <thead class="bg-dark text-light text-center">
            <tr>
              <th>Name</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <?php $stotal = '0'; $stotal = '0';?>

          <tbody class="text-center">
          @isset($cart_items)
           @foreach($cart_items as $items)
             <tr>
               <td>{{$items->cart_items->name}}</td>
               <td>{{$items->price}}</td>
               <td>{{$items->quantity}}</td>
                <?php $total = $items->price * $items->quantity; $stotal = $stotal+$total?>
               <td>{{$total}}</td>
             </tr>
           @endforeach
          @endisset
        </tbody>
        </table>
        <div> <b>Sub Total price:</b> {{$stotal}} ৳ </div>
      </div>
    </div>


    <div class="col-md-6">
      <div class="card-body">
          <form method="POST" action="{{ route('checkout_post') }}">
              @csrf

              <div class="form-group row">
                  <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                  <div class="col-md-6">
                      <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                      @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <input type="hidden" name="total_price" value="{{$stotal}}">

              <div class="form-group row">
              <label  class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>
              <div class="form-group col-md-6">
                  <select name="pm" class="form-control" id="exampleFormControlSelect2" required>
                    <option value="1">Pay with Card</option>
                    <option value="2">Cash on delivery</option>
                  </select>
                </div>
              </div>


              <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Confirm Order') }}
                      </button>

                  </div>
              </div>
          </form>
      </div>
    </div>


  </div>
</div>


@endsection
