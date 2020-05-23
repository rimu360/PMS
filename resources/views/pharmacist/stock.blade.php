@extends('layouts.pharmacist_dashboard')

@section('content')

  <div class="row justify-content-center">
    <div class=" col-auto">

      <div class="card">
        <div class="card-header text-center">
          <h3>Medicine list </h3>
        </div>
          <table class="table table-responsive-auto table-sm">
            <thead class="bg-dark text-light text-center">
              <tr>
                <th>Name</th>
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
                <td>{{$medicine->quantity}}</td>
                <td>{{$medicine->company}}</td>
                <td>{{$medicine->expiry_date}}</td>
                <td>
          <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" onclick="dd('{{$medicine->id}}','{{$medicine->name}}')" data-toggle="modal" data-target="#exampleModal">
                      Update Quantity
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
                <h5 class="modal-title" id="exampleModalLabel">Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_stock')}}" method="post">
              @csrf
              <input type="hidden" name="id" id='delete_id'>
              <center><p id="name"></p></center>
              <br>
              <div class="form-group row">
                  <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Enter Quantity') }}</label>

                  <div class="col-md-6">
                      <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus>

                      @error('quantity')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-danger" type="submit">Update</button>
            </div>
            </form>
          </div>
          </div>
          </div>
<script type="text/javascript">
function dd(id,name)
{
  document.getElementById("delete_id").value = id;
  document.getElementById("name").innerHTML= name;
}
</script>
@endsection
