@extends('layouts.app')

@section('title', 'KGGL')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">

                        <h4 class="m-0 text-dark col-md-6 float-left">Show Product</h4>

                        <a class="btn btn-warning float-right btn-sm ml-3" href="/products"> Back</a>
                        <a class="btn btn-success float-right btn-sm" href="/products/{{$item->id}}/edit"> Edit</a>
   

                    </div>
                </div>
                <br>


                <form action="/products/{{$item->id}}" method="POST" role="form" class="col-md-12" autocomplete="off">
                   

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('product_name')) text-danger @endif">
                                <label for=""> Product Name</label>
                                <input type="text" name="product_name" class="form-control" readonly value="{{$item->product_name}}" required="required" >
                                @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('product_name') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('type')) text-danger @endif">
                                <label for="">Product Category</label>
                                <input type="text" name="product_name" class="form-control" readonly value="{{$item->category->category_name}}" required="required" >
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('actual_price')) text-danger @endif">
                                <label for=""> Actual Price</label>
                                <input type="number" name="actual_price" class="form-control" readonly value="{{$item->actual_price}}" required="required">
                                @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('actual_price') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('tax_rate')) text-danger @endif">
                                <label for=""> Tax Rate</label>
                                <input type="number" name="tax_rate" class="form-control" readonly value="{{$item->tax_rate}}" required="required">
                                @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('tax_rate') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('unit')) text-danger @endif">
                                <label for=""> Unit of Measurements</label>
                                <input type="text" name="unit" class="form-control" readonly value="{{$item->unit}}" required="required">
                                @if($errors->has('unit'))
                                <div class="error text-danger">{{ $errors->first('unit') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('availablity_status')) text-danger @endif">
                                <label for="">Availability Status</label>
                                <select name="availablity_status" id="input" class="form-control" readonly required="required">
                                    <option value="available">Available</option>
                                    <option value="not_available">Not Available</option>
                                </select>
                                @if($errors->has('availablity_status'))
                                <div class="error text-danger">{{ $errors->first('availablity_status') }}</div>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('preparation_time')) text-danger @endif">
                                <label for=""> Preparation Time</label>
                                <input type="time" name="preparation_time" class="form-control" readonly value="{{$item->preparation_time}}" required="required">
                                @if($errors->has('preparation_time'))
                                <div class="error text-danger">{{ $errors->first('preparation_time') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('discount')) text-danger @endif">
                                <label for=""> Discount</label>
                                <input type="number" name="discount" class="form-control" readonly value="{{$item->discount}}" required="required">
                                @if($errors->has('discount'))
                                <div class="error text-danger">{{ $errors->first('discount') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('available_qty')) text-danger @endif">
                                <label for=""> Available Quantity</label>
                                <input type="number" name="available_qty" class="form-control" readonly value="{{$item->available_qty}}" required="required">
                                @if($errors->has('available_qty'))
                                <div class="error text-danger">{{ $errors->first('available_qty') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('minimum_qty')) text-danger @endif">
                                <label for=""> Minimum Quantity</label>
                                <input type="number" name="minimum_qty" class="form-control" readonly value="{{$item->minimum_qty}}" required="required">
                                @if($errors->has('minimum_qty'))
                                <div class="error text-danger">{{ $errors->first('minimum_qty') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('final_price')) text-danger @endif">
                                <label for=""> Final Price</label>
                                <input type="number" name="final_price" class="form-control" readonly value="{{$item->final_price}}" required="required">
                                @if($errors->has('final_price'))
                                <div class="error text-danger">{{ $errors->first('final_price') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('type')) text-danger @endif">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control" readonly >{{$item->description}}</textarea>

                            </div>
                        </div>





                          </form>



            </div>
        </div>
    </div>
</div>

@stop