@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

    <div class="col-md-12">

        <h1 class="m-0 text-dark col-md-6 float-left">Products</h1>

        <a class="btn btn-primary float-right btn-sm" href="/products/create"><i class="fa fa-plus" aria-hidden="true"> New</i> </a>
    </div>
</div>


                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                           
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><a href="/products/{{ $item->id }}" >{{ $item->product_name }}</a></td>
                            <td>{{$item->category->category_name}}</td>
                            <td>{{$item->final_price}}</td>
                            <td>{{$item->availablity_status}}</td>
                            <td><a href="/products/{{ $item->id }}/edit"  class="btn btn-success">Edit</a> 
                            <a href="/products/{{$item->id}}/delete" class="btn btn-danger">Delete</a></td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                




            </div>
        </div>
    </div>
</div>
@stop
