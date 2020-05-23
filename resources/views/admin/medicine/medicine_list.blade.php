@extends('layouts.admin_dashboard')

@section('content')

  <div class="row">
    <div class=" col-auto">

      <div class="card">
        <div class="card-header text-center">
          <h3>Medicine list </h3>
        </div>
          <table class="table table-responsive-auto table-sm">
            <thead class="bg-dark text-light text-center">
              <tr>
                <th>Name</th>
                <th>Picture</th>
                <th>Category</th>
                <th>Purchasing Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Company</th>
                <th>Expiry Date</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody class="text-center">

              @foreach($medicines as $medicine)
              <tr>
                <td>{{$medicine->name}}</td>
                <td>{{$medicine->picture}}</td>
                <td>{{$medicine->categories->name}}</td>
                <td>{{$medicine->purchase_price}}</td>
                <td>{{$medicine->selling_price}}</td>
                <td>{{$medicine->quantity}}</td>
                <td>{{$medicine->company}}</td>
                <td>{{$medicine->expiry_date}}</td>
                <td><a href="{{ route('update_medicine', $medicine->id)}}" class="btn btn-primary">Update</a></td>
                <td>
          <!-- Button trigger modal -->
                      <button type="button" class="btn btn-danger" onclick="dd('{{$medicine->id}}')" data-toggle="modal" data-target="#exampleModal">
                      Delete
                      </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>


      </div>

    </div>

  </div>
    <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Medicine Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delete_medicine')}}" method="post">
              @csrf
              <input type="hidden" name="id" id='delete_id'>
              <div class="modal-body text-center text-danger">
              Are you sure you want to Delete this?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-danger" type="submit">Delete</button>
            </div>
            </form>
          </div>
          </div>
          </div>
<script type="text/javascript">
function dd(id)
{
  document.getElementById("delete_id").value = id;
}
</script>
@endsection
