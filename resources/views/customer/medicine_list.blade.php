@extends('layouts.customer_dashboard')

@section('content')
<link href="{{ asset('css/card.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" ></script>
<script src="{{ asset('js/jquery.searcher.js') }}" ></script>
<div class="row justify-content-center">
    <div class="col-xl">
    <div class="card shadow p-1  bg-white rounded">
      <!-- Nav -->
<nav class="navbar navbar-inverse bg-inverse fixed-bottom bg-faded">
    <div class="row">
        <div class="col">
          <?php $count = 0  ?>
          @foreach($carts as $cart)
          {{$count = $count + $cart->quantity}}
          @endforeach
          <a href="{{route('cart_items')}}" class="btn btn-primary">🛒 <span class="badge badge-light">{{$count}}</span></a>
        </div>
    </div>
</nav>

        <div class="card-header d-flex">
    <div class="form-group row">
        <label for="search" class="col-md-4 col-form-label text-md-right">{{ __('Search for:') }}</label>
        <div class="col-md-7">
            <div class='input-group date' id='dp0'>
              <input type='text' id="cardsearchinput"  class="form-control" />
                </span>
              </div>
        </div>
    </div>


  </div>
        </div>

        <div id="carddata">
          @foreach($medicines as $medicine)


          <div class="card">
            <form method="post" action="{{route('cart')}}" id="myForm">
              @csrf
            <div class="nr">{{$medicine->categories->name}}
            </div>
            @if(!empty($medicine->picture))
            <center><img src="{{asset('medicines')}}/{{$medicine->picture}}" alt="{{$medicine->picture}}" class="img-rounded img-zoom" style="width:80px;height:60px; border-radius:5px;";></center>
            @else
            <center><img src="{{asset('medicines/medicine.png')}}" alt="No Image" class="img-rounded img-zoom" style="width:80px;height:60px; border-radius:5px;";></center>
            @endif
            <div class="name">{{ucfirst($medicine -> name)}}</div>
            <div class="seller">{{$medicine->company}}</div>
            <div class="text-info text-center">Available: {{$medicine->quantity}}</div>

            <input type="hidden" name="medicine_id" value="{{$medicine->id}}">
            <center><input class="form-control" min="1" type="number" name="quantity" value="1" style="width:80px; height:20px; margin:2px"></center>
            <input type="hidden" name="price" value="{{$medicine->selling_price}}">

            @if($medicine->quantity > 0)
            <center><button type="submit" name="submit" class="btn btn-info btn-sm"> Add to cart</button></center>
            @else
            <center><p class="text-danger">Not Available</p></center>
            @endif

            <div class="price">Price: {{$medicine->selling_price}}tk</div>
          </div></form>

          @endforeach

        </div>
          </div>




        </div>

<script>
  $("#carddata").searcher({
    itemSelector: ".card",
    textSelector: "div",
    inputSelector: "#cardsearchinput",
    highlight: "<span class='highlight'>$1</span>",
    toggle: function(item, containsText) {
      if (containsText)
        $(item).fadeIn();
      else
        $(item).fadeOut();
    }
  });

  $('select').change(function(){
  this.form.submit();
  });
</script>

@endsection
