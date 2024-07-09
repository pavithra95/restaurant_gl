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

                        <h4 class="m-0 text-dark col-md-6 float-left">Create Product</h4>

                    </div>
                </div>
                <br>


                <form action="/products" method="POST" role="form" class="col-md-12" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('product_name')) text-danger @endif">
                                <label for=""> Product Name</label>
                                <input type="text" name="product_name" class="form-control" value="" required="required">
                                @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('product_name') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('type')) text-danger @endif">
                                <label for="">Product Category</label>
                                <select class="form-control select2 category_id" id="category_id" name="category_id">

                                    <option value=""></option>

                                    @foreach ($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('actual_price')) text-danger @endif">
                                <label for=""> Actual Price</label>
                                <input type="number" name="actual_price" class="form-control" value="" required="required">
                                @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('actual_price') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('tax_rate')) text-danger @endif">
                                <label for=""> Tax Rate</label>
                                <input type="number" name="tax_rate" class="form-control" value="" required="required">
                                @if($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('tax_rate') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('unit')) text-danger @endif">
                                <label for=""> Unit of Measurements</label>
                                <input type="text" name="unit" class="form-control" value="" required="required">
                                @if($errors->has('unit'))
                                <div class="error text-danger">{{ $errors->first('unit') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('availablity_status')) text-danger @endif">
                                <label for="">Availability Status</label>
                                <select name="availablity_status" id="input" class="form-control" required="required">
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
                                <input type="time" name="preparation_time" class="form-control" value="" required="required">
                                @if($errors->has('preparation_time'))
                                <div class="error text-danger">{{ $errors->first('preparation_time') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('discount')) text-danger @endif">
                                <label for=""> Discount</label>
                                <input type="number" name="discount" class="form-control" value="" required="required">
                                @if($errors->has('discount'))
                                <div class="error text-danger">{{ $errors->first('discount') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('available_qty')) text-danger @endif">
                                <label for=""> Available Quantity</label>
                                <input type="number" name="available_qty" class="form-control" value="" required="required">
                                @if($errors->has('available_qty'))
                                <div class="error text-danger">{{ $errors->first('available_qty') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('minimum_qty')) text-danger @endif">
                                <label for=""> Minimum Quantity</label>
                                <input type="number" name="minimum_qty" class="form-control" value="" required="required">
                                @if($errors->has('minimum_qty'))
                                <div class="error text-danger">{{ $errors->first('minimum_qty') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('final_price')) text-danger @endif">
                                <label for=""> Final Price</label>
                                <input type="number" name="final_price" class="form-control" value="" required="required">
                                @if($errors->has('final_price'))
                                <div class="error text-danger">{{ $errors->first('final_price') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('type')) text-danger @endif">
                                <label for="">Description</label>
                                <textarea name="description" id="" class="form-control"></textarea>

                            </div>
                        </div>





                        <button type="submit" class="btn btn-primary col-md-2 offset-md-4 btn-sm">Create</button>
                        <button class="btn btn-danger col-md-2 ml-2 btn-sm" type="reset">Cancel </button>
                </form>



            </div>
        </div>
    </div>
</div>

@stop