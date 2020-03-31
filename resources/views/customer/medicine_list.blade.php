@extends('layouts.customer_dashboard')

@section('content')
<link href="{{ asset('css/card.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" ></script>
<script src="{{ asset('js/jquery.searcher.js') }}" ></script>
<div class="row justify-content-center">
    <div class="col-xl">
    <div class="card shadow p-1  bg-white rounded">
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
            <div class="nr">{{$medicine->categories->name}}
            </div>
            @if(!empty($medicine->picture))
            <center><img src="{{asset('medicines')}}/{{$medicine->picture}}" alt="{{$medicine->picture}}" class="img-rounded img-zoom" style="width:80px;height:60px; border-radius:5px;";></center>
            @else
            <center><img src="{{asset('medicines/medicine.png')}}" alt="No Image" class="img-rounded img-zoom" style="width:80px;height:60px; border-radius:5px;";></center>
            @endif
            <div class="name">{{ucfirst($medicine -> name)}}</div>
            <div class="seller">{{$medicine->company}}</div>
            <div class="price">Price: {{$medicine->selling_price}}tk</div>
            </a>
          </div>
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
