@extends('layouts.customer_dashboard')

@section('content')
<div class="row justify-content-center" id="toPrint">
  <div class=" col">
    <h3>PMS-Invoice</h3>
    <div class="card">
        <table class="table table-responsive-auto table-sm" id="toPrint">
          <tbody class="text">
            @foreach($orders as $order)
            <tr><td><b>Customer name:</b>  {{$order->customers->name}}</td></tr>
            <tr><td><b>Address:</b> {{$order->address}}</td></tr>
            @if($order->pm == 1)
            <tr><td><b>Payment Method:</b> Card Payment</td></tr>
            @else
            <tr><td><b>Payment Method:</b> Cash on delivery</td></tr>
            @endif
            @if($order->payment_status == 0)
            <tr><td><b>Order Status: </b>Pending</td></tr>
            @else
            <tr><td><b>Order Status: </b>Paid</td></tr>
            @endif
            <td><b>Order date & time: </b>{{$order->created_at->format('d/m/Y H:i:s')}}</td>

            @endforeach
          </tbody>
        </table>
    </div>



    <div class="card">
      <div class="card-header text-center">
        <h3>Medicines</h3>
      </div>
        <table class="table table-responsive-auto table-sm" id="toPrint">
          <thead class="bg-dark text-light text-center">
            <tr>
              <th>Medicine Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total price</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php $stotal = '0' ?>
            @foreach($order_details as $od)
            <tr>
              <td>{{$od->medicines->name}}</td>
              <td>{{$od->quantity}}</td>
              <td>{{$od->medicines->selling_price}}</td>
              <td>{{$od->quantity * $od->medicines->selling_price}}</td>
              <?php  $stotal = $stotal + ($od->quantity * $od->medicines->selling_price)?>
            </tr>
            @endforeach
            <tr><td><b>Sub Total:</b> {{$stotal}}</td></tr>
          </tbody>
        </table>
    </div>





    <td><button type="button" onclick="print.printTable()" class="btn btn-primary">Print</button></td>
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
