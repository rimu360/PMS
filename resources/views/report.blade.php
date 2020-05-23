@if((Auth::user()->role) == 'admin')
  <?php $panel = 'layouts.admin_dashboard' ?>
@endif
@if((Auth::user()->role) == 'pharmacist')
<?php $panel = 'layouts.pharmacist_dashboard'?>
@endif
@extends($panel)
@section('content')
<!-- page start-->
<div class="container">
            <div class="col-auto">

              <div class="card">
                <div  class="card-header text-center">
                  <h2>
                      <i class="fa fa-plus-circle"></i>
                      Sales Report
                  </h2>
                </div>
                <div class="card-body">
                                  <form class="form-inline justify-content-center"  action="{{ route('create_reports') }}" method="POST">
                                      @csrf
                                        <div class="form-group">
                                        <label >From:</label>
                                        <input type="date" class="form-control ml-2"  name="from">
                                      </div>
                                      <div class="form-group">
                                        <label class="ml-4">To:</label>
                                        <input type="date" class="form-control ml-2"  name="to">
                                      </div>
                                        <button type="submit" name="submit" class="btn btn-info ml-4"> Submit</button>
                                      </form>
                                </div>
                        </div>
                    </div>
                    <?php $s_total = 0; ?>
                    @if(isset($reports))
                    <div class="card-body" id="toPrint">
                      <center><h5><b>PMS</b></h5></center>

                      <table class="table table-striped">
                        <thead class="bg-dark text-light text-center">
                          <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Sub Total</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                          @foreach($reports as $report)
                          <tr>
                            <td>{{$report->customers->name}}</td>
                            <td>{{$report->customers->email}}</td>
                            <td>{{$report->total_price}}</td>
                            <?php $s_total = $s_total + ($report->total_price) ?>
                            <td>{{$report->created_at->format('d/m/y')}}</td>

                            </tr>
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td><b>Sub Total:</b></td>
                            <td>{{$s_total}}</td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <button type="button" onclick="print.printTable()" class="btn btn-primary">Print</button>

                    </div>
                    @endif
                </div>
        <!-- page end-->
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
