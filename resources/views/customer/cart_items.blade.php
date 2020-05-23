@extends('layouts.customer_dashboard')

@section('content')

<div class="container">
   <div class="card">
     <div class="card-header">
       <center><h5 class="card-title" id="exampleModalLabel">Cart</h5></center>
     </div>
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
              <td><a href="{{route('item_delete',$items->id)}}" class="btn btn-danger btn-sm">X</a></td>
            </tr>
          @endforeach
         @endisset
       </tbody>
       </table>
       <div> <b>Sub Total price:</b> {{$stotal}} ৳ </div>
     </div>
     <div class="card-footer">
       <a href="{{route('cart_clear')}}" class="btn btn-danger">Clear Cart</a>
       <a href="{{route('medicine_list_customer')}}" class="btn btn-secondary">Continue Shopping</a>
       <a href="{{route('checkout')}}" class="btn btn-primary">Check Out</a>
     </div>
   </div>
</div>



@endsection
