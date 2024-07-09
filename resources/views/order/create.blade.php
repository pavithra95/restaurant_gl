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
        *{
            margin: 0;
            padding: 0;
            /* margin-left:20px; */
            
        }
        body{
            background-color: #EBEBEB;
        }
        nav{
            width: 100vw !important;
        }
        .ordertable {
            width: 100%;
        }
        .orders{
            width: 100%; 
        }
        .orders {
            background-color: #F5F8FD;
        }
        th, td {
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
        tr{
            border-radius: 5px !important;
        }
        .tot {
            height: 500px; /* Adjust the height as needed */
            overflow-y: auto;
            border-radius: 10px;
            scrollbar-width: thin; /* For Firefox */
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
        #orderheading{
         
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
            .left-sidebar, .right-sidebar {
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
            .left-sidebar .orderbox, .right-sidebar .orderbox {
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
       
    </style>
    
</head>
<body>
  
    <div class="container-fluid p-0 m-0">
        <nav class="navbar navbar-light bg-info w-100 m-0 p-0">
            <a class="navbar-brand p-1" href="/orders">Back</a>
            <button class="btn btn-light sidebar-toggle d-lg-none" onclick="toggleLeftSidebar()">Orders</button>
            <button class="btn btn-light sidebar-toggle d-lg-none" onclick="toggleRightSidebar()">Category</button>   
        </nav>
       
        <div class="row mt-4 ms-2">
            <div class="col-md-1 col-sm-12 left-sidebar card text-center d-flex flex-column align-items-center rounded-4" id="leftSidebar">
                <button class="btn btn-light d-md-none" onclick="toggleLeftSidebar()"> <i class="fas fa-times"></i></button>
                <!-- <h4 class="m-2">LOGO</h4> -->
                <div style="border-radius: 10px"  id="orderheading">ORDERS</div>  
               
                @foreach ($orders as $order) 
                <div style="border-radius: 10px" class="p-2  my-2 orderbox"><a href="/orders/{{ $order->id }}/edit">{{$order->order_no}}</a></div>
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
                                    <option value=""></option>
                                    <option value="Dining">Dining</option>
                                    <option value="Parcel">Parcel</option>
                                </select>
                        </div>
                        <div class="col py-2">
                        <p>Order Date</p>
                        <input type="text" name="order_date" class="form-control date-picker" value="{{now()->format('d-m-Y')}}" required="" readonly>
             
                    </div>
                    <div class="col py-2">
                        <p>Table Number</p>
                        <select name="table_no" id="textField"   class="form-control">
                                    <option value=""></option>
                                    @foreach ($tables as $table)
                                    <option value="{{$table->id}}">{{$table->table_no}}</option>
                                    @endforeach
                                </select>
                    </div>
                    </div>
                    </div>
                   
                <table class="ordertable">
                    <thead >
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
                        
                    
                        <td colspan="4"><center><button id="submitOrder" class="btn btn-primary btn-sm mt-3 ">Submit Order</button></center>
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
                    <br/> 
                    <div id="maindiv" class="d-flex flex-wrap">
                        
                    </div>
       
                </div>  
            </div>
        </div>
    </div>
    <script>
        function toggleLeftSidebar() {
            document.getElementById("leftSidebar").classList.toggle("active");
        }
        
        function toggleRightSidebar() {
            document.getElementById("rightSidebar").classList.toggle("active");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzF7ZVx5SX7B0z5zA1RXa5RoLA9Gmvrp4BbvpR3p8K" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-QF6NF99zhLsULyU1fK6e36/1pJo3Jm2KiW8a4OfW2pNSXgKHAZpyiFSCQaS2fLiw" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    let billingItems = [];
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
            id: id
        });
    }
        document.getElementById("tot").style.display = "table";
        // document.getElementById("head").style.display = "display";
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
        document.getElementById("tot").style.display = "none";
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
                            <img src="https://recipes.net/wp-content/uploads/2023/05/air-fryer-chicken-biryani-recipe_6968eb6ab4a5ae22d136dab86c9ea8af.jpeg" alt="Loading" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('${item1.product_name}', ${item1.final_price}, 1,${item1.id})">
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
                                <img src="https://recipes.net/wp-content/uploads/2023/05/air-fryer-chicken-biryani-recipe_6968eb6ab4a5ae22d136dab86c9ea8af.jpeg" alt="Loading" height="100px" class="m-1 rounded-5" onclick="addItemToBilling('${item2.product_name}', ${item2.final_price}, 1,${item2.id})">
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
        _token: '{{ csrf_token() }}'  // Include CSRF token for Laravel
    };
        fetch('/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(orderData)

            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href='/orders/create';
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
