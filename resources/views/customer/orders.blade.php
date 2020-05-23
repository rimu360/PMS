@extends('layouts.customer_dashboard')

@section('content')
<div id="toPrint" class="row justify-content-center">
  <div class=" col-auto">

    <div class="card">
      <div class="card-header text-center">
        <h3>Orders</h3>
      </div>
        <table class="table table-responsive-auto table-sm" >
          <thead class="bg-dark text-light text-center">
            <tr>
              <th>Total Price</th>
              <th>Payment Method</th>
              <th>Order Status</th>
              <th>Order Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="text-center">

            @foreach($orders as $order)
            <tr>
              <td>{{$order->total_price}}</td>
              @if($order->pm == 1)
              <td>Card Payment</td>
              @else
              <td>Cash on delivery</td>
              @endif

              @if($order->payment_status == 0)
              <td class="text-secondary ">Pending</td>
              @else
              <td class="text-info">Paid</td>
              @endif
              <td>{{$order->created_at->format('d/m/Y')}}</td>
              <td><a href="{{route('order_details',$order->id)}}" class="btn btn-primary">Details</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

    </div>

  </div>

</div>

<script type="text/javascript">
      var print = new function () {
               this.printTable = function () {
                   var tab = document.getElementById('toPrint');
                   var win = window.open('', '', 'height=700,width=700');
                   win.document.write(tab.outerHTML);
                   win.document.close();
                   win.print();
               }
           }
      </script>
@endsection
