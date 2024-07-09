@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">

                        <h1 class="m-0 text-dark col-md-6 float-left">Order Details</h1>

                        <a class="btn btn-primary float-right btn-sm" href="/orders/create"><i class="fa fa-plus" aria-hidden="true"> New</i> </a>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Table No</th>
                            <th>Order No</th>
                            <th>Order Date</th>
                            <th>Order Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->table_no != '' ? $item->table->table_no : '-' }}</td>
                            @if($item->status != 'closed')
                            <td><a href="/orders/{{ $item->id }}/edit">{{ $item->order_no }}</a></td>
                            @else
                            <td>{{ $item->order_no }}</td>
                            @endif
                            <td>{{ $item->order_date }}</td>
                            <td>{{ $item->order_type }}</td>
                            <td>{{ $item->status }}</td>
                            <!-- <td><a href="/orders/{{$item->id}}/kot" class="btn btn-success">KOT</a></td> -->
                            @if($item->status == 'pending')
                            <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal-{{ $item->id }}">
                                    KOT
                                </button>
                                <!-- Modal Template -->
                                <div class="modal fade" id="myModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ORDER RECEIPT</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <style>
                                                    .header {
                                                        text-align: center;
                                                    }

                                                    th,
                                                    td {
                                                        padding: 5px;
                                                        text-align: left;
                                                        width: 200px;
                                                    }

                                                    .price {
                                                        margin-left: 10px;
                                                        margin-right: 10px;
                                                        display: flex;
                                                        justify-content: space-between;
                                                    }

                                                    .greet {
                                                        text-align: center;
                                                    }

                                                    .price h4 {
                                                        margin-top: -2px;

                                                    }
                                                </style>

                                                <div class="header">
                                                    <!-- <h3>CASH RECEIPT</h3> -->
                                                    <h2>SHOP NAME</h4>
                                                        <p>Address Green Tree Saravanampatti</p>
                                                        <p>TEL:9878676789</p>
                                                </div>
                                                <hr>
                                                <p>Date:{{$item->order_date}}</p>
                                                <p>Order No:{{$item->order_no}}</p>
                                                <hr>
                                                <table>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Notes</th>

                                                    </tr>
                                                    @foreach($item->orderDetails as $key=>$i)
                                                    @if($i->status=='pending')
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$i->Product->product_name}}</td>
                                                        <td>{{$i->qty}}</td>
                                                        <td>{{$i->notes}}</td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    </td>
                                                </tr>

                                                </table>
                                                <hr>
                                               
                                                <h4 class="greet">***THANK YOU***</h4>

            </div>
            <div class="modal-footer" id="modalButtons-{{ $item->id }}">
                                                <!-- Print button hidden by default -->
            <button type="button" class="btn btn-success print-btn mr-2" onclick="printModalContent('{{ $item->id }}')">Print</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</td>
@else
<td>
@if($item->pos && $item->pos->customer_id !== null) 
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Invoice-{{ $item->id }}" >
                                    Invoice
        </button>
    
  @else 
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#customerModal-{{ $item->id }}">
                                    Customer
        </button> 
        
      
        @endif     
        <!-- Customer Modal -->
<div class="modal fade" id="customerModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customerModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/orders/customers/{{$item->id}}" method="POST" role="form">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="order_id" value="{{$item->id}}" name="order_id">
          <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
          </div>
          <div class="form-group">
            <label for="customer_mobile">Mobile Number:</label>
            <input type="text" class="form-control" id="customer_mobile" name="customer_mobile" required>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Customer</button>
      </div>
      </form>
    </div>
  </div>
