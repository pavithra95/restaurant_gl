<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
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
            border-radius: 100px !important;
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

        @media (min-width:1025px) {
            .b1 {
                max-width: 200px;
            }
        }

        @media (max-width: 767px) {

            .left-sidebar,
            .right-sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                width: 250px;
                background-color: #42A7C3;
                padding: 20px;
                transform: translateX(-100%);
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

            .sidebar-toggle {
                display: block;
            }
        }

        @media (min-width: 768px) {
            .sidebar-toggle {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 m-0">
        <nav class="navbar navbar-expand-md navbar-light bg-info p-0 m-0">
            <a class="navbar-brand" href="#">Back</a>
            <button class="btn btn-primary sidebar-toggle d-md-none" onclick="toggleLeftSidebar()">Orders</button>
            <button class="btn btn-primary sidebar-toggle d-md-none" onclick="toggleRightSidebar()">Category</button>

        </nav>
        <div class="container my-2 border border-3">
            <div class="row">
                <div class="col py-2">
                    <p>Order Type</p>
                    <select name="order_type" id="selection" class="form-control" required="required">
                        <option value=""></option>
                       
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
                        <option value=""></option>
                        @foreach ($tables as $table)
                        <option value="{{$table->id}}" @if ($order->table_no == $table->id) selected="" 
    
    @endif>{{$table->table_no}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-1 col-sm-12 left-sidebar" id="leftSidebar">
                <button class="btn btn-light d-md-none" onclick="toggleLeftSidebar()"> <i class="fas fa-times"></i></button>
                <div style="border-radius: 10px" class="p-3 mx-2 mb-2 orderbox">Orders</div>
                @foreach ($orders as $order)
                <div style="border-radius: 10px" class="p-3 m-2 orderbox"><a href="/orders/{{ $order->id }}/edit">{{$order->order_no}}</a></div>
                @endforeach
                <!-- <div style="border-radius: 10px" class="p-3 m-2 orderbox">Order 2</div>  
                <div style="border-radius: 10px" class="p-3 m-2 orderbox">Order 3</div>
                <div style="border-radius: 10px" class="p-3 m-2 orderbox">Order 4</div>
                <div style="border-radius: 10px" class="p-3 m-2 orderbox">Order 5</div>
                <div style="border-radius: 10px" class="p-3 m-2 orderbox">Order 6</div>
                <div style="border-radius: 10px" class="p-3 m-2 orderbox">Order 7</div>    -->
            </div>
            <div class="col-md-8 col-sm-12">
                <table class="ordertable" id="billingTable">
                    <thead>
                        <tr class="bg-primary text-white tableheading">
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="billingBody">
                        <!-- @foreach ($orderDetails as $od)
                        <tr>
                            <td>{{$od->product->product_name}}</td>
                            <td>{{$od->item_price}}</td>
                            <td>{{$od->qty}}</td>
                            <td>{{$od->total_price }}</td>
                        </tr>

                        @endforeach -->
                        <!-- <tr >
                        </tr> -->
                    </tbody>
                </table>
                <p class="headingtext">Payment</p>
                <table class="orders" id="paymentTable">

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
                </table>
                <button id="submitOrder" class="btn btn-primary mt-3">Submit Order</button>

                <!-- Your existing payment section -->
            </div>
            <div class="col-md-2 col-sm-12 right-sidebar" id="rightSidebar">
                <button class="btn btn-light d-md-none" onclick="toggleRightSidebar()"> <i class="fa-solid fa-arrow-right"></i></button>

                <div class="col">
                    <div class="row text-center">
                        <div class="input-group m-2">
                            <input type="text" class="form-control" placeholder="Search items" aria-label="Search" aria-describedby="search-icon">
                        </div>
                        <br />

                        <div id="maindiv" class="d-flex justify-content-around">

                            <!-- <img src="https://recipes.net/wp-content/uploads/2023/05/air-fryer-chicken-biryani-recipe_6968eb6ab4a5ae22d136dab86c9ea8af.jpeg" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('Biriyani', 80,1)">
                <p class="text-center">Biryani</p>
                </div>
                <div>
                    <img src="https://assets.zeezest.com/blogs/PROD_dosa%20banner_1691427618869_thumb_1200.png?w=3840&q=75" height="100px" width="100px" class="m-1 rounded-5" onclick="addItemToBilling('Dosa', 80,1)">
                    <p class="text-center">Dosa</p>
                    </div>  
                    <div>
                        <img src="https://images.lifestyleasia.com/wp-content/uploads/sites/6/2023/06/27181855/best-chapati-klang-valley-indian-restaurants-kl-selangor-capati-dining-guide.jpg" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('Chappathi', 20,1)">
                        <p class="text-center">Chappathi</p> -->

                        </div>


                        <!-- Add other menu items similarly -->
                    </div>

                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            let orderDetails = {!! $orderDetails->toJson() !!};
        //    console.log(orderDetails);
            let billingItems = [];
            let order_id= {!! $order_id !!};
            // console.log('order'+ order_id);

            let totalItems = 0;
            let subTotal = 0;
            let gst = 0;
            let cgst = 0;
            let totalPaid = 0;
            let total = 0;

            document.getElementById('selection').addEventListener('change', function() {
                const tableNoField = document.getElementById('textField');
                if (this.value === 'Parcel') {
                    tableNoField.disabled = true;
                } else {
                    tableNoField.disabled = false;
                }
            });

            function renderBillingTable() {
                const billingTableBody = document.getElementById("billingBody");
                billingTableBody.innerHTML = "";
                billingItems.forEach((item, index) => {
                    const row = `<tr class="my-3">
                        <td class="txt">${item.name}</td>
                        <td>${item.price}</td>
                        <td><input class="form-control" type="number" name="qty" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)"></td>
                        <td id="total${index}">${item.price * item.quantity}</td>
                    </tr>`;
                    billingTableBody.innerHTML += row;
                });
            }

            function addItemToBilling(itemName, price, quantity, id) {
                billingItems.push({
                    name: itemName,
                    price: price,
                    quantity: quantity,
                    id: id
                });
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
                    // console.log("ii"+orderDetails);
                    // billingItems.push({
                    //     name: item.product_id,
                    //     price:item.item_price,
                    //     quantity:item.qty,
                    //     id:item.product_id

                    // });
                    addItemToBilling(item.product.product_name, item.item_price, item.qty, item.product_id);
                });
                // console.log(billingItems);
                fetch('/getProducts')
                    .then(response => response.json())
                    .then(data => {
                        const menuItemsContainer = document.getElementById('maindiv');
                        console.log(data);
                        data.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'p-3 m-2 orderbox';
                            div.style.borderRadius = '10px';
                            div.innerHTML = `
                        <img src="https://recipes.net/wp-content/uploads/2023/05/air-fryer-chicken-biryani-recipe_6968eb6ab4a5ae22d136dab86c9ea8af.jpeg" alt="Loading" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('${item.product_name}', ${item.final_price}, 1,${item.id})">
                        <p class="text-center">${item.product_name}</p>
                    `;
                            menuItemsContainer.appendChild(div);
                        });
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
                fetch('/orders/'+order_id+'/edit', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(orderData)

                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Order submitted successfully!');
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