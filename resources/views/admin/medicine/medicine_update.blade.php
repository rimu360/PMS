@extends('layouts.admin_dashboard')

@section('content')
<!-- page start-->

            <div class="container">
                        <div class="col-md-6">

                          <div class="card">
                            <div class="card-header text-center">
                              <h2>
                                  <i class="fa fa-plus-circle"></i>
                                  Update Medicine
                              </h2>
                            </div>
                            <div class="card-body">
                              <form  action="{{ route('update_medicine_post',$med->id) }}" method="POST">
                                  @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$med->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" width="50%" name="category_id" value="{{$med->category_id}}" id="sel1">
                                          <option value="{{$med ->categories -> id}}" selected>{{$med ->categories -> name}}</option>
                                      @foreach($categories as $category)
                                      @if($category -> id != $med ->categories -> id)
                                      <option value="{{$category -> id}}">{{$category -> name}}</option>
                                      @endif
                                      @endforeach
                                    </select>

                                    </div>

                                    <div class="form-group">
                                        <label>Purchase Price</label>
                                        <input type="number"  min=0 step="0.01" class="form-control" name="purchase_price" value="{{$med->purchase_price}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Selling Price</label>
                                        <input type="number" min=0 step="0.01" class="form-control" name="selling_price"value="{{$med->selling_price}}" >
                                  </div>

                                  <div class="form-group">
                                      <label>Quantity</label>
                                      <input type="number" min=0  class="form-control" name="quantity" value="{{$med->quantity}}">
                                  </div>
                                  <div class="form-group">
                                      <label>Generic Name</label>
                                      <input type="text" class="form-control" name="generic_name" value="{{$med->generic_name}}">
                                  </div>
                                  <div class="form-group">
                                      <label>Company</label>
                                      <input type="text" class="form-control" name="company" value="{{$med->company}}">
                                  </div>
                                  <div class="form-group">
                                      <label>Effects</label>
                                      <input type="text" class="form-control" name="effects" value="{{$med->effects}}">
                                  </div>
                                  <div class="form-group">
                                      <label>Expiry Date</label>
                                      <input type="date" class="form-control" name="expiry_date" value="{{$med->expiry_date}}">
                                  </div>

                                    <button type="submit" name="submit" class="btn btn-info"> Update</button>
                                  </form>
                            </div>
                          </div>
                        </div>
            </div>
        <!-- page end-->
@endsection
