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

                        <h4 class="m-0 text-dark col-md-6 float-left">Create employee</h4>

                    </div>
                </div>
                <br>


                <form action="/employees" method="POST" role="form" class="col-md-12" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">


                        <!-- <div class="col-md-6">
                            <div class="form-group @if($errors->has('emp_no')) text-danger @endif">
                                <label for=""> Employee Number</label>
                                <input type="text" name="emp_no" class="form-control" value="" required="required">
                                @if($errors->has('emp_no'))
                                <div class="error text-danger">{{ $errors->first('emp_no') }}</div>
                                @endif

                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('emp_name')) text-danger @endif">
                                <label for=""> Employee Name</label>
                                <input type="text" name="emp_name" class="form-control" value="" required="required">
                                @if($errors->has('emp_name'))
                                <div class="error text-danger">{{ $errors->first('emp_name') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('mobile')) text-danger @endif">
                                <label for=""> Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="" required="required">
                                @if($errors->has('mobile'))
                                <div class="error text-danger">{{ $errors->first('mobile') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('designation')) text-danger @endif">
                                <label for="">Designation</label>
                                <select name="designation" id="input" class="form-control" required="required">
                                    <option value=""></option>
                                    <option value="Cashier">Cashier</option>
                                    <option value="Supplier">Supplier</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                                @if($errors->has('designation'))
                                <div class="error text-danger">{{ $errors->first('designation') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                        <button type="submit" class="btn btn-primary col-md-2 offset-md-3 btn-sm">Create</button>
                        <a class="btn btn-danger col-md-2 ml-3  btn-sm" href='/employees'>Cancel </a>
                        </div>
                    </form>



            </div>
        </div>
    </div>
</div>
</div>
</div>

@stop