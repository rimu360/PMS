@extends('layouts.admin_dashboard')

@section('content')

<div class="container">
  <div class="row">
    <div class=" mx-auto col-auto">

      <div class="card">
        <div class="card-header text-center">
          <h3>Medicine Category</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead class="bg-dark text-light text-center">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody class="text-center">

              @foreach($categories as $category)
              <tr>
                <td>{{$category->name}}</td>
                <td class="text-justify">{{$category->description}}</td>
                <td><a href="{{ route('update_category', $category->id)}}" class="btn btn-primary">Update</a></td>

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