</div>
       
        <!-- Modal Template -->
        <div class="modal fade" id="Invoice-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width:800px">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Invoice RECEIPT</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <style>
                                                    .header {
                                                        text-align: center;
                                                    }

                                                    th,
                                                    td {
                                                        padding: 5px;
                                                        text-align: left;
                                                        width: 400px;
                                                    }

                                                    .price {
                                                        margin-left: 10px;
                                                        margin-right: 10px;
                                                        display: flex;
                                                        justify-content: space-between;
                                                    }

                                                    .greet {
                                                        text-align: center;
                                                    }

                                                    .price h4 {
                                                        margin-top: -2px;

                                                    }
                                                </style>

                                                <div class="header">
                                                    <!-- <h3>CASH RECEIPT</h3> -->
                                                    <h2>SHOP NAME</h4>
                                                        <p>Address Green Tree Saravanampatti</p>
                                                        <p>TEL:9878676789</p>
                                                </div>
                                                <hr>
                                                <form>
                                                @if($item->pos && $item->pos->customer_id !== null && $item->pos->customer->customer_name)
                                                <p>Customer Name:  {{$item->pos->customer->customer_name}}</p>
                                                @else
                                                <p>Customer Name: </p>
                                                @endif
                                                @if($item->pos && $item->pos->customer_id !== null && $item->pos->customer->customer_mobile)
                                                <p>Customer Mobile:  {{$item->pos->customer->customer_mobile}}</p>
                                                @else
                                                <p>Customer Mobile: </p>
                                                @endif
                                                      
                                                <p>Date:{{$item->order_date}}</p>
                                                <p>Order No:{{$item->pos ? $item->pos->invoice_no : '-'}}</p>
                                                <hr>
                                                <table>
                                                    
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>

                                                    </tr>
                                                    @foreach($item->orderDetails as $key=>$i)
                                                    @if($i->status=='kot'|| $i->status=='delivered')
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$i->Product->product_name}}</td>
                                                        <td>{{$i->qty}}</td>
                                                        <td>{{$i->item_price}}</td>
                                                        <td>{{$i->total_price}}</td>

                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><b>Price</b></td>
                                                    @if($item->pos && $item->pos->total_amount !== 0 && $item->pos->total_amount)
                                                    <td><b>{{$item->pos->total_amount}}</b></td>
                                                    @else
                                                    <td>0</td>
                                                    @endif
                                                </tr>
                                               

                                                </table>
                                                <hr>
                                               
                                               
                                                <h4 class="greet">***THANK YOU***</h4>

            </div>
            <div class="modal-footer" id="modalButtonss-{{ $item->id }}">
                                                <!-- Print button hidden by default -->
            <button type="button" class="btn btn-success print-btn mr-2" onclick="invoiceModalContent('{{ $item->id }}')">Print</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                                                </form>
        </div>
        
    </div>
</div>

    
</td>
@endif
                        
<!-- <td><a href="/orders/{{$item->id}}/delete" class="btn btn-danger">Delete</a></td>                        -->
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    
    function printModalContent(orderId) {
        // Hide the print and close buttons before printing
        var modalButtons = document.getElementById('modalButtons-' + orderId);
        modalButtons.style.display = 'none';

        // Get the modal content to print
        var modalContent = document.getElementById('myModal-' + orderId);

        // Clone the modal content to a new window
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Receipt</title>');
        printWindow.document.write('<style>.print-btn { display: none;margin-right:2px; }</style>'); // Hide print button in print view
        printWindow.document.write('</head><body>');
        printWindow.document.write(modalContent.innerHTML);
        printWindow.document.write('</body></html>');

        // Trigger printing in the new window
        printWindow.document.close();
        printWindow.print();
        printWindow.close();

        // Show the modal buttons again after printing (optional)
        modalButtons.style.display = 'block';
        modalButtons.style.marginLeft = '300px';
        $('#myModal-' + orderId).modal('hide');
        // Perform AJAX request to update status in database
        updateOrderStatus(orderId);
    }
        function updateOrderStatus(orderId) {
        // Perform AJAX request to update status in database
        $.ajax({
            url: '/orders/update-order-status/' + orderId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
               
                console.log('Order status updated successfully!');
                insertNewRecord(orderId);
                // window.location.href = '/orders';
            },
            error: function(xhr, status, error) {
                console.error('Failed to update order status:', error);
            }
        });
    }
    
    function insertNewRecord(orderId) {

       // Perform AJAX request to insert a record into a new table
        $.ajax({
            url: '/orders/insert-new-record',
            method: 'POST',
            data: {
                orderId: orderId
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('New record inserted successfully!');
                window.location.href = '/orders';
            },
            error: function(xhr, status, error) {
                console.error('Failed to insert new record:', error);
                window.location.href = '/orders';
            }
        });
    }

    function invoiceModalContent(orderId) {
        
        // Hide the print and close buttons before printing
        var modalButtons = document.getElementById('modalButtonss-' + orderId);
        modalButtons.style.display = 'none';

        // Get the modal content to print
        var modalContent = document.getElementById('Invoice-' + orderId);

        // Clone the modal content to a new window
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Receipt</title>');
        printWindow.document.write('<style>.print-btn { display: none;margin-right:2px; }</style>'); // Hide print button in print view
        printWindow.document.write('</head><body>');
        printWindow.document.write(modalContent.innerHTML);
        printWindow.document.write('</body></html>');

        // Trigger printing in the new window
        printWindow.document.close();
        printWindow.print();
        printWindow.close();

        // Show the modal buttons again after printing (optional)
        modalButtons.style.display = 'block';
        modalButtons.style.marginLeft = '300px';
        $('#Invoice-' + orderId).modal('hide');
        // Perform AJAX request to update status in database
        updateInvoiceOrderStatus(orderId);
      
            }

            function updateInvoiceOrderStatus(orderId) {
        // Perform AJAX request to update status in database
        $.ajax({
            url: '/orders/update-invoice-order-status/' + orderId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
               
                console.log('Order status updated successfully!');
                // insertNewRecord(orderId);
                window.location.href = '/orders';
            },
            error: function(xhr, status, error) {
                console.error('Failed to update order status:', error);
            }
        });
    }
        

    </script>

@stop