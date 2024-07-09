<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\POS;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $items = Order::all();
        
        return view('order.index')->with(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $todayDate = Carbon::today()->toDateString();
        $tables = Table::all();
        $items = Product::all();
        $orders = Order::whereIn('status',['kot','delivered'])->where('order_date',$todayDate)->get();
        // dd($todayDate);
        return view('order.create')->with(compact('tables', 'items','orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        
       
        $formattedDate = Carbon::createFromFormat('d-m-Y', $request->orderDate)->format('Y-m-d');
        $item = new Order();
        $item->order_no = Order::generateOrderNumber();
        $item->order_type = $request->orderType;
        $item->order_date = $formattedDate;
        $item->table_no = $request->tableNo;
        $item->total_amount = $request->total;
        $item->status = "kot";
        // dd($item->order_no);
        $item->save();

        foreach ($request->billingItems as $prd) {
            // dd($prd->name);
            $product = Product::find($prd['id']);
            $order = new OrderDetails();
            $order->order_id = $item->id;
            $order->product_id = $prd['id'];
            $order->qty = $prd['quantity'];
            // $order->notes = $request->notes[$key];
            $order->item_price = $prd['price'];
            $order->total_price = $order->item_price * $order->qty;
            $order->status = 'kot';
            $order->save();
        }
        // $orderDetailstotal = OrderDetails::where('order_id', $item->id)->sum('total_price');
        // $item1= Order::find($item->id);
        // $item1->total_amount = $orderDetailstotal;
        // $item1->save();

        // $formattedDate = Carbon::createFromFormat('d-m-Y', $request->order_date)->format('Y-m-d');
        // $item = new Order();
        // $item->order_no = Order::generateOrderNumber();
        // $item->order_type = $request->order_type;
        // $item->order_date = $formattedDate;
        // $item->table_no = $request->table_no;
        // // dd($item->order_no);
        // $item->save();

        // foreach ($request->product_id as $key => $prd) {
        //     // dd($prd);
        //     $product = Product::find($prd);
        //     $order = new OrderDetails();
        //     $order->order_id = $item->id;
        //     $order->product_id = $request->product_id[$key];
        //     $order->qty = $request->quantity[$key];
        //     $order->notes = $request->notes[$key];
        //     $order->item_price = $product->final_price;
        //     $order->total_price = $order->item_price * $request->quantity[$key];
        //     $order->status = 'pending';
        //     $order->save();
        // }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $todayDate = Carbon::today()->toDateString();
        $order = Order::find($id);
        // dd($order);
        $order_id = $order->id;
        $orders = Order::whereIn('status',['kot','delivered'])->where('order_date',$todayDate)->get();
        
        // dd($orders);
        $orderDetails = OrderDetails::where('order_id', $order->id)->with('Product')->get();
        $orderDetailstotal = OrderDetails::where('order_id', $order->id)->where('status','delivered')->sum('total_price');
        // dd( $orderDetailstotal);
        $tables = Table::all();
        $items = Product::all();
        return view('order.edit')->with(compact('order_id','order', 'orders','orderDetails', 'tables', 'items','orderDetailstotal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        // dd('update');
        // dd($request->all());
        $item = Order::find($id);
        $item->order_type = $request->orderType;
        $item->total_amount = $request->total;
        if ($item->order_type == 'Dining') {
            $item->table_no = $request->tableNo;
        } else {
            $item->table_no = '';
        }
        
       

        // $od = OrderDetails::where('order_id', $item->id)->get();
        // OrderDetails::where('order_id', $item->id)->where('status', 'pending')->delete();
        foreach ($request->billingItems as $prd) {
            // dd($prd->name);
            if($prd['isStored'] == false){
                // dd($prd['isStored']);
            $product = Product::find($prd['id']);
            $order = new OrderDetails();
            $order->order_id = $item->id;
            $order->product_id = $prd['id'];
            $order->qty = $prd['quantity'];
            // $order->notes = $request->notes[$key];
            $order->item_price = $prd['price'];
            $order->total_price = $order->item_price * $order->qty;
            $order->status = 'kot';
            $order->save();
            $item->status = 'kot';
            }
        }
        $item->save();

        return response()->json(['success' => true]);
    }

    public function updateStatus($id)
    {
        $user = Auth::user();

        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        
        $order = Order::find($id);
        $items = OrderDetails::where('order_id',$order->id)->where('status','pending')->get();
        foreach($items as $i){
            $item = OrderDetails::find($i->id);
            $item->status = 'kot';
            $item->save();
        }
        $order->status ='delivered';
        $order->save();


       return redirect('/orders');
    }
    public function updateInvoiceStatus($id)
    {
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $order = Order::find($id);
        $items = OrderDetails::where('order_id',$order->id)->where('status','kot')->get();
        foreach($items as $i){
            $item = OrderDetails::find($i->id);
            $item->status = 'delivered';
            $item->save();
        }
        $order->status ='closed';
        $order->save();


       return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function getKot(Request $request){
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $todayDate = Carbon::today()->toDateString();
        $orders = Order::where('status','kot')->where('order_date',$todayDate)->get();
        return view('order.kot')->with(compact('orders'));

    }
    public function updateKot($id){
        $user = Auth::user();
        if($user->name == 'Admin'){
            $userDatabaseName = 'restaurant';
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }else{

            $userDatabaseName = 'kggl_' . $user->name;
            config(['database.connections.new_user.database' => $userDatabaseName]);
            DB::purge('new_user');
            DB::reconnect('new_user');
        }
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();

        $orderDetails = OrderDetails::where('order_id',$order->id)->where('status','kot')->get();
        foreach($orderDetails as $i){
            $item = OrderDetails::find($i->id);
            $item->status = 'delivered';
            $item->save();
        }
        return redirect()->back();
    }
}
