@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

    <div class="col-md-12">

        <h1 class="m-0 text-dark col-md-6 float-left">Employee Details</h1>

        <a class="btn btn-primary float-right btn-sm" href="/employees/create"><i class="fa fa-plus" aria-hidden="true"> New</i> </a>
    </div>
</div>


                <table class="table table-striped table-hover">   
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Emp No</th>
                            <th>Emp Name</th>
                            <th>Mobile</th>
                            <th>Designation</th>
                            <th>Action</th>
                           
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->emp_no }}</td>
                            <td><a href="/employees/{{ $item->id }}/edit" >{{$item->emp_name}}</a></td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->designation }}</td>
                            <td><a href="/employees/{{$item->id}}/delete" class="btn btn-danger">Delete</a></td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                




            </div>
        </div>
    </div>
</div>
@stop
