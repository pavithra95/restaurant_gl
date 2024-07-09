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

                        <h4 class="m-0 text-dark col-md-6 float-left">Create Category</h4>

                    </div>
                </div>
                <br>


                <form action="/category" method="POST" role="form" class="col-md-12" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-12">

                            <div class="col-md-6">



                                <div class="form-group @if($errors->has('name')) text-danger @endif">
                                    <label for=""> Category Name</label>
                                    <input type="text" name="name" class="form-control" value="" required="required">
                                    @if($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>
                                <div class="form-group @if($errors->has('status')) text-danger @endif">
                                    <label for="">Status</label>
                                    <select name="status" id="input" class="form-control" required="required">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @if($errors->has('status'))
                                    <div class="error text-danger">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>




                            </div>
                        </div>
                    </div>





                    <button type="submit" class="btn btn-primary col-md-2 offset-md-1 btn-sm">Create</button>
                    <a class="btn btn-danger col-md-2  btn-sm" href='/product-categories'>Cancel </a>
                </form>



            </div>
        </div>
    </div>
</div>

@stop
