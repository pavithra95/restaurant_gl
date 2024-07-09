@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

    <div class="col-md-12">

        <h1 class="m-0 text-dark col-md-6 float-left">Table Details</h1>

        <a class="btn btn-primary float-right btn-sm" href="/tables/create"><i class="fa fa-plus" aria-hidden="true"> New</i> </a>
    </div>
</div>


                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Table No</th>
                            <th>Category</th>
                            <th>Action</th>
                           
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><a href="/tables/{{ $item->id }}/edit" >{{$item->table_no}}</a></td>
                            <td>{{ $item->category }}</td>
                            <td><a href="/tables/{{$item->id}}/delete" class="btn btn-danger">Delete</a></td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                




            </div>
        </div>
    </div>
</div>
@stop
