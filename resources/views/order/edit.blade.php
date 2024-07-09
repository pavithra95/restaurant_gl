<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0d1aef9724.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            /* margin-left:20px; */

        }

        body {
            background-color: #EBEBEB;
        }

        nav {
            width: 100vw !important;
        }

        .ordertable {
            width: 100%;
        }

        .orders {
            width: 100%;
        }

        .orders {
            background-color: #F5F8FD;
        }

        th,
        td {
            border: 0px;
            padding: 10px;
        }

        tr th {
            background-color: #0142C1;
            padding: 20px;
        }

        tr {
            background-color: #F5F8FD;
            border-radius: 40px !important;
        }

        .ordertable tr:hover {
            background-color: #0142C1;
            color: #F5F8FD;

        }

        .orderbox:hover {
            background-color: #0142C1;
            color: white;

        }

        .tableheading {
            padding: 20px;
            border-radius: 5px;
        }

        img {
            border-radius: 5px;
        }

        tr {
            border-radius: 5px !important;
        }

        .tot {
            height: 500px;
            /* Adjust the height as needed */
            overflow-y: auto;
            border-radius: 10px;
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: #0142C1 #F5F8FD;
        }

        .headingtext {
            color: #0142C1;
            padding: 20px;
        }

        .orders:hover {
            background-color: #F5F8FD !important;
        }

        .orders p {
            font-size: 14px;
        }

        #orderheading {

            padding: 2px;
            color: #0e50c2;
            font-weight: 700;
        }

        /* @media (min-width:1025px) {
            .b1 {
                max-width: 200px;
            }
        } */
        @media (max-width: 1023px) {
            .sidebar-toggle {
                display: block;
            }

            .left-sidebar,
            .right-sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                width: 250px;
                background-color: #42A7C3;
                /* padding: 20px; */
                transform: translateX(-130%);
                transition: transform 0.3s ease-in-out;
                z-index: 1000;
            }

            .left-sidebar.active {
                transform: translateX(0);
            }

            .right-sidebar {
                right: 0;
                left: auto;
                transform: translateX(100%);
            }

            .right-sidebar.active {
                transform: translateX(0);
            }

            .left-sidebar .orderbox,
            .right-sidebar .orderbox {
                background-color: #F5F8FD;
                color: #42A7C3;
                margin-bottom: 15px;
            }

        }

        @media (min-width: 1024px) {
            .sidebar-toggle {
                display: none;
            }
        }
        @media print{
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

        }
    </style>

</head>

