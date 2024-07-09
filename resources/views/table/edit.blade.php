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

                        <h4 class="m-0 text-dark col-md-6 float-left">Edit Table</h4>

                    </div>
                </div>
                <br>


                <form action="/tables/{{$item->id}}" method="POST" role="form" class="col-md-12" autocomplete="off">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="row">
                        <div class="col-md-12">

                            <div class="col-md-6">



                                <div class="form-group @if($errors->has('name')) text-danger @endif">
                                    <label for=""> Table Number</label>
                                    <input type="text" name="name" class="form-control" value="{{$item->table_no}}" required="required">
                                    @if($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>
                                <div class="form-group @if($errors->has('category')) text-danger @endif">
                                    <label for="">Category</label>
                                    <select name="category" id="input" class="form-control" required="required">
                                        <option value="AC" @if ($item->category == "AC") selected="" @endif>AC</option>
                                        <option value="NonAC" @if ($item->category == "NonAC") selected="" @endif>Non AC</option>
                                    </select>
                                    @if($errors->has('category'))
                                    <div class="error text-danger">{{ $errors->first('category') }}</div>
                                    @endif
                                </div>




                            </div>
                        </div>
                    </div>





                    <button type="submit" class="btn btn-primary col-md-2 offset-md-1 btn-sm">Update</button>
                    <a class="btn btn-danger col-md-2  btn-sm" href='/product-categories'>Cancel </a>
                </form>



            </div>
        </div>
    </div>
</div>

@stop
