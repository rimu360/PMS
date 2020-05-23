@extends('layouts.admin_dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">Staffs</div><br>
                <div class="card-body table-responsive overflow-auto">

                  <table class="table table-responsive-auto table-hover ml-2 mr-2">
                    <thead>
                      <tr class>
                        <th >Name</th>
                        <th >Email</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      @foreach ($staffs as $staff)
                      <tr>
                        <td>{{$staff->name}}</td>
                        <td>{{$staff->email}}</td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
