@extends('layouts.admin_dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">Users</div><br>
                <div class="card-body table-responsive overflow-auto">

                  <table class="table table-responsive-auto table-hover ml-2 mr-2">
                    <thead>
                      <tr class>
                        <th >Name</th>
                        <th >Email</th>
                        <th >Assign Role</th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                      @foreach ($customers as $customer)
                      <tr>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->email}}</td>
                        <td><a href="{{ route('assign_role', $customer->id)}}" class="btn btn-primary">Assign to Pharmacist</a></td>
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
