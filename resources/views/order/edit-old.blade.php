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

                        <h4 class="m-0 text-dark col-md-6 float-left">Edit Order</h4>

                    </div>
                </div>
                <br>


                <form action="/orders/{{$order->id}}" method="POST" role="form" id="app" class="col-md-12" autocomplete="off">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}

                    <div class="row" >
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('name')) text-danger @endif">
                                <label for=""> Order Type</label>
                                <select name="order_type" v-model="selectedOption" id="selection" class="form-control" required="required">
                                    <option value=""></option>
                                    <option value="Dining">Dining</option>
                                    <option value="Parcel">Parcel</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if($errors->has('status')) text-danger @endif">
                                <label for="">Table Number</label>
                                <select name="table_no" id="textField" v-model="textFieldValue" :disabled="isTextFieldDisabled" :required="isTextFieldRequired" class="form-control">
                                    <option value=""></option>
                                    @foreach ($tables as $table)
                                    <option value="{{$table->id}}">{{$table->table_no}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('date')) text-danger @endif">
                                <label for="">Order Date</label>
                                <input type="text" name="order_date" class="form-control date-picker" value="{{now()->format('d-m-Y')}}" required="" readonly>
                                @if($errors->has('date'))
                                <div class="error text-danger">{{ $errors->first('date') }}</div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Qty</th>
                                <th>Notes</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>

                        <template v-for="i in orderDetails">
                                        <input type="hidden" name="product_id[]" :value="i.product_id">
                                        <input type="hidden" name="quantity[]" :value="i.quantity">

                                        <input type="hidden" name="notes[]" :value="i.notes"> 
                                        <input type="hidden" name="status[]" :value="i.status"> 
                                        <input type="hidden" name="price[]" :value="i.item_price">
                                        <!-- <input type="hidden" name="price[]" :value="i.item_price"> -->

                        </template>
                            <tr v-for="(item, index) in orderDetails">
                             

                                <td style="width: 300px;">
                                    <p v-if="item.status ==='kot'">
                                    <v-select :options="items" label="name" v-model="item.product_id" :reduce="item => item.id" disabled>
                                            <template #search="{attributes, events}">
                                                <input class="vs__search" :required="!item.product_id" v-bind="attributes" v-on="events" />
                                            </template>
                                    </v-select>
                                    </p>
                                    <p v-else>
                                    <v-select :options="items" label="name" v-model="item.product_id" :reduce="item => item.id">
                                            <template #search="{attributes, events}">
                                                <input class="vs__search" :required="!item.product_id" v-bind="attributes" v-on="events" />
                                            </template>
                                    </v-select>
                                    </p>
                                       
                                       

                                   
                                </td>
                                
                                <td style="width: 150px;" v-if="item.status ==='kot'"><input class="form-control" type="number" :min="1" v-model="item.quantity" disabled></td>
                                <td style="width: 150px;" v-else><input class="form-control" type="number" :min="1" v-model="item.quantity"></td>
                                
                                <td style="width: 550px;" v-if="item.status ==='kot'"><input class="form-control" type="text" v-model="item.notes" disabled></td>
                                <td style="width: 550px;" v-else><input class="form-control" type="text" v-model="item.notes"></td>
                                
                                <td style="color: red" @click="removeRow(index)">X</td>
                                          
                                                

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            <td><a v-if="!isError" href="" @click.prevent="addItem" class="btn btn-primary ">Add Row</a>
                                                
                            </tr>


                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary col-md-2 offset-md-1 btn-sm">Update</button>
                    <a class="btn btn-danger col-md-2  btn-sm" href='/product-categories'>Cancel </a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
</script>
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

<script>
     Vue.component('v-select', VueSelect.VueSelect);
    $(document).ready(
        function() {
            $('.date-picker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });

           

        });


    new Vue({
        el: '#app',
        data: {
            selectedOption: '{{$order->order_type}}', // Data property to store the selected option
            textFieldValue: '{{$order->table_no}}', // Data property for the text field value
            order_date:'',
            orderDetails: [
                @foreach($orderDetails as $i){
                id:"{{$i->id}}",
                product_id:"{{$i->product_id}}",
                quantity: "{{$i->qty}}",
                notes: "{{$i->notes}}",
                item_price: "{{$i->item_price}}",
                status: "{{$i->status}}",
            },
            @endforeach
        ],
            items:[
                @foreach($items as $item) {
                    id:"{{$item->id}}",
                    name:"{{$item->product_name}}",
                    // item_price:"{{$item->final_price}}",

                },
                @endforeach

            ],
            isError: false,
        },
        computed: {
            isTextFieldDisabled() {
                // Computed property to determine if the text field should be disabled
                return this.selectedOption === 'Parcel'; // Disable field when Option 2 is selected
               
            },
            isTextFieldRequired() {
                // Computed property to determine if the text field should be disabled
                // return this.selectedOption === 'Parcel'; // Disable field when Option 2 is selected
                return this.selectedOption === 'Dining'; 
            },
        },
        methods: {
            removeRow: function(index) {
                // console.log("Removing", index);
                this.orderDetails.splice(index, 1);
                if (index == this.errorIndex) {

                    this.isError = false;
                    this.errorIndex = null;
                }
            },
            addItem: function() {
                this.orderDetails.push({
                    product_id: '',
                    quantity: 1,
                    notes:null,
                    item_price:'',
                    status:'pending',
                });
            },
        }
    });
</script>


@stop