<body>

    <div class="container-fluid p-0 m-0">
        <nav class="navbar navbar-light bg-info w-100 m-0 p-0">
            <a class="navbar-brand p-1" href="#">Back</a>
            <button class="btn btn-light sidebar-toggle d-lg-none" onclick="toggleLeftSidebar()">Orders</button>
            <button class="btn btn-light sidebar-toggle d-lg-none" onclick="toggleRightSidebar()">Category</button>
        </nav>

        <div class="row mt-4 ms-2">
            <div class="col-md-1 col-sm-12 left-sidebar card text-center d-flex flex-column align-items-center rounded-4" id="leftSidebar">
                <button class="btn btn-light d-md-none" onclick="toggleLeftSidebar()"> <i class="fas fa-times"></i></button>
                <!-- <h4 class="m-2">LOGO</h4> -->
                <div style="border-radius: 10px" id="orderheading">ORDERS</div>

                @foreach ($orders as $od)
                <div style="border-radius: 10px" class="p-2  my-2 orderbox"><a href="/orders/{{ $od->id }}/edit">{{$od->order_no}}</a></div>
                @endforeach
            </div>
            {{-- second part --}}


            <div class="col-lg-7 col-md-12 card p-1 ms-2 rounded-4">
                <div class="container my-2 border border-3">
                    <h1 class="text-center">BILLING SYSTEM</h1>
                    <div class="row ">
                        <div class="col py-2">
                            <p>Order Type</p>
                            <select name="order_type" id="selection" class="form-control" required="required">
                                <option value="Dining" @if ($order->order_type == 'Dining') selected=""

                                    @endif>Dining</option>
                                <option value="Parcel" @if ($order->order_type == 'Parcel') selected=""

                                    @endif>Parcel</option>
                            </select>
                        </div>
                        <div class="col py-2">
                            <p>Order Date</p>
                            <input type="text" name="order_date" class="form-control date-picker" value="{{now()->format('d-m-Y')}}" required="" readonly>

                        </div>
                        <div class="col py-2">
                            <p>Table Number</p>
                            <select name="table_no" id="textField" class="form-control">
                                @foreach ($tables as $table)
                                <option value="{{$table->id}}" @if ($order->table_no == $table->id) selected=""

                                    @endif>{{$table->table_no}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <table class="ordertable">
                    <thead>
                        <tr class="bg-primary text-white tableheading rounded-3" id="head">
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="billingBody">
                    </tbody>
                </table>
                <hr>
                <table class="orders" id="tot">

                    <tr>
                        <td>Total Items</td>
                        <td id="totalItems">0</td>
                        <td>Sub Total</td>
                        <td id="subTotal">Rs.0.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>GST(Incl)</td>
                        <td id="gst">Rs.0.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>CGST(Incl)</td>
                        <td id="cgst">Rs.0.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Paid</td>
                        <td id="total">Rs.0.00</td>
                    </tr>
                    <tr>


                        <td colspan="4">
                            
                           
                            <center><button id="submitOrder" class="btn btn-primary btn-sm mt-3 ">Submit Order</button></center>
                           
                            <center><button type="button" id="invoiceButton" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                                    Invoice
                                </button> </center>


                            <!-- Modal HTML -->
                            <div>
                                <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="invoiceModalLabel">Customer Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                <form id="customerForm">
                                                    <div class="mb-3">
                                                        <label for="modalCustomerName" class="form-label">Customer Name</label>
                                                        <input type="text" class="form-control" id="modalCustomerName" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="modalCustomerPhone" class="form-label">Customer Phone</label>
                                                        <input type="text" class="form-control" id="modalCustomerPhone" required>
                                                    </div>
                                                </form>
                                                <table>

                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>

                                                    </tr>
                                                    @foreach($order->orderDetails as $key=>$i)
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
                        <td>Rs. {{$order->total_amount}}</td>

                    </tr>
                </table>
                <hr>


                <h4 class="greet">***THANK YOU***</h4>
            </div>
            <div class="modal-footer" id="modalButtons">
                <!-- Print button hidden by default -->
                <button type="button" class="btn btn-success print-btn mr-2" onclick="printInvoice()">Print</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>

    </div>
    </div>


 </td>

    </tr>
    </table>


    </div>
    <div class="col-md-3 col-sm-12 right-sidebar card ms-2 me-3 rounded-4" id="rightSidebar">
        <button class="btn btn-light d-md-none" onclick="toggleRightSidebar()"> <i class="fa-solid fa-arrow-right"></i></button>
        <div class="row text-center">
            <div class="input-group my-2">
                <input type="text" class="form-control text-primary" placeholder="Search items" aria-label="Search" aria-describedby="search-icon">
            </div>
            <br />
            <div id="maindiv" class="d-flex flex-wrap">

            </div>

        </div>
    </div>
    </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzF7ZVx5SX7B0z5zA1RXa5RoLA9Gmvrp4BbvpR3p8K" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-QF6NF99zhLsULyU1fK"></script>
    <!-- Your custom scripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let orderDetails = {!!$orderDetails -> toJson() !!};
        console.log(orderDetails);
        let billingItems = [];
        let order_id = {!!$order_id!!};

        // console.log('order'+ orderDetails);

        let totalItems = 0;
        let subTotal = 0;
        let gst = 0;
        let cgst = 0;
        let totalPaid = 0;
        let total = 0;
        let status = 'pending';

        // document.getElementById('invoiceButton').addEventListener('click', () => {
        //     // Populate the billing table and total amount in the modal
        //     document.getElementById('modalInvoiceTable').innerHTML = document.querySelector('.ordertable').outerHTML;
        //     document.getElementById('modalTotalAmount').innerHTML = document.querySelector('.orders').outerHTML;
        // });

        function insertNewRecord(orderId,customerName,customerPhone) {

// Perform AJAX request to insert a record into a new table
 $.ajax({
     url: '/orders/insert-new-record',
     method: 'POST',
     data: {
         orderId: orderId,
         customerName: customerName,
         customerPhone: customerPhone,
     },
     headers: {
         'X-CSRF-TOKEN': '{{ csrf_token() }}'
     },
     success: function(response) {
        //  console.log('New record inserted successfully!');
         window.location.href = '/orders/create';
     },
     error: function(xhr, status, error) {
         console.error('Failed to insert new record:', error);
         window.location.href = '/orders';
     }
 });
}

        function printInvoice() {
            // Get customer details from modal input fields

            // Close the modal
            // Get customer details from modal input fields
        const customerName = document.getElementById('modalCustomerName').value || 'N/A';
        const customerPhone = document.getElementById('modalCustomerPhone').value || 'N/A';

        // Close the modal
        const modal = new bootstrap.Modal(document.getElementById('invoiceModal'));
        modal.hide();

        // Create a new window for printing
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<!DOCTYPE html><html lang="en">');
        printWindow.document.write('<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">');
        printWindow.document.write('<title>Print Receipt</title>');
        printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>');
        printWindow.document.write('<body>');

        // Print content with customer details
        printWindow.document.write('<div class="container">');
        printWindow.document.write('<h2>Customer Name: ' + customerName + '</h2>');
        printWindow.document.write('<h2>Phone Number: ' + customerPhone + '</h2>');

        // Print billing table
        printWindow.document.write('<table class="table table-bordered">');
        printWindow.document.write('<thead><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Total</th></tr></thead>');
        printWindow.document.write('<tbody>');
        // Populate billing table with billing items
        billingItems.forEach(item => {
            printWindow.document.write('<tr><td>' + item.name + '</td><td>' + item.price + '</td><td>' + item.quantity + '</td><td>' + (item.price * item.quantity) + '</td></tr>');
        });
        printWindow.document.write('</tbody>');
        // Print totals
        printWindow.document.write('<tfoot><tr><td colspan="3">Total</td><td>' + total + '</td></tr></tfoot>');
        printWindow.document.write('</table>');

        printWindow.document.write('</div>');

        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.print();
        insertNewRecord(order_id,customerName,customerPhone);
        }



        function printModalContent() {
            const customerName = document.getElementById('modalCustomerName').value || 'N/A';
            const customerPhone = document.getElementById('modalCustomerPhone').value || 'N/A';

            // Hide the print and close buttons before printing
            var modalButtons = document.getElementById('modalButtons');
            modalButtons.style.display = 'none';

            // Get the modal content to print
            var modalContent = document.getElementById('invoiceModal');

            // Clone the modal content to a new window
            var printWindow = window.open('', '_blank');
            printWindow.document.write(`<h2>Customer Name: ${customerName}</h2>`);
            printWindow.document.write(`<h2>Phone Number: ${customerPhone}</h2>`);
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
            $('#invoiceModal' + orderId).modal('hide');
            // Perform AJAX request to update status in database
            //updateOrderStatus(orderId);


        }
        // let result = printModalContent();
        // console.log(result);


        document.getElementById('selection').addEventListener('change', function() {
            const tableNoField = document.getElementById('textField');
            if (this.value === 'Parcel') {
                tableNoField.disabled = true;
            } else {
                tableNoField.disabled = false;
            }
        });

        function toggleLeftSidebar() {
            document.getElementById("leftSidebar").classList.toggle("active");
        }

        function toggleRightSidebar() {
            document.getElementById("rightSidebar").classList.toggle("active");
        }



        function renderBillingTable() {
            const billingTableBody = document.getElementById("billingBody");
            billingTableBody.innerHTML = "";
            billingItems.forEach((item, index) => {
                const row = `<tr class="my-3">
                <td class="txt">${item.name}</td>
                <td>${item.price}</td>
                <td><input class="form-control" type="number" name="qty" value="${item.quantity}" ${item.isStored ? 'disabled' : ''} onchange="updateQuantity(${index}, this.value)"></td>
                <td id="total${index}">${item.price * item.quantity}</td>
            </tr>`;
                billingTableBody.innerHTML += row;
            });
          
        }

        function addItemToBilling(itemName, price, quantity, id, isStored, status) {
            const existingItemIndex = billingItems.findIndex(item => item.id === id);

            if (existingItemIndex !== -1) {
                // If the item exists, update its quantity
                billingItems[existingItemIndex].quantity += quantity;
                
            } else {
                // If the item doesn't exist, add it to the billing list
                billingItems.push({
                    name: itemName,
                    price: price,
                    quantity: quantity,
                    id: id,
                    isStored: isStored,
                    status: status,
                });
            }
            console.log(isStored);
                if(isStored == true && status=='delivered'){
                    // var invoiceButtons = document.getElementById('invoiceButton');
                    var submitButtons = document.getElementById('submitOrder');
                    submitButtons.style.display = 'none';
                    // submitButtons.style.display = 'display';
                    // document.getElementById('invoice').classList.add('hidden');
                }else{
                    var invoiceButtons = document.getElementById('invoiceButton');
                    var submitButtons = document.getElementById('submitOrder');
                    submitButtons.style.display = 'block';
                    invoiceButtons.style.display = 'none';
                }
            renderBillingTable();
            calculateTotals();
            updatePaymentSection();
           
        }

        function calculateTotals() {
            totalItems = billingItems.length;
            subTotal = billingItems.reduce((acc, item) => acc + (item.price * item.quantity), 0);
            // Assuming GST and CGST calculations here
            gst = subTotal * 0.025; // 10% GST
            cgst = subTotal * 0.025; // 10% CGST
            total = subTotal + gst + cgst;
            // total1 = subTotal + gst + cgst;
            // document.getElementById('total1').textContent = total1.toFixed(2);
        }
       


        function updateQuantity(index, quantity) {
            billingItems[index].quantity = parseInt(quantity);
            renderBillingTable();
            calculateTotals();
            updatePaymentSection();
            updateRowTotal(index);
        }

        function updateRowTotal(index) {
            const totalAmount = billingItems[index].price * billingItems[index].quantity;
            document.getElementById(`total${index}`).textContent = `${totalAmount.toFixed(2)}`;
        }

        function updatePaymentSection() {
            document.getElementById("totalItems").textContent = totalItems;
            document.getElementById("subTotal").textContent = "Rs." + `${subTotal.toFixed(2)}`;
            document.getElementById("gst").textContent = "Rs." + `${gst.toFixed(2)}`;
            document.getElementById("cgst").textContent = "Rs." + `${cgst.toFixed(2)}`;
            document.getElementById("total").textContent = "Rs." + `${total.toFixed(2)}`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            
            orderDetails.forEach(item => {
                console.log("ii" + orderDetails);
                // billingItems.push({
                //     name: item.product_id,
                //     price:item.item_price,
                //     quantity:item.qty,
                //     id:item.product_id

                // });
                addItemToBilling(item.product.product_name, item.item_price, item.qty, item.product_id, true, item.status);
                
                
                
            });
            // console.log(billingItems);
            fetch('/getProducts')
                .then(response => response.json())
                .then(data => {
                    const menuItemsContainer = document.getElementById('maindiv');
                    menuItemsContainer.innerHTML = ''; // Clear the container first

                    for (let i = 0; i < data.length; i += 2) {
                        const rowDiv = document.createElement('div');
                        rowDiv.className = 'row w-100 mb-3'; // Create a new row

                        // Create the first menu item
                        const item1 = data[i];
                        const div1 = document.createElement('div');
                        div1.className = 'col-6 p-3 orderbox';
                        div1.style.borderRadius = '10px';
                        div1.innerHTML = `
                            <img src="https://recipes.net/wp-content/uploads/2023/05/air-fryer-chicken-biryani-recipe_6968eb6ab4a5ae22d136dab86c9ea8af.jpeg" alt="Loading" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('${item1.product_name}', ${item1.final_price}, 1,${item1.id},false,${item1.status})">
                            <p class="text-center">${item1.product_name}</p>
                        `;
                        rowDiv.appendChild(div1);

                        // Check if there's a second item to add in the same row
                        if (i + 1 < data.length) {
                            const item2 = data[i + 1];
                            const div2 = document.createElement('div');
                            div2.className = 'col-6 p-3 orderbox';
                            div2.style.borderRadius = '10px';
                            div2.innerHTML = `
                                <img src="https://recipes.net/wp-content/uploads/2023/05/air-fryer-chicken-biryani-recipe_6968eb6ab4a5ae22d136dab86c9ea8af.jpeg" alt="Loading" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('${item2.product_name}', ${item2.final_price}, 1,${item2.id},${item2.status})">
                                <p class="text-center">${item2.product_name}</p>
                            `;
                            rowDiv.appendChild(div2);
                        }
                        menuItemsContainer.appendChild(rowDiv);
                    }
                })
                .catch(error => console.error('Error fetching menu items:', error));
        });


        document.getElementById('submitOrder').addEventListener('click', () => {
            const orderType = document.querySelector('[name="order_type"]').value;
            const orderDate = document.querySelector('[name="order_date"]').value;
            const tableNo = document.querySelector('[name="table_no"]').value;

            // Construct the data to send
            const orderData = {
                billingItems,
                totalItems,
                subTotal,
                gst,
                cgst,
                total,
                orderType,
                orderDate,
                tableNo,
                _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
            };
            fetch('/orders/' + order_id, {
                    method: 'PUT', // or 'PATCH' depending on your API
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(orderData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/orders/create';
                    } else {
                        alert('Failed to submit the order.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        function toggleLeftSidebar() {
            document.getElementById("leftSidebar").classList.toggle("active");
        }

        function toggleRightSidebar() {
            document.getElementById("rightSidebar").classList.toggle("active");
        }
    </script>
</body>

</html>