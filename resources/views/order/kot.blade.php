<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* General padding for paragraphs */
        p {
            padding: 3px;
            margin: 0;
        }

        /* Card styling */
        .card {
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-head {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row m-3">
            @foreach($orders as $order)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-head d-flex justify-content-between">
                        <div>
                            <p>Order No: {{$order->order_no}}</p>
                            <p>Date: {{$order->order_date}}</p>
                        </div>
                        <div>
                            <p>Table No: {{$order->table_no}}</p>
                            <p>{{$order->order_type}}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>QuickSale/Walk-In</p>
                        @foreach($order->orderDetails as $key=>$i)
                        @if($i->status == 'kot')
                        <p class="ms-5">{{$i->qty}} x {{$i->product->product_name}}</p>
                        @endif
                        @endforeach
                       
                    </div>
                    <div>
                        <form action="/orders/{{$order->id}}/kot" method="post">
                        {{ csrf_field() }}
                        <!-- {{method_field('PUT')}} -->
                            <button class="btn btn-primary btn-sm" style="margin-right: 220px;">Done</button>
                        </form>
                    <!-- <button class="btn btn-warning btn-sm" style="margin-left: 10px;">Done</button> -->
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